<?php
/**
 * A simple, unified cache handler (last modified: 2020.01.01).
 *
 * This file is a part of the "common classes package", utilised by a number of
 * packages and projects, including CIDRAM and phpMussel.
 * Source: https://github.com/Maikuolan/Common
 *
 * License: GNU/GPLv2
 * @see LICENSE.txt
 *
 * "COMMON CLASSES PACKAGE", as well as the earliest iteration and deployment
 * of this class, COPYRIGHT 2019 and beyond by Caleb Mazalevskis (Maikuolan).
 */

namespace Maikuolan\Common;

class Cache
{
    /** Whether to try using APCu. */
    public $EnableAPCu = false;

    /** Whether to try using Memcached. */
    public $EnableMemcached = false;

    /** Whether to try using Redis. */
    public $EnableRedis = false;

    /** Whether to try using PDO. */
    public $EnablePDO = false;

    /** The host for Memcached to try using. */
    public $MemcachedHost = 'localhost';

    /** The port for Memcached to try using. */
    public $MemcachedPort = 11211;

    /** The host for Redis to try using. */
    public $RedisHost = 'localhost';

    /** The port for Redis to try using. */
    public $RedisPort = 6379;

    /** The timeout for Redis to try using. */
    public $RedisTimeout = 2.5;

    /** The DSN to use for PDO connections. */
    public $PDOdsn = '';

    /** The username to use for PDO connections. */
    public $PDOusername = '';

    /** The password to use for PDO connections. */
    public $PDOpassword = '';

    /** Used to indicate which mechanism the object should preferably be using (consistency is nice). */
    public $Using = '';

    /** The path to a flatfile to use for caching. */
    public $FFDefault = '';

    /** Flag for whether the cache has been modified AFAIK since instantiation. */
    private $Modified = false;

    /** An array to contain any thrown exceptions. */
    public $Exceptions = [];

    /** Cache working object (needed by a number of mechanisms). */
    private $WorkingData = null;

    /** Prepared set query for PDO. */
    const SET_QUERY = 'REPLACE INTO `Cache` (`Key`, `Data`, `Time`) values (:key, :data, :time)';

    /** Prepared get query for PDO. */
    const GET_QUERY = 'SELECT `Data` FROM `Cache` WHERE `Key` = :key LIMIT 1';

    /** Prepared delete query for PDO. */
    const DELETE_QUERY = 'DELETE FROM `Cache` WHERE `Key` = :key';

    /** Prepared clear all query for PDO. */
    const CLEAR_QUERY = 'DELETE FROM `Cache` WHERE 1';

    /** Prepared clear expired query for PDO. */
    const CLEAR_EXPIRED_QUERY = 'DELETE FROM `Cache` WHERE `Time` > 0 AND `Time` < :time';

    /** Prepared get all query for PDO. */
    const GET_ALL_QUERY = 'SELECT * FROM `Cache` WHERE 1';

    /** Default blocksize for file reading operations. */
    const BLOCKSIZE = 262144;

    /** Number of seconds to try flocking a resource before giving up. */
    const FLOCK_TIMEOUT = 10;

    /**
     * Construct object and set working data if needed.
     *
     * @param array|null $WorkingData An optional array of default cache data.
     */
    public function __construct($WorkingData = null)
    {
        if (is_array($WorkingData)) {
            $this->WorkingData = $WorkingData;
        }
    }

    /**
     * Object destructor. Used to close any open connections, save cache to disk, etc.
     */
    public function __destruct()
    {
        if ($this->Using === 'Memcached') {
            $this->WorkingData->quit();
            return;
        }
        if ($this->Using === 'Redis') {
            $this->WorkingData->close();
            return;
        }
        if ($this->Using === 'PDO') {
            $this->clearExpiredPDO();
            return;
        }
        if (is_array($this->WorkingData)) {
            if ($this->clearExpired($this->WorkingData)) {
                $this->Modified = true;
            }
            if ($this->FFDefault && $this->Modified && $this->Using === 'FF') {
                $Handle = false;
                $Start = time();
                while (true) {
                    $Handle = fopen($this->FFDefault, 'wb');
                    if ($Handle !== false || (time() - $Start) > self::FLOCK_TIMEOUT) {
                        break;
                    }
                }
                if ($Handle === false) {
                    return;
                }
                $Locked = false;
                while (true) {
                    if ($Locked = flock($Handle, LOCK_EX | LOCK_NB) || (time() - $Start) > self::FLOCK_TIMEOUT) {
                        break;
                    }
                }
                if ($Locked) {
                    fwrite($Handle, serialize($this->WorkingData));
                    flock($Handle, LOCK_UN);
                }
                fclose($Handle);
            }
        }
    }

    /**
     * Should be called after constructing the object, after defining any
     * configurables, but before trying to set or get any cache items.
     *
     * @return bool True on success; False on failure.
     */
    public function connect(): bool
    {
        if ($this->EnableAPCu && extension_loaded('apcu') && ini_get('apc.enabled')) {
            $this->Using = 'APCu';
            return true;
        }
        if ($this->EnableMemcached && extension_loaded('memcached')) {
            $this->WorkingData = new \Memcached();
            if ($this->WorkingData->addServer($this->MemcachedHost, $this->MemcachedPort)) {
                $this->Using = 'Memcached';
                return true;
            }
            $this->WorkingData = null;
        }
        if ($this->EnableRedis && extension_loaded('redis')) {
            $this->WorkingData = new \Redis();
            if ($this->WorkingData->connect($this->RedisHost, $this->RedisPort, $this->RedisTimeout)) {
                $this->Using = 'Redis';
                return true;
            }
            $this->WorkingData = null;
        }
        if ($this->EnablePDO && extension_loaded('pdo')) {
            try {
                $PDO = new \PDO($this->PDOdsn, $this->PDOusername, $this->PDOpassword);
            } catch (\PDOException $Exception) {
                $this->Exceptions[] = $Exception->getMessage();
                return false;
            }
            if (is_object($PDO)) {
                $this->WorkingData = $PDO;
                $this->Using = 'PDO';
                return $this->checkTablesPDO();
            }
            unset($PDO);
        }
        if ($this->FFDefault) {
            if (is_file($this->FFDefault)) {
                if (is_readable($this->FFDefault) && is_writable($this->FFDefault)) {
                    $this->Using = 'FF';
                    if (!$Filesize = filesize($this->FFDefault)) {
                        $this->WorkingData = [];
                        return $this->Modified = true;
                    }
                    $Data = '';
                    $Handle = false;
                    $Start = time();
                    while (true) {
                        $Handle = fopen($this->FFDefault, 'rb');
                        if ($Handle !== false || (time() - $Start) > self::FLOCK_TIMEOUT) {
                            break;
                        }
                    }
                    if ($Handle === false) {
                        return false;
                    }
                    $Locked = false;
                    while (true) {
                        if ($Locked = flock($Handle, LOCK_EX | LOCK_NB) || (time() - $Start) > self::FLOCK_TIMEOUT) {
                            break;
                        }
                    }
                    if (!$Locked) {
                        fclose($Handle);
                        return false;
                    }
                    $Size = ($Filesize && self::BLOCKSIZE) ? ceil($Filesize / self::BLOCKSIZE) : 0;
                    $Step = 0;
                    while ($Step < $Size) {
                        $Data .= fread($Handle, self::BLOCKSIZE);
                        $Step++;
                    }
                    flock($Handle, LOCK_UN);
                    fclose($Handle);
                    $Data = $Data ? unserialize($Data) : [];
                    $this->WorkingData = is_array($Data) ? $Data : [];
                    return true;
                }
            } else {
                $Parent = dirname($this->FFDefault);
                if (is_dir($Parent) && is_readable($Parent) && is_writable($Parent)) {
                    $this->WorkingData = [];
                    $this->Using = 'FF';
                    return $this->Modified = true;
                }
            }
            return false;
        }
        return is_array($this->WorkingData);
    }

    /**
     * Tries to check whether a table exists for the instance to use and
     * automatically create it if it doesn't yet exist.
     *
     * Note that this hasn't been extensively tested against *every* database
     * driver available to PDO, so it's therefore possible that this method may
     * need to be refined/refactored/etc in the future, pending further
     * research, testing and so on.
     *
     * @return bool True when it already exists or when it's successfully
     *      created; False otherwise.
     */
    public function checkTablesPDO(): bool
    {
        /** Try to determine which kind of query to build. */
        if (preg_match('~^sqlite\:[^\:]~i', $this->PDOdsn)) {
            /** SQLite (excluding usage for in-memory and temporary tables). */
            $Check = 'SELECT count(*) FROM `sqlite_master` WHERE `type` = \'table\' AND `name` = \'Cache\'';
        } elseif (preg_match('~^informix\:~i', $this->PDOdsn)) {
            /** Informix. */
            $Check = 'SELECT count(*) FROM `systables` WHERE `tabname` = \'Cache\'';
        } elseif (preg_match('~^firebird\:~i', $this->PDOdsn)) {
            /** Firebird/Interbase. */
            $Check = 'SELECT 1 FROM RDB$RELATIONS WHERE RDB$RELATION_NAME = \'Cache\'';
        } else {
            /** Standard fallback for everything else (MySQL, Oracle, PostgreSQL, etc). */
            $Check = 'SELECT count(*) FROM `information_schema`.`tables` WHERE `TABLE_NAME` = \'Cache\'';
        }

        /** Try to build the query. Fail if exceptions are generated. */
        try {
            $Exists = $this->WorkingData->query($Check);
        } catch (\Exception $e) {
            return false;
        }

        /** In case of exceptions being silenced. */
        if (!is_object($Exists) || !is_a($Exists, '\PDOStatement')) {
            return false;
        }

        /** Time to perform our checks and to create the table if necessary. */
        $Exists = $Exists->fetch(\PDO::FETCH_NUM);
        if (empty($Exists[0])) {
            $this->WorkingData->exec('CREATE TABLE `Cache` (`Key` VARCHAR(128) PRIMARY KEY, `Data` TEXT, `Time` INT)');
            $Exists = $this->WorkingData->query($Check);
            if (is_object($Exists) && is_a($Exists, '\PDOStatement')) {
                $Exists = $Exists->fetch(\PDO::FETCH_NUM);
                if (empty($Exists[0])) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * Get a cache entry.
     *
     * @param string $Entry The name of the cache entry to get.
     * @return mixed The retrieved cache entry, or false on failure (e.g., if the cache entry doesn't exist).
     */
    public function getEntry(string $Entry)
    {
        if ($this->Using === 'APCu') {
            return $this->unserializeEntry(apcu_fetch($Entry));
        }
        if ($this->Using === 'Memcached' || $this->Using === 'Redis') {
            return $this->unserializeEntry($this->WorkingData->get($Entry));
        }
        if ($this->Using === 'PDO') {
            if ($this->clearExpiredPDO()) {
                $this->Modified = true;
            }
            $PDO = $this->WorkingData->prepare(self::GET_QUERY);
            if ($PDO !== false && $PDO->execute([':key' => $Entry])) {
                $Data = $PDO->fetch(\PDO::FETCH_ASSOC);
                return isset($Data['Data']) ? $this->unserializeEntry($Data['Data']) : false;
            }
            return false;
        }
        if (is_array($this->WorkingData) && isset($this->WorkingData[$Entry])) {
            if (isset($this->WorkingData[$Entry]['Data']) && !empty($this->WorkingData[$Entry]['Time'])) {
                if ($this->WorkingData[$Entry]['Time'] <= 0 || $this->WorkingData[$Entry]['Time'] > time()) {
                    return $this->unserializeEntry($this->WorkingData[$Entry]['Data']);
                }
                unset($this->WorkingData[$Entry]);
                $this->Modified = true;
                return false;
            }
            return $this->unserializeEntry($this->WorkingData[$Entry]);
        }
        return false;
    }

    /**
     * Set a cache entry.
     *
     * @param string $Key The name of the cache entry to set.
     * @param mixed $Value The value of the cache entry to set.
     * @param int $TTL The number of seconds that the cache entry should persist.
     * @return bool True on success; False on failure.
     */
    public function setEntry(string $Key, $Value, int $TTL = 3600): bool
    {
        $Value = $this->serializeEntry($Value);
        if ($this->Using === 'APCu') {
            if (apcu_store($Key, $Value, $TTL)) {
                return $this->Modified = true;
            }
            return false;
        }
        if ($this->Using === 'Memcached') {
            if ($TTL >= 2592000) {
                $TTL += time();
            }
            if ($this->WorkingData->set($Key, $Value, $TTL)) {
                return $this->Modified = true;
            }
            return false;
        }
        if ($this->Using === 'Redis') {
            if ($this->WorkingData->set($Key, $Value, $TTL)) {
                return $this->Modified = true;
            }
            return false;
        }
        if ($this->Using === 'PDO') {
            if ($TTL > 0) {
                $TTL += time();
            }
            $PDO = $this->WorkingData->prepare(self::SET_QUERY);
            if ($PDO !== false && $PDO->execute([':key' => $Key, ':data' => $Value, ':time' => $TTL])) {
                return ($PDO->rowCount() > 0 && $this->Modified = true);
            }
            return false;
        }
        if (is_array($this->WorkingData)) {
            if ($TTL > 0) {
                $TTL += time();
                $this->WorkingData[$Key] = ['Data' => $Value, 'Time' => $TTL];
            } else {
                $this->WorkingData[$Key] = $Value;
            }
            return $this->Modified = true;
        }
        return false;
    }

    /**
     * Delete a specific cache entry.
     *
     * @param string $Entry The name of the cache entry to delete.
     * @return bool True on success; False on failure.
     */
    public function deleteEntry(string $Entry): bool
    {
        if ($this->Using === 'APCu') {
            if (apcu_delete($Entry)) {
                return $this->Modified = true;
            }
            return false;
        }
        if ($this->Using === 'Memcached' || $this->Using === 'Redis') {
            if ($this->WorkingData->delete($Entry)) {
                return $this->Modified = true;
            }
            return false;
        }
        if ($this->Using === 'PDO') {
            $PDO = $this->WorkingData->prepare(self::DELETE_QUERY);
            if ($PDO !== false && $PDO->execute([':key' => $Entry])) {
                return ($PDO->rowCount() > 0 && $this->Modified = true);
            }
            return false;
        }
        if (is_array($this->WorkingData)) {
            if (isset($this->WorkingData[$Entry])) {
                unset($this->WorkingData[$Entry]);
                return $this->Modified = true;
            }
        }
        return false;
    }

    /**
     * Clears the entire cache.
     *
     * @return bool True on success; False on failure.
     */
    public function clearCache(): bool
    {
        if ($this->Using === 'APCu') {
            return $this->Modified = apcu_clear_cache();
        }
        if ($this->Using === 'Memcached') {
            return ($this->WorkingData->flush() && ($this->Modified = true));
        }
        if ($this->Using === 'Redis') {
            return ($this->WorkingData->flushDb() && ($this->Modified = true));
        }
        if ($this->Using === 'PDO') {
            $PDO = $this->WorkingData->prepare(self::CLEAR_QUERY);
            if ($PDO !== false && $PDO->execute()) {
                return ($PDO->rowCount() > 0 && $this->Modified = true);
            }
            return false;
        }
        if (is_array($this->WorkingData)) {
            $this->WorkingData = [];
            return $this->Modified = true;
        }
        return false;
    }

    /**
     * Get all cache entries.
     *
     * @return array An associative array containing all existent cache entries.
     */
    public function getAllEntries(): array
    {
        if ($this->Using === 'APCu') {
            $Data = apcu_cache_info();
            if (empty($Data['cache_list'])) {
                return [];
            }
            $Output = [];
            foreach ($Data['cache_list'] as $Entry) {
                if (empty($Entry['info'])) {
                    continue;
                }
                $Creation = isset($Entry['creation_time']) ? $Entry['creation_time'] : 0;
                $Entry['Data'] = $this->getEntry($Entry['info']);
                $Output[$Entry['info']] = $Entry['ttl'] > 0 ? [
                    'Data' => $Entry['Data'],
                    'Time' => $Creation + $Entry['ttl']
                ] : $Entry['Data'];
            }
            return $Output;
        }
        if ($this->Using === 'Memcached') {
            $Keys = $this->WorkingData->getAllKeys();
            if ($Keys !== false && $this->WorkingData->getDelayed($Keys)) {
                $Data = $this->WorkingData->fetchAll();
            }
            if (!is_array($Data)) {
                return [];
            }
            $Output = [];
            foreach ($Data as $Entry) {
                if (!is_array($Entry) || !isset($Entry['key'], $Entry['value'], $Entry['cas'])) {
                    continue;
                }
                $Output[$Entry['key']] = ['Data' => $this->unserializeEntry($Entry['value'])];
                if ($Entry['cas'] > 2592000) {
                    $Output[$Entry['key']]['Time'] = $Entry['cas'];
                } else {
                    $Output[$Entry['key']] = $Output[$Entry['key']]['Data'];
                }
            }
            return $Output;
        }
        if ($this->Using === 'Redis') {
            $Keys = $this->WorkingData->keys('*') ?: [];
            $Output = [];
            foreach ($Keys as $Key) {
                $Output[$Key] = $this->unserializeEntry($this->WorkingData->get($Key));
            }
            return $Output;
        }
        if ($this->Using === 'PDO') {
            if ($this->clearExpiredPDO()) {
                $this->Modified = true;
            }
            $PDO = $this->WorkingData->prepare(self::GET_ALL_QUERY);
            if ($PDO !== false && $PDO->execute()) {
                $Data = $PDO->fetchAll();
                $Output = [];
                foreach ($Data as $Entry) {
                    if (!is_array($Entry) || !isset($Entry['Key'], $Entry['Data'], $Entry['Time'])) {
                        continue;
                    }
                    $Output[$Entry['Key']] = $Entry['Time'] > 0 ? [
                        'Data' => $this->unserializeEntry($Entry['Data']),
                        'Time' => $Entry['Time']
                    ] : $this->unserializeEntry($Entry['Data']);
                }
                return $Output;
            }
            return [];
        }
        if ($Arr = ($this->exposeWorkingDataArray() ?: [])) {
            foreach ($Arr as &$Entry) {
                $Entry = $this->unserializeEntry($Entry);
            }
            return $Arr;
        }
        return [];
    }

    /**
     * Clears expired entries from an array-based cache (used for flatfile
     * caching).
     *
     * @param array $Data The array containing the cache data.
     * @return bool True if anything is cleared; False otherwise.
     */
    public function clearExpired(array &$Data): bool
    {
        $Cleared = false;
        $Updated = [];
        foreach ($Data as $Key => $Value) {
            if (is_array($Value)) {
                foreach ($Value as &$SubValue) {
                    if (is_array($SubValue)) {
                        if ($this->clearExpired($SubValue)) {
                            $Cleared = true;
                        }
                    }
                }
            }
            if (!is_array($Value) || !isset($Value['Time']) || $Value['Time'] > time()) {
                $Updated[$Key] = $Value;
            } else {
                $Cleared = true;
            }
        }
        $Data = $Updated;
        return $Cleared;
    }

    /**
     * Clears expired entries stored via PDO.
     *
     * @return bool True if anything is cleared; False otherwise.
     */
    public function clearExpiredPDO(): bool
    {
        if ($this->Using !== 'PDO') {
            return false;
        }
        $PDO = $this->WorkingData->prepare(self::CLEAR_EXPIRED_QUERY);
        if ($PDO !== false && $PDO->execute([':time' => time()])) {
            return ($PDO->rowCount() > 0);
        }
        return false;
    }

    /**
     * Unserialize a returned cache entry if necessary.
     *
     * @param mixed $Entry The returned cache entry.
     * @return mixed An unserialized array, if the returned cache entry is
     *      a serialized array, else the returned cache entry as verbatim.
     */
    public function unserializeEntry($Entry)
    {
        if (!$Entry || !is_string($Entry) || !preg_match('~^a\:\d+\:\{.*\}$~', $Entry)) {
            return $Entry;
        }
        $Arr = unserialize($Entry);
        if (is_array($Arr)) {
            $this->clearExpired($Arr);
            return $Arr;
        }
        return $Entry;
    }

    /**
     * Serialize a cache entry prior to committing if necessary.
     *
     * @param mixed $Entry The cache entry to be serialized.
     * @return mixed The cache entry as verbatim, or a serialized string.
     */
    public function serializeEntry($Entry)
    {
        return is_array($Entry) ? (serialize($Entry) ?: $Entry) : $Entry;
    }

    /**
     * Attempt to strip objects from a data set (useful for when data from
     * untrusted sources might potentially be being cached, which generally
     * should be avoided anyway due to the security risk, but including
     * this method here anyway, in case we mightn't have any choice in some
     * circumstances). To be called by the implementation.
     *
     * @param mixed $Entry The data set to strip from.
     * @return mixed The object-stripped data set.
     */
    public function stripObjects($Data)
    {
        if (is_object($Data)) {
            return false;
        }
        if (!is_array($Data)) {
            return $Data;
        }
        $Output = [];
        foreach ($Data as $Key => $Value) {
            if (is_object($Element)) {
                continue;
            }
            $Output[$Key] = $this->stripObjects($Value);
        }
        return $Output;
    }

    /**
     * Expose working data array (useful when integrating the instantiated
     * object to external caching mechanisms). To be called by the
     * implementation.
     *
     * @return array|bool The working data array, or false on error.
     */
    public function exposeWorkingDataArray()
    {
        if (!is_array($this->WorkingData)) {
            return false;
        }
        if ($this->clearExpired($this->WorkingData)) {
            $this->Modified = true;
        }
        return $this->WorkingData;
    }
}

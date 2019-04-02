<?php
/**
 * A simple, unified cache handler (last modified: 2019.04.02).
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

    /** Whether to try using Memcache. */
    public $EnableMemcache = false;

    /** Whether to try using Memcached. */
    public $EnableMemcached = false;

    /** Whether to try using Redis. */
    public $EnableRedis = false;

    /** Whether to try using PDO. */
    public $EnablePDO = false;

    /** The host for Memcache(/d) to try using. */
    public $MemcacheHost = 'localhost';

    /** The port for Memcache(/d) to try using. */
    public $MemcachePort = 11211;

    /** The timeout for Memcache to try using. */
    public $MemcacheTimeout = 1;

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
    const setQuery = 'INSERT INTO `Cache` (`Key`, `Data`, `Time`) values (:key, :data, :time) ON DUPLICATE KEY UPDATE `Data` = :data2, `Time` = :time2 WHERE `Key` = :key2';

    /** Prepared get query for PDO. */
    const getQuery = 'SELECT `Data` FROM `Cache` WHERE `Key` = :key LIMIT 1';

    /** Prepared delete query for PDO. */
    const deleteQuery = 'DELETE FROM `Cache` WHERE `Key` = :key';

    /** Prepared clear all query for PDO. */
    const clearQuery = 'DELETE FROM `Cache` WHERE 1';

    /** Prepared clear expired query for PDO. */
    const clearExpiredQuery = 'DELETE FROM `Cache` WHERE `Time` > 0 AND `TIME < :time';

    /** Default blocksize for file reading operations. */
    const BLOCKSIZE = 262144;

    /** Number of seconds to try flocking a resource before giving up. */
    const FLOCK_TIMEOUT = 10;

    /**
     * Construct object, set whatever default values are needed, and optionally
     * define some default cache data via an array.
     *
     * @param array|null $WorkingData An optional array of default cache data.
     */
    public function __construct($WorkingData = null)
    {
        if (extension_loaded('memcache')) {
            /** Set the default value for the Memcache port to use. */
            if (!extension_loaded('memcached') && $Config = ini_get('memcache.default_port')) {
                $this->MemcachePort = $Config;
            }
        }
        if (is_array($WorkingData)) {
            $this->WorkingData = $WorkingData;
        }
    }

    /**
     * Object destructor. Used to close any open connections, save cache to disk, etc.
     */
    public function __destruct()
    {
        if ($this->Using === 'Memcache' || $this->Using === 'Redis') {
            $this->WorkingData->close();
            return;
        }
        if ($this->Using === 'Memcached') {
            $this->WorkingData->quit();
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
                $Handle = fopen($this->FFDefault, 'wb');
                $Start = time();
                while (true) {
                    if ($Locked = flock($Handle, LOCK_EX | LOCK_NB) || (time() - $Start) > self::FLOCK_TIMEOUT) {
                        break;
                    }
                    sleep(1);
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
    public function connect()
    {
        if ($this->EnableAPCu && extension_loaded('apcu') && ini_get('apc.enabled')) {
            $this->Using = 'APCu';
            return true;
        }
        if ($this->EnableMemcache && extension_loaded('memcache')) {
            $this->WorkingData = new \Memcache();
            if ($this->WorkingData->connect($this->MemcacheHost, $this->MemcachePort, $this->MemcacheTimeout)) {
                $this->Using = 'Memcache';
                return true;
            }
            $this->WorkingData = null;
        }
        if ($this->EnableMemcached && extension_loaded('memcached')) {
            $this->WorkingData = new \Memcached();
            if ($this->WorkingData->addServer($this->MemcacheHost, $this->MemcachePort)) {
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
                return true;
            }
            unset($PDO);
        }
        if ($this->FFDefault) {
            if (is_file($this->FFDefault)) {
                if (is_readable($this->FFDefault) && is_writable($this->FFDefault)) {
                    $Filesize = filesize($this->FFDefault);
                    $Size = ($Filesize && self::BLOCKSIZE) ? ceil($Filesize / self::BLOCKSIZE) : 0;
                    $Data = '';
                    if ($Size > 0) {
                        $Handle = fopen($this->FFDefault, 'rb');
                        $Start = time();
                        while (true) {
                            if ($Locked = flock($Handle, LOCK_EX | LOCK_NB) || (time() - $Start) > self::FLOCK_TIMEOUT) {
                                break;
                            }
                            sleep(1);
                        }
                        if ($Locked) {
                            $Step = 0;
                            while ($Step < $Size) {
                                $Data .= fread($Handle, self::BLOCKSIZE);
                                $Step++;
                            }
                            flock($Handle, LOCK_UN);
                        }
                        fclose($Handle);
                    }
                    $Data = $Data ? unserialize($Data) : [];
                    $this->WorkingData = is_array($Data) ? $Data : [];
                    $this->Using = 'FF';
                    return $Locked;
                }
            } else {
                $Parent = dirname($this->FFDefault);
                if (is_dir($Parent) && is_readable($Parent) && is_writable($Parent)) {
                    $this->WorkingData = [];
                    $this->Using = 'FF';
                    return $this->Modified = true;
                }
            }
        }
        return is_array($this->WorkingData);
    }

    /**
     * Get a cache entry.
     *
     * @param string $Entry The name of the cache entry to get.
     * @return mixed The retrieved cache entry, or false on failure (e.g., if the cache entry doesn't exist).
     */
    public function getEntry($Entry)
    {
        if ($this->Using === 'APCu') {
            return apcu_fetch($Entry);
        }
        if ($this->Using === 'Memcache' || $this->Using === 'Memcached' || $this->Using === 'Redis') {
            return $this->WorkingData->get($Entry);
        }
        if ($this->Using === 'PDO') {
            if ($this->clearExpiredPDO()) {
                $this->Modified = true;
            }
            $PDO = $this->WorkingData->prepare(self::getQuery);
            if ($PDO !== false && $PDO->execute(['key' => $Entry])) {
                $Data = $PDO->fetch(\PDO::FETCH_ASSOC);
                return isset($Data['Data']) ? $Data['Data'] : false;
            }
            return false;
        }
        if (is_array($this->WorkingData) && isset($this->WorkingData[$Entry])) {
            if (isset($this->WorkingData[$Entry]['Data']) && isset($this->WorkingData[$Entry]['Time'])) {
                if ($this->WorkingData[$Entry]['Time'] > time()) {
                    return $this->WorkingData[$Entry]['Data'];
                }
                unset($this->WorkingData[$Entry]);
                $this->Modified = true;
                return false;
            }
            return $this->WorkingData[$Entry];
        }
        return false;
    }

    /**
     * Set a cache entry.
     *
     * @param string $Key The name of the cache entry to set.
     * @param mixed $Value The value of the cache entry to get.
     * @param int $TTL The number of seconds that the cache entry should persist.
     * @return bool True on success; False on failure.
     */
    public function setEntry($Key, $Value, $TTL = 3600)
    {
        if ($this->Using === 'APCu') {
            if (apcu_store($Key, $Value, $TTL)) {
                return $this->Modified = true;
            }
            return false;
        }
        if ($this->Using === 'Memcache') {
            if ($TTL >= 2592000) {
                $TTL += time();
            }
            if ($this->WorkingData->set($Key, $Value, 0, $TTL)) {
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
            $PDO = $this->WorkingData->prepare(self::setQuery);
            if ($PDO !== false && $PDO->execute([
                'key' => $Key,
                'data' => $Value,
                'time' => $TTL,
                'key2' => $Key,
                'data2' => $Value,
                'time2' => $TTL
            ])) {
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
    public function deleteEntry($Entry)
    {
        if ($this->Using === 'APCu') {
            if (apcu_delete($Entry)) {
                return $this->Modified = true;
            }
            return false;
        }
        if ($this->Using === 'Memcache' || $this->Using === 'Memcached' || $this->Using === 'Redis') {
            if ($this->WorkingData->delete($Entry)) {
                return $this->Modified = true;
            }
            return false;
        }
        if ($this->Using === 'PDO') {
            $PDO = $this->WorkingData->prepare(self::deleteQuery);
            if ($PDO !== false && $PDO->execute(['key' => $Entry])) {
                return ($PDO->rowCount() > 0 && $this->Modified = true);
            }
            return false;
        }
        if (is_array($this->WorkingData)) {
            if (isset($this->WorkingData[$Key])) {
                unset($this->WorkingData[$Key]);
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
    public function clearCache()
    {
        if ($this->Using === 'APCu') {
            return $this->Modified = apcu_clear_cache();
        }
        if ($this->Using === 'Memcache' || $this->Using === 'Memcached') {
            if ($this->WorkingData->flush()) {
                return $this->Modified = true;
            }
            return false;
        }
        if ($this->Using === 'Redis') {
            return $this->Modified = $this->WorkingData->flushDb();
        }
        if ($this->Using === 'PDO') {
            $PDO = $this->WorkingData->prepare(self::clearQuery);
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
     * Clears expired entries from an array-based cache (used for flatfile
     * caching).
     *
     * @param array $Data The array containing the cache data.
     * @return bool True if anything is cleared; False otherwise.
     */
    public function clearExpired(&$Data)
    {
        if (!is_array($Data)) {
            return false;
        }
        $Cleared = false;
        $Updated = [];
        foreach ($Data as $Entry) {
            if (is_array($Entry) && isset($Entry['Data']) && is_array($Entry['Data'])) {
                if ($this->clearExpired($Entry['Data'])) {
                    $Cleared = true;
                }
            }
            if (!is_array($Entry) || !isset($Entry['Time']) || $Entry['Time'] > time()) {
                $Updated[] = $Entry;
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
    public function clearExpiredPDO()
    {
        if ($this->Using !== 'PDO') {
            return false;
        }
        $PDO = $this->WorkingData->prepare(self::clearExpiredQuery);
        if ($PDO !== false && $PDO->execute(['time' => time()])) {
            return ($PDO->rowCount() > 0);
        }
        return false;
    }

    /**
     * Expose working data array (useful when integrating the instantiated
     * object to external caching mechanisms).
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

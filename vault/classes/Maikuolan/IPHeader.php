<?php
/**
 * IP header class (last modified: 2023.01.22).
 *
 * This file is a part of the "common classes package", utilised by a number of
 * packages and projects, including CIDRAM and phpMussel.
 * @link https://github.com/Maikuolan/Common
 *
 * License: GNU/GPLv2
 * @see LICENSE.txt
 *
 * "COMMON CLASSES PACKAGE" COPYRIGHT 2019 and beyond by Caleb Mazalevskis.
 * *This particular class*, COPYRIGHT 2022 and beyond by Caleb Mazalevskis.
 */

namespace Maikuolan\Common;

class IPHeader
{
    /**
     * @var string The IP address resolved by the instance.
     */
    public $Resolution = '';

    /**
     * @var string Where the IP address was resolved from.
     */
    public $Source = '';

    /**
     * @var int The address type for the last valid address checked (4 or 6).
     */
    public $Type = 0;

    /**
     * @var string The tag/release the version of this file belongs to (might
     *      be needed by some implementations to ensure compatibility).
     * @link https://github.com/Maikuolan/Common/tags
     */
    const VERSION = '1.9.4';

    /**
     * Constructor.
     *
     * @param string $Source The preferred source to use for the IP header.
     * @return void
     */
    public function __construct($Source = '')
    {
        /** Guard. */
        if (!is_string($Source) || $Source === '') {
            $Source = 'REMOTE_ADDR';
        }

        /** Try the preferred source. */
        $Resolution = $this->trySource($Source);

        /** If it failed, but we're not using REMOTE_ADDR, try that instead. */
        if ($Resolution === '' && $Source !== 'REMOTE_ADDR') {
            $Source = 'REMOTE_ADDR';
            $Resolution = $this->trySource($Source);
        }

        /** If it's still failing, may as well give up here. */
        if ($Resolution === '') {
            return;
        }

        /** Success! Populate the resolution and mark what we used. */
        $this->Resolution = $Resolution;
        $this->Source = $Source;
    }

    /**
     * Check whether an IPv4 address is valid.
     *
     * @param string $IP The address to check.
     * @return bool True for valid; False for invalid.
     */
    public function isValidIpv4($IP)
    {
        return is_string($IP) && preg_match(
            '/^([01]?\d{1,2}|2[0-4]\d|25[0-5])\.([01]?\d{1,2}|2[0-4]\d|25[0-5])\.([01]?\d{1,2}|2[0-4]\d|25[0-5])\.([01]?\d{1,2}|2[0-4]\d|25[0-5])$/',
            $IP
        );
    }

    /**
     * Check whether an IPv6 address is valid.
     *
     * @param string $IP The address to check.
     * @return bool True for valid; False for invalid.
     */
    public function isValidIpv6($IP)
    {
        /**
         * This regular expression adapted from that found at:
         * @link https://sroze.io/regex-ip-v4-et-ipv6-6cc005cabe8c
         */
        return is_string($IP) && preg_match(
            '/^((([\da-f]{1,4}:){7}[\da-f]{1,4})|(([\da-f]{1,4}:){6}:[\da-f]{1,4})' .
            '|(([\da-f]{1,4}:){5}:([\da-f]{1,4}:)?[\da-f]{1,4})|(([\da-f]{1,4}:){4' .
            '}:([\da-f]{1,4}:){0,2}[\da-f]{1,4})|(([\da-f]{1,4}:){3}:([\da-f]{1,4}' .
            ':){0,3}[\da-f]{1,4})|(([\da-f]{1,4}:){2}:([\da-f]{1,4}:){0,4}[\da-f]{' .
            '1,4})|(([\da-f]{1,4}:){6}((\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2})' .
            ')\b).){3}(\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b))|(([\da-f]{1' .
            ',4}:){0,5}:((\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b).){3}(\b((' .
            '25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b))|(::([\da-f]{1,4}:){0,5}((' .
            '\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b).){3}(\b((25[0-5])|(1\d' .
            '{2})|(2[0-4]\d)|(\d{1,2}))\b))|([\da-f]{1,4}::([\da-f]{1,4}:){0,5}[\d' .
            'a-f]{1,4})|(::([\da-f]{1,4}:){0,6}[\da-f]{1,4})|(([\da-f]{1,4}:){1,7}' .
            ':))$/i',
            $IP
        );
    }

    /**
     * Try a source.
     *
     * @param string $Source The source to try.
     * @return string The resolved IP address (or an empty string on failure).
     */
    public function trySource($Source)
    {
        /** Fail immediately if the source isn't available. */
        if (!isset($_SERVER[$Source]) || strlen($_SERVER[$Source]) === 0) {
            return '';
        }

        $Try = $_SERVER[$Source];
        $Matches = [];

        /** Ensure that we're working with a string. */
        if (is_array($Try)) {
            $Try = array_shift($Try);
        }

        /**
         * Check for "Forwarded"-like syntax.
         * @link https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Forwarded
         */
        if (preg_match_all('~for="?\[?([\da-f.:]+)(?:[\]";,]|$)~i', $Try, $Matches) && isset($Matches[1])) {
            foreach ($Matches[1] as $Match) {
                if ($this->isValidIpv4($Match)) {
                    $this->Type = 4;
                    return $Match;
                }
                if ($this->isValidIpv6($Match)) {
                    $this->Type = 6;
                    return $Match;
                }
            }
        }
        $Matches = [];

        /**
         * Check for "X-Forwarded-For"-like syntax.
         * @link https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/X-Forwarded-For
         */
        if (preg_match_all('~([\da-f.:]+)(?:,|$)~i', $Try, $Matches) && isset($Matches[1])) {
            foreach ($Matches[1] as $Match) {
                if ($this->isValidIpv4($Match)) {
                    $this->Type = 4;
                    return $Match;
                }
                if ($this->isValidIpv6($Match)) {
                    $this->Type = 6;
                    return $Match;
                }
            }
        }

        /** Attempt to validate and return the resolved address verbatim. */
        if ($this->isValidIpv4($Try)) {
            $this->Type = 4;
            return $Try;
        }
        if ($this->isValidIpv6($Try)) {
            $this->Type = 6;
            return $Try;
        }

        /** Fail if nothing valid could be resolved. */
        return '';
    }
}

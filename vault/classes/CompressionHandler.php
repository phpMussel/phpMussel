<?php
/**
 * This file is a part of the phpMussel package.
 * Homepage: https://phpmussel.github.io/
 *
 * PHPMUSSEL COPYRIGHT 2013 AND BEYOND BY THE PHPMUSSEL TEAM.
 *
 * Authors:
 * @see PEOPLE.md
 *
 * License: GNU/GPLv2
 * @see LICENSE.txt
 *
 * This file: Compression handler (last modified: 2019.08.06).
 */

namespace phpMussel\CompressionHandler;

class CompressionHandler
{
    /** The data to be worked upon. */
    public $Data = '';

    /** If the class triggers any errors, they'll be stored here. */
    public $Errors = [];

    /**
     * @param string $Data The data to be worked upon.
     */
    public function __construct($Data)
    {
        $this->Data = $Data;
    }

    /**
     * The basis for the other try methods.
     *
     * @param string $Using What the try methods uses.
     * @return int 0 = Success. 1 = Missing prerequisite. 2 = Failure.
     */
    private function TryX($Using)
    {
        /** Guard. */
        if (!function_exists($Using)) {
            return 1;
        }

        /** Try to decompress. */
        $Try = $Using($this->Data);

        /** Success. */
        if ($Try !== false && is_string($Try)) {
            $this->Data = $Try;
            return 0;
        }

        /** Failure. */
        return 2;
    }

    /**
     * Try to decompress using GZ.
     *
     * @return int 0 = Success. 1 = Missing prerequisite. 2 = Failure.
     */
    public function TryGz()
    {
        /** Guard. */
        if (substr($this->Data, 0, 2) !== "\x1f\x8b") {
            return 2;
        }

        /** Continue. */
        return $this->TryX('gzdecode');
    }

    /**
     * Try to decompress using BZ.
     *
     * @return int 0 = Success. 1 = Missing prerequisite. 2 = Failure.
     */
    public function TryBz()
    {
        /** Guard. */
        if (substr($this->Data, 0, 3) !== "\x42\x5a\x68") {
            return 2;
        }

        /** Continue. */
        return $this->TryX('bzdecompress');
    }

    /**
     * Try to decompress using LZF.
     *
     * @return int 0 = Success. 1 = Missing prerequisite. 2 = Failure.
     */
    public function TryLzf()
    {
        return $this->TryX('lzf_decompress');
    }

    /**
     * Try everything.
     *
     * @return bool The state of the data before and after trying is the same when true is
     *      returned, different when false is returned.
     */
    public function TryEverything()
    {
        /** Fetch original data state. */
        $Original = $this->Data;

        /** For tracking errors. */
        $Errors = &$this->Errors;

        /**
         * Seeing as we're effectively guessing which compression format has
         * been used, and possibly it mightn't be compressed at all, there'll
         * probably be warnings and notices generated. So, let's handle that
         * cleanly.
         */
        set_error_handler(function ($errno, $errstr, $errfile, $errline) use (&$Errors) {
            $Errors[] = [$errno, $errstr, $errfile, $errline];
        });

        /** Loop until data state doesn't change anymore. */
        while (true) {
            if ($this->TryGz() === 0) {
                continue;
            }
            if ($this->TryBz() === 0) {
                continue;
            }
            if ($this->TryLzf() === 0) {
                continue;
            }
            break;
        }

        /** We're done guessing, so we'll restore the previous error handler. */
        restore_error_handler();

        /**
         * Compare original data state against current data state, and return
         * whether they're the same or different. If the same, then data
         * probably wasn't compressed to begin with.
         */
         return ($Original === $this->Data);
    }
}

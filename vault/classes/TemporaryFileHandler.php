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
 * This file: Temporary file handler (last modified: 2018.10.15).
 */

namespace phpMussel\TemporaryFileHandler;

class TemporaryFileHandler
{
    /** To be populated by a reference to the temporary file. */
    public $Filename = '';

    /**
     * @param string $Content The temporary file content.
     * @param string $Location The temporary file location.
     */
    public function __construct($Content, $Location)
    {
        /** Pad the location if necessary. */
        if (substr($Location, -1) !== '/' && substr($Location, -1) !== "\\") {
            $Location .= '/';
        }

        /** If we can't write to the specified location, exit early. */
        if (!is_dir($Location) || !is_writable($Location)) {
            return;
        }

        /** Let's generate a unique name for the temporary file. */
        $Filename = time() . '-' . md5($Content) . '.tmp';

        /** Now let's attempt to create the temporary file. */
        if ($Handle = fopen($Location . $Filename, 'wb')) {
            fwrite($Handle, $Content);
            fclose($Handle);

            /** And update the reference to the temporary file. */
            $this->Filename = $Location . $Filename;
        }
    }

    /** Destructor will unlink the temporary file upon object destruction. */
    public function __destruct()
    {
        if ($this->Filename && file_exists($this->Filename)) {
            unlink($this->Filename);
        }
    }
}

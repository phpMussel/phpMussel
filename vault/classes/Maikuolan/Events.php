<?php
/**
 * Events orchestrator (last modified: 2021.07.02).
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

class Events
{
    /**
     * @var array Event handlers.
     */
    private $Handlers = [];

    /**
     * @var array The status of various events and their handlers.
     */
    private $Status = [];

    /**
     * @var string The tag/release the version of this file belongs to (might
     *      be needed by some implementations to ensure compatibility).
     * @link https://github.com/Maikuolan/Common/tags
     */
    public const VERSION = '2.6.2';

    /**
     * Adds a new event handler.
     *
     * @param string $Event The event to fire the handler.
     * @param callable $Handler The handler to add.
     * @param bool $Replace Whether to replace any/all existing handlers.
     * @return bool True on success; False on failure.
     */
    public function addHandler(string $Event, callable $Handler, bool $Replace = false): bool
    {
        if ($Replace || !isset($this->Handlers[$Event])) {
            $this->Handlers[$Event] = [];
            $this->Status[$Event] = ['Protected' => false];
        } elseif (!empty($this->Status[$Event]['Protected'])) {
            return false;
        }
        $this->Handlers[$Event][] = $Handler;
        return true;
    }

    /**
     * Adds a final new event handler.
     *
     * @param string $Event The event to fire the handler.
     * @param callable $Handler The handler to add.
     * @param bool $Replace Whether to replace any/all existing handlers.
     * @return bool True on success; False on failure.
     */
    public function addHandlerFinal(string $Event, callable $Handler, bool $Replace = false): bool
    {
        if ($Replace || !isset($this->Handlers[$Event])) {
            $this->Handlers[$Event] = [];
            $this->Status[$Event] = [];
        } elseif (!empty($this->Status[$Event]['Protected'])) {
            return false;
        }
        $this->Handlers[$Event][] = $Handler;
        $this->Status[$Event]['Protected'] = true;
        return true;
    }

    /**
     * Destroys an event and all associated handlers.
     *
     * @param string $Event The event to destroy.
     * @return bool True on success; False on failure.
     */
    public function destroyEvent(string $Event): bool
    {
        if (!isset($this->Handlers[$Event], $this->Status[$Event])) {
            return false;
        }
        unset($this->Handlers[$Event], $this->Status[$Event]);
        return true;
    }

    /**
     * Fire an event.
     *
     * @param string $Event The event to fire.
     * @param string $Data The data to send to the event handlers.
     * @param mixed $Misc,... Anything that needs to be passed by reference.
     * @return bool True on success; False on failure.
     */
    public function fireEvent(string $Event, string $Data = '', &...$Misc): bool
    {
        if (!isset($this->Handlers[$Event], $this->Status[$Event])) {
            return false;
        }
        foreach ($this->Handlers[$Event] as $Handler) {
            $Handler($Data, $Misc);
        }
        return true;
    }

    /**
     * Check whether an event has had any handlers assigned to it (useful in
     * case some data needs to be processed prior to calling fireEvent).
     *
     * @param string $Event The event to check.
     * @return bool True if so; False if not so.
     */
    public function assigned(string $Event): bool
    {
        return isset($this->Handlers[$Event], $this->Status[$Event]);
    }
}

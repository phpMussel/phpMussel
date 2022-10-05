<?php
/**
 * Events orchestrator (last modified: 2022.10.05).
 *
 * This file is a part of the "common classes package", utilised by a number of
 * packages and projects, including CIDRAM and phpMussel.
 * @link https://github.com/Maikuolan/Common
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
    const VERSION = '1.9.2';

    /**
     * Adds a new event handler.
     *
     * @param string $Event The event to fire the handler.
     * @param callable $Handler The handler to add.
     * @param bool $Replace Whether to replace any/all existing handlers.
     * @return bool True on success; False on failure.
     */
    public function addHandler($Event, callable $Handler, $Replace = false)
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
    public function addHandlerFinal($Event, callable $Handler, $Replace = false)
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
    public function destroyEvent($Event)
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
     * @return bool True on success; False on failure.
     */
    public function fireEvent($Event, $Data = '')
    {
        if (!isset($this->Handlers[$Event], $this->Status[$Event])) {
            return false;
        }
        foreach ($this->Handlers[$Event] as $Handler) {
            $Handler($Data);
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
    public function assigned($Event)
    {
        return isset($this->Handlers[$Event], $this->Status[$Event]);
    }
}

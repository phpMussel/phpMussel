<?php

namespace phpMussel;

/**
 * Function serves as a quick-and-lazy way to render some text as
 * plain-text to the page output (for browsers) and to then kill the
 * script. Nothing special; Just means that we can do this with one
 * function call rather than three different calls (header, echo, die), to
 * save time.
 *
 * @deprecated Don't use this. Will kill it off by the next minor or major
 *      version/release.
 * @param string $out The text to be rendered.
 */
function plaintext_echo_die($out) {
    header('Content-Type: text/plain');
    echo $out;
    die;
}

/**
 * The `phpMussel_Register_Hook` function is used to register plugin
 * functions to their intended hooks.
 *
 * @since v0.9.0
 * @param string $what The name of the chosen function to execute at the
 *      desired point in the script.
 * @param string $where Instructs the function which "hook" your chosen
 *      function should be registered to.
 * @param string|array $with Represents the variables that need to be
 *      parsed to your function from the scope in which it'll be executed
 *      from (optional).
 * @return bool
 */
function registerHook($what, $where, $with='') {
    if (!isset($GLOBALS['MusselPlugins']['hooks']) || !isset($GLOBALS['MusselPlugins']['hookcounts'])) {
        return false;
    }
    if (!isset($GLOBALS['MusselPlugins']['hooks'][$where])) {
        $GLOBALS['MusselPlugins']['hooks'][$where]=array();
    }
    if (!isset($GLOBALS['MusselPlugins']['hookcounts'][$where])) {
        $GLOBALS['MusselPlugins']['hookcounts'][$where]=0;
    }
    $GLOBALS['MusselPlugins']['hooks'][$where][$what]=$with;
    $GLOBALS['MusselPlugins']['hookcounts'][$where]++;
    return true;
}

/**
 * This is a specialised search-and-replace function, designed to replace
 * encapsulated substrings within a given input string based upon the
 * elements of a given input array. The function accepts two input
 * parameters: The first, the input array, and the second, the input
 * string. The function searches for any instances of each array key,
 * encapsulated by curly brackets, as substrings within the input string,
 * and replaces any instances found with the array element content
 * corresponding to the array key associated with each instance found.
 *
 * This function is used extensively throughout phpMussel, to parse its
 * language data and to parse any messages related to any detections found
 * during the scan process and any other related processes.
 *
 * ToDo: Flag to @api if it works properly
 *
 * @since v0.6j
 * @param array $pairs The input array.
 * @param string $string The input string.
 * @return string the resulting string
 */
function injectInto(array $pairs, $string) {
    if ( ! is_array($pairs) || empty($string)) {
        return '';
    }

    /**
     * Changed logic: Speed.
     * @author Matthias Kaschubowski
     */
    foreach ( $pairs as $key => $value )
    {
        $string = str_replace("{{$key}}", $value, $string);
    }

    return $string;
}

function fetchWebVar($name)
{
    if ( array_key_exists($name, $_POST) ) {
        return $_POST[$name];
    }

    if ( array_key_exists($name, $_GET) ) {
        return $_GET[$name];
    }

    return '';
}

<?php

namespace phpMussel\Benchmark;

use Athletic\AthleticEvent;

class Replacement extends AthleticEvent
{
    private $data;
    private $string;

    public function setUp()
    {
        $this->data = array();
        $this->string = "";

        $this->originParser = function($v, $b) {
            if ( ! is_array($v) || empty($b) )
            {
                return '';
            }

            $c = count($v);
            reset($v);
            for ($i = 0; $i < $c; $i++)
            {
                $k = key($v);
                $b = str_replace('{'.$k.'}', $v[$k], $b);
                next($v);
            }
            return $b;
        };

        foreach ( range('a', 'z') as $letter )
        {
            $this->data[$letter] = uniqid();
            $this->string .= sprintf('%s {%s} ', uniqid(), $letter);
        }
    }

    /**
     * @iterations 50000
     */
    public function originReplacer()
    {
        call_user_func($this->originParser, $this->data, $this->string);
    }

    /**
     * @iterations 50000
     */
    public function actualReplacer()
    {
        \phpMussel\injectInto($this->data, $this->string);
    }
}

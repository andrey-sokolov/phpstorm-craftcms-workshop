<?php

namespace workshop\lang\lexer;

class Token {
    /**
     * @var string
     */
    private $value;
    /**
     * @var int
     * @see TokenTypes
     */
    private $type;

    /**
     * @param $value
     * @param $type
     */
    public function __construct($value, $type) {
        $this->value = $value;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * @see TokenTypes
     * @return int
     */
    public function getType() {
        return $this->type;
    }
}
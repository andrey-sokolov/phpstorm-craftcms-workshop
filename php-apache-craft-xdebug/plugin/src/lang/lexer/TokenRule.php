<?php
/**
 * Created by PhpStorm.
 * User: wbars
 * Date: 18/09/2018
 * Time: 12:07
 */

namespace workshop\lang\lexer;

class TokenRule {
    /**
     * @var int
     */
    public $tokenType;
    /**
     * @var \Closure
     */
    public $condition;

    /**
     * TokenRule constructor.
     * @param $tokenType
     * @param $condition
     */
    public function __construct($tokenType, $condition) {
        $this->tokenType = $tokenType;
        $this->condition = $condition;
    }

    private function test($tokenValue) {
        $condition = $this->condition;
        return $condition($tokenValue);
    }

    public function __invoke($tokenValue) {
        return $this->test($tokenValue);
    }
}
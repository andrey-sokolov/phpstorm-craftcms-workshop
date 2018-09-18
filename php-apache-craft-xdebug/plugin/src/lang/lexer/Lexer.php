<?php

namespace workshop\lang\lexer;

class Lexer {
    /**
     * @var Token[]
     */
    private $tokens = [];
    /**
     * @var TokenRule[]
     */
    private $rules;
    private $index = 0;
    /**
     * @var string
     */
    private $content;
    /**
     * @var string
     */
    private $length;
    private $startIndex = 0;

    public static function parseTokens($content) {
        $lexer = new Lexer($content);
        $lexer->parse();
        return $lexer->tokens;
    }

    private function __construct($content) {
        $this->content = $content;
        $this->length = strlen($this->content);

        $this->registerScalar(TokenTypes::ECHO, "echo");

        $this->registerScalar(TokenTypes::PLUS, "+");
        $this->registerScalar(TokenTypes::MINUS, "-");
        $this->registerScalar(TokenTypes::MULTIPLY, "*");
        $this->registerScalar(TokenTypes::DIVIDE, "/");
        $this->registerScalar(TokenTypes::EQUALS, "=");

        $this->register(TokenTypes::NUMBER, function ($tokenValue) {
            return ctype_digit($tokenValue);
        });

        $this->register(TokenTypes::WHITESPACE, function ($tokenValue) {
            return empty(trim($tokenValue));
        });
        $this->register(TokenTypes::IDENTIFIER, function ($tokenValue) {
            if (empty($tokenValue)) return false;
            if (!ctype_alpha(substr($tokenValue, 0, 1))) return false;
            $tail = substr($tokenValue, 1);
            return empty($tail) || ctype_alnum($tail);
        });
    }

    private function parse() {
        while ($this->hasCharsLeft()) {
            $this->startIndex = $this->index;
            $this->parseToken();
        }
    }

    private function parseToken() {
        $lastToken = null;
        while ($this->hasCharsLeft()) {
            $this->index++;
            $token = $this->locateToken();
            if ($token == null) break;
            $lastToken = $token;
        }
        $this->tokens[] = $lastToken;
    }

    private function locateToken() {
        $tokenValue = substr($this->content, $this->startIndex, $this->index - $this->startIndex);
        foreach ($this->rules as $rule) {
            if ($rule($tokenValue)) {
                return new Token($tokenValue, $rule->tokenType);
            }
        }
        $this->index--;
        return null;
    }

    private function hasCharsLeft(): bool {
        return $this->index < $this->length;
    }

    private function register(int $tokenType, \Closure $condition) {
        $this->rules[] = new TokenRule($tokenType, $condition);
    }

    private function registerScalar(int $tokenType, string $scalarValue) {
        $this->register($tokenType, function ($tokenValue) use ($scalarValue) {
            return $scalarValue === $tokenValue;
        });
    }
}


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

    private function __construct($content) {
        $this->content = $content;
        $this->length = strlen($this->content);

        $this->registerScalar(TokenTypes::ECHO, "echo");
        $this->register(TokenTypes::IDENTIFIER, function ($tokenValue) {
            if (empty($tokenValue)) return false;
            if (!ctype_alpha(substr($tokenValue, 0, 1))) return false;
            $tail = substr($tokenValue, 1);
            return empty($tail) || ctype_alnum($tail);
        });

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
    }

    private function parse() {
        while ($this->hasCharsLeft()) {
            $this->startIndex = $this->index;
            $this->parseToken();
        }
    }

    public static function parseTokens($content) {
        $lexer = new Lexer($content);
        $lexer->parse();
        return $lexer->tokens;
    }

    private function parseToken() {
        $lastToken = null;
        $lastIndex = 0;
        while ($this->hasCharsLeft()) {
            $this->index++;
            $token = $this->locateToken();
            if ($token === null) {
                $lastIndex = $this->index;
                $this->index--;
                break;
            }
            $lastToken = $token;
        }
        if ($lastToken == null) {
            throw new \Exception("Invalid token: " . substr($this->content, $this->startIndex, $lastIndex - $this->startIndex));
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
<?php
/**
 * Created by PhpStorm.
 * User: wbars
 * Date: 17/08/2018
 * Time: 16:28
 */

namespace lang\lexer;

use PHPUnit\Framework\TestCase;
use workshop\lang\lexer\Lexer;
use workshop\lang\lexer\TokenTypes;

class LexerTest extends TestCase {

    /**
     * @covers \workshop\lang\lexer\Lexer
     */
    public function testParseBasicTokens() {
        $tokens = Lexer::parseTokens("ab + - / * 12 echo =   ");
        $tokenTypes = array_map(function ($token) {
            return $token->getType();
        }, $tokens);
        $tokenValues = array_map(function ($token) {
            return $token->getValue();
        }, $tokens);
        self::assertEquals([
            TokenTypes::IDENTIFIER,
            TokenTypes::WHITESPACE,
            TokenTypes::PLUS,
            TokenTypes::WHITESPACE,
            TokenTypes::MINUS,
            TokenTypes::WHITESPACE,
            TokenTypes::DIVIDE,
            TokenTypes::WHITESPACE,
            TokenTypes::MULTIPLY,
            TokenTypes::WHITESPACE,
            TokenTypes::NUMBER,
            TokenTypes::WHITESPACE,
            TokenTypes::ECHO,
            TokenTypes::WHITESPACE,
            TokenTypes::EQUALS,
            TokenTypes::WHITESPACE,
        ], $tokenTypes);

        $this->assertEquals([
            "ab",
            " ",
            "+",
            " ",
            "-",
            " ",
            "/",
            " ",
            "*",
            " ",
            "12",
            " ",
            "echo",
            " ",
            "=",
            "   ",
        ], $tokenValues);
    }

    /**
     * @covers \workshop\lang\lexer\Lexer::parseToken
     */
    public function testInvalidToken() {
        $this->expectExceptionMessage("Invalid token: %");
        Lexer::parseTokens("%");
    }

    public function testIdentifierStartsWithAlpha() {
        $tokens = Lexer::parseTokens("1a1");
        $this->assertEquals(TokenTypes::NUMBER, $tokens[0]->getType());
        $this->assertEquals("1", $tokens[0]->getValue());

        $this->assertEquals(TokenTypes::IDENTIFIER, $tokens[1]->getType());
        $this->assertEquals("a1", $tokens[1]->getValue());
    }
}

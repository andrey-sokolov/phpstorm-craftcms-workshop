<?php
/**
 * Created by PhpStorm.
 * User: wbars
 * Date: 17/08/2018
 * Time: 16:28
 */

namespace lang\lexer;

use PHPUnit\Framework\TestCase;
use workshop\lang\lexer\Scanner;
use workshop\lang\lexer\TokenTypes;

class LexerTest extends TestCase {
    /**
     * @dataProvider basicTokensProvider
     */
    public function testParseBasicTokens($tokenValue, $tokenType)
    {
        $tokens = Scanner::parseTokens($tokenValue);
        $this->assertEquals(1, count($tokens));
        $this->assertEquals($tokenType, $tokens[0]->getType());
    }

    public function basicTokensProvider()
    {
        return [
            ["a", TokenTypes::IDENTIFIER],
            ["1", TokenTypes::NUMBER],
            [" ", TokenTypes::WHITESPACE],
            ["+", TokenTypes::PLUS],
            ["-", TokenTypes::MINUS],
            ["/", TokenTypes::DIVIDE],
            ["*", TokenTypes::MULTIPLY],
            ["=", TokenTypes::EQUALS],
            ["echo", TokenTypes::ECHO],
            ["echoecho", TokenTypes::IDENTIFIER],
        ];
    }

    /**
     * @covers \workshop\lang\lexer\Scanner
     */
    public function testParseCompositionOfTokens()
    {
        $tokens = Scanner::parseTokens("ab + - / * 12 echo =   ");
        $array_map = array_map(function ($token) {
            return $token->getType();
        }, $tokens);
        $tokenTypes = $array_map;
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

    public function testIdentifierStartsWithAlpha() {
        $tokens = Scanner::parseTokens("1a1");
        $this->assertEquals(TokenTypes::NUMBER, $tokens[0]->getType());
        $this->assertEquals("1", $tokens[0]->getValue());

        $this->assertEquals(TokenTypes::IDENTIFIER, $tokens[1]->getType());
        $this->assertEquals("a1", $tokens[1]->getValue());
    }
}

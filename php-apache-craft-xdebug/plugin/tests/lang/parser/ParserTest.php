<?php
/**
 * Created by PhpStorm.
 * User: wbars
 * Date: 17/08/2018
 * Time: 17:37
 */

namespace lang\parser;

use Exception;
use PHPUnit\Framework\TestCase;
use workshop\lang\lexer\Lexer;
use workshop\lang\lexer\TokenTypes;
use workshop\lang\parser\nodes\AssignmentNode;
use workshop\lang\parser\nodes\BinaryStatementNode;
use workshop\lang\parser\nodes\EchoNode;
use workshop\lang\parser\nodes\NumberNode;
use workshop\lang\parser\nodes\VariableNode;
use workshop\lang\parser\Parser;

class ParserTest extends TestCase {
    public function testBinaryStatement() {
        $tokens = Lexer::parseTokens("a + 2");
        $fileNode = Parser::parse($tokens);
        $children = $fileNode->getChildren();
        /** @var BinaryStatementNode $binaryStatementNode */
        $binaryStatementNode = $children[0];
        $this->assertBinaryStatement($binaryStatementNode);
    }

    /**
     * @covers \workshop\lang\parser\Parser::parseBinaryStatement
     * @covers \workshop\lang\parser\Parser::parseExpression
     */
    public function testNestedBinaryStatement() {
        $tokens = Lexer::parseTokens("3 - a + 2");
        $fileNode = Parser::parse($tokens);
        $children = $fileNode->getChildren();
        /** @var BinaryStatementNode $binaryStatementNode */
        $binaryStatementNode = $children[0];
        self::assertInstanceOf(BinaryStatementNode::class, $binaryStatementNode);
        /** @var NumberNode $left */
        $left = $binaryStatementNode->getLeft();
        self::assertInstanceOf(NumberNode::class, $left);
        self::assertEquals("3", $left->getValue());

        /** @var BinaryStatementNode $right */
        $right = $binaryStatementNode->getRight();
        self::assertInstanceOf(BinaryStatementNode::class, $right);
        $this->assertBinaryStatement($right);
    }

    public function testParseAssignment() {
        $tokens = Lexer::parseTokens("a = 1");
        $fileNode = Parser::parse($tokens);
        $statements = $fileNode->getChildren();
        /** @var AssignmentNode $assignment */
        $assignment = $statements[0];
        $variable = $assignment->getVariable();
        self::assertEquals("a", $variable->getName());
        /** @var NumberNode $number */
        $number = $assignment->getExpression();
        self::assertEquals(1, $number->getValue());
    }

    public function testParseEcho() {
        $tokens = Lexer::parseTokens("echo 1");
        $fileNode = Parser::parse($tokens);
        /** @var EchoNode $echo */
        $echo = $fileNode->getChildren()[0];
        self::assertInstanceOf(EchoNode::class, $echo);
        /** @var NumberNode $number */
        $number = $echo->getArgument();
        self::assertInstanceOf(NumberNode::class, $number);
        self::assertEquals("1", $number->getValue());
    }

    public function testInvalidExpression() {
        $tokens = Lexer::parseTokens("a = echo 1");
        $this->expectException(Exception::class);
        Parser::parse($tokens);
    }

    private function assertBinaryStatement($binaryStatementNode): void {
        self::assertInstanceOf(BinaryStatementNode::class, $binaryStatementNode);
        /** @var VariableNode $left */
        /** @var BinaryStatementNode $binaryStatementNode */
        self::assertEquals(TokenTypes::PLUS, $binaryStatementNode->getOperationType());
        $left = $binaryStatementNode->getLeft();
        self::assertInstanceOf(VariableNode::class, $left);
        self::assertEquals("a", $left->getName());

        /** @var NumberNode $right */
        $right = $binaryStatementNode->getRight();
        self::assertInstanceOf(NumberNode::class, $right);
        self::assertEquals("2", $right->getValue());
    }

}

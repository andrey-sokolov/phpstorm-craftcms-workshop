<?php

namespace workshop\lang\generator;

use workshop\lang\ASTNodeVisitor;
use workshop\lang\lexer\TokenTypes;
use workshop\lang\parser\nodes\AssignmentNode;
use workshop\lang\parser\nodes\BinaryStatementNode;
use workshop\lang\parser\nodes\EchoNode;
use workshop\lang\parser\nodes\FileNode;
use workshop\lang\parser\nodes\NumberNode;
use workshop\lang\parser\nodes\VariableNode;

class CodeGenerator extends ASTNodeVisitor {
    private $buffer = "";

    public function generateCode(FileNode $file): string {
        $this->buffer .= "<?php ";
        $file->visit($this);
        return $this->buffer;
    }

    public function visitFile(FileNode $node) {
        foreach ($node->getChildren() as $statement) {
            $statement->visit($this);
        }
    }

    public function visitBinaryStatement(BinaryStatementNode $node) {
        $node->getLeft()->visit($this);
        $operationType = $node->getOperationType();
        if ($operationType == TokenTypes::PLUS) {
            $this->buffer .= "+";
        }
        if ($operationType == TokenTypes::MINUS) {
            $this->buffer .= "-";
        }
        if ($operationType == TokenTypes::MULTIPLY) {
            $this->buffer .= "*";
        }
        if ($operationType == TokenTypes::DIVIDE) {
            $this->buffer .= "/";
        }
        $node->getRight()->visit($this);
    }

    public function visitEcho(EchoNode $node) {
        $this->buffer .= "echo ";
        $node->getArgument()->visit($this);
        $this->buffer .= ";";
    }

    public function visitVariable(VariableNode $node) {
        $this->buffer .= "$" . $node->getName();
    }

    public function visitNumber(NumberNode $node) {
        $this->buffer .= $node->getValue();
    }

    public function visitAssignment(AssignmentNode $node) {
        $node->getVariable()->visit($this);
        $this->buffer .= "=";
        $node->getExpression()->visit($this);
        $this->buffer .= ";";
    }
}
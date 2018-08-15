<?php

namespace workshop\lang\generator;

use workshop\lang\ASTNodeVisitor;
use workshop\lang\lexer\TokenTypes;
use workshop\lang\parser\nodes\FileNode;

class CodeGenerator extends ASTNodeVisitor {
    private $buffer = "";

    /**
     * @param FileNode $file
     * @return string
     */
    public function generateCode($file) {
        $this->buffer .= "<?php ";
        $file->visit($this);
        return $this->buffer;
    }

    public function visitFile($node) {
        foreach ($node->getChildren() as $statement) {
            $statement->visit($this);
        }
    }

    public function visitBinaryStatement($node) {
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

    public function visitEcho($node) {
        $this->buffer .= "echo ";
        $node->getArgument()->visit($this);
        $this->buffer .= ";";
    }

    public function visitVariable($node) {
        $this->buffer .= "$" . $node->getName();
    }

    public function visitNumber($node) {
        $this->buffer .= $node->getValue();
    }

    public function visitAssignment($node) {
        $node->getVariable()->visit($this);
        $this->buffer .= "=";
        $node->getExpression()->visit($this);
        $this->buffer .= ";";
    }
}
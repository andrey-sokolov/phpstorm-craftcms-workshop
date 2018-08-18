<?php

namespace workshop\lang;

use workshop\lang\parser\nodes\AssignmentNode;
use workshop\lang\parser\nodes\BinaryStatementNode;
use workshop\lang\parser\nodes\EchoNode;
use workshop\lang\parser\nodes\FileNode;
use workshop\lang\parser\nodes\NumberNode;
use workshop\lang\parser\nodes\VariableNode;

abstract class ASTNodeVisitor {
    public function visitFile(FileNode $node) {

    }

    public function visitAssignment(AssignmentNode $node) {

    }

    public function visitBinaryStatement(BinaryStatementNode $node) {

    }

    public function visitEcho(EchoNode $node) {

    }

    public function visitVariable(VariableNode $node) {

    }

    public function visitNumber(NumberNode $node) {

    }
}
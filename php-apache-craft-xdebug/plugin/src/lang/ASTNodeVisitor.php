<?php

namespace workshop\lang;

use workshop\lang\parser\nodes\AssignmentNode;
use workshop\lang\parser\nodes\BinaryStatementNode;
use workshop\lang\parser\nodes\EchoNode;
use workshop\lang\parser\nodes\FileNode;
use workshop\lang\parser\nodes\NumberNode;
use workshop\lang\parser\nodes\VariableNode;

abstract class ASTNodeVisitor {
    /**
     * @param FileNode $node
     */
    public function visitFile($node) {

    }

    /**
     * @param AssignmentNode $node
     */
    public function visitAssignment($node) {

    }

    /**
     * @param BinaryStatementNode $node
     */
    public function visitBinaryStatement($node) {

    }

    /**
     * @param EchoNode $node
     */
    public function visitEcho($node) {

    }

    /**
     * @param VariableNode $node
     */
    public function visitVariable($node) {

    }

    /**
     * @param NumberNode $node
     */
    public function visitNumber($node) {

    }
}
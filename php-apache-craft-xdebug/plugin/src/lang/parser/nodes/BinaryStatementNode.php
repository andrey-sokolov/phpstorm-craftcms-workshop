<?php

namespace workshop\lang\parser\nodes;

use workshop\lang\ASTNodeVisitor;

class BinaryStatementNode extends ASTNode {
    private $operationType;

    public function __construct($left, $right, $operationType) {
        parent::__construct([$left, $right]);
        $this->operationType = $operationType;
    }

    public function getLeft() {
        return $this->children[0];
    }

    public function getRight() {
        return $this->children[1];
    }

    /**
     * @return int
     */
    public function getOperationType() {
        return $this->operationType;
    }

    public function visit(ASTNodeVisitor $visitor) {
        $visitor->visitBinaryStatement($this);
    }
}
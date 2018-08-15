<?php

namespace workshop\lang\parser\nodes;

use workshop\lang\ASTNodeVisitor;

abstract class ASTNode {
    /**
     * @var ASTNode[]
     */
    protected $children;

    /**
     * ASTNode constructor.
     * @param ASTNode[] $children
     */
    protected function __construct(array $children) { $this->children = $children; }

    /**
     * @return ASTNode[]
     */
    public function getChildren(): array {
        return $this->children;
    }

    public abstract function visit(ASTNodeVisitor $visitor);
}
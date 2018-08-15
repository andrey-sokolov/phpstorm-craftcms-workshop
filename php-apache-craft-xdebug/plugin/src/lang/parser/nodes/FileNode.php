<?php

namespace workshop\lang\parser\nodes;

use workshop\lang\ASTNodeVisitor;

class FileNode extends ASTNode {

    /**
     * FileNode constructor.
     * @param ASTNode[] $statements
     */
    public function __construct($statements) {
        parent::__construct($statements);
    }

    public function visit(ASTNodeVisitor $visitor) {
        $visitor->visitFile($this);
    }
}
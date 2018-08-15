<?php

namespace workshop\lang\parser\nodes;

use workshop\lang\ASTNodeVisitor;

class EchoNode extends ASTNode {

    /**
     * EchoStatement constructor.
     * @param ASTNode $argument
     */
    public function __construct($argument) {
        parent::__construct([$argument]);
    }

    /**
     * @return ASTNode
     */
    public function getArgument() {
        return $this->children[0];
    }

    public function visit(ASTNodeVisitor $visitor) {
        $visitor->visitEcho($this);
    }
}
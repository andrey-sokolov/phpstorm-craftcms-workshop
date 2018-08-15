<?php

namespace workshop\lang\parser\nodes;

use workshop\lang\ASTNodeVisitor;

class VariableNode extends ASTNode {
    /**
     * @var string
     */
    private $name;

    /**
     * VariableNode constructor.
     * @param string $name
     */
    public function __construct($name) {
        parent::__construct([]);
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    public function visit(ASTNodeVisitor $visitor) {
        $visitor->visitVariable($this);
    }
}
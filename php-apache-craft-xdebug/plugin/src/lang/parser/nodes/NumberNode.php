<?php

namespace workshop\lang\parser\nodes;

use workshop\lang\ASTNodeVisitor;

class NumberNode extends ASTNode {
    /**
     * @var string
     */
    private $value;

    /**
     * NumberNode constructor.
     */
    public function __construct($value) {
        parent::__construct([]);
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string {
        return $this->value;
    }


    public function visit(ASTNodeVisitor $visitor) {
        $visitor->visitNumber($this);
    }
}
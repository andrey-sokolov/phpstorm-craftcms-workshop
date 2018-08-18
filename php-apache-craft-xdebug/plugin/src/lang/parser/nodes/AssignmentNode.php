<?php

namespace workshop\lang\parser\nodes;

use workshop\lang\ASTNodeVisitor;

class AssignmentNode extends ASTNode {

    /**
     * AssignmentNode constructor.
     * @param VariableNode $variable
     * @param ASTNode $expression
     */
    public function __construct($variable, $expression) {
        parent::__construct([$variable, $expression]);
    }

    public function getVariable(): VariableNode {
        return $this->children[0];
    }

    public function getExpression() {
        return $this->children[1];
    }

    public function visit(ASTNodeVisitor $visitor) {
        $visitor->visitAssignment($this);
    }
}
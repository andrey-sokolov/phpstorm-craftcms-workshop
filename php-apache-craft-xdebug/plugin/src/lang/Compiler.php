<?php

namespace workshop\lang;

use workshop\lang\generator\CodeGenerator;
use workshop\lang\lexer\Lexer;
use workshop\lang\parser\Parser;

class Compiler {
    public static function compile($content) {
        $tokens = Lexer::parseTokens($content);
        $fileNode = Parser::parse($tokens);
        return (new CodeGenerator())->generateCode($fileNode);
    }
}
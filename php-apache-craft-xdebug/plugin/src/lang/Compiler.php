<?php

namespace workshop\lang;

use workshop\lang\generator\CodeGenerator;
use workshop\lang\lexer\Scanner;
use workshop\lang\parser\Parser;

class Compiler {
    public static function compile($content) {
        $tokens = Scanner::parseTokens($content);
        $fileNode = Parser::parse($tokens);
        return (new CodeGenerator())->generateCode($fileNode);
    }
}
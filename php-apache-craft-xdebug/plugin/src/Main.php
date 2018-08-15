<?php

namespace workshop;
require_once '../../../vendor/autoload.php';

use workshop\lang\Compiler;

$readline = readline("Enter the code: ");
$compile = Compiler::compile($readline);
$compile = str_replace(";", ";\n", $compile);
$compile = str_replace("<?php ", "<?php \n", $compile);
echo $compile;
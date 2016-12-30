<?php
$milliseconds = round(microtime(true) * 1000);

$train_file = (dirname(__FILE__) . "/xor_float.net");
if (!is_file($train_file))
    die("The file xor_float.net has not been created! Please run simple_train.php to generate it");

$ann = fann_create_from_file($train_file);
if (!$ann)
    die("ANN could not be created");

$input = array(-1, 1);
$calc_out = fann_run($ann, $input);
printf("INFO: xor test (%f,%f) -> %f\n", $input[0], $input[1], $calc_out[0]);
echo "<br>";
fann_destroy($ann);

echo "INFO: Done simple_test.php in " . (round(microtime(true) * 1000) - $milliseconds) ." milliseconds<br>";


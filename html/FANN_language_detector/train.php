<?php
/**
 * This application will train neuron network decide what language text it is,
 * by checking how often is used same letter. This is simple method, but it works.
 */

// Define application start time:
$milliseconds = round(microtime(true) * 1000);

// The total number of layers including the input and the output layer:
$num_layers = 3;

// Number of neurons in the first layer. We will su support 256 signals - it should be equal to alphabet amount:
$num_input = 256;

// Number of neurons in the second layer. NOTE: Define this number by experiments.:
$num_neurons_hidden = 128;

// Number of neurons in the 3rd (Third) layer - output. We have 3, because supporting 3 languages:
$num_output = 3;

// Creates a standard fully connected backpropagation neural network:
$ann = fann_create_standard($num_layers, $num_input, $num_neurons_hidden, $num_output);

// Check if returns a neural network resource:
if ($ann) {
    fann_train($ann,
        array(
            array(
                generate_frequencies(file_get_contents("en.txt")), // Inputs
                array(1, 0, 0) // Outputs
            ),
            array(
                generate_frequencies(file_get_contents("fr.txt")), // Inputs
                array(0, 1, 0) // Outputs
            ),
            array(
                generate_frequencies(file_get_contents("pl.txt")), // Inputs
                array(0, 0, 1) // Outputs
            ),
        ),
        100000,
        0.00001,
        1000
    );

    // Saves the entire network to a configuration file:
    fann_save($ann, "classify.txt");

    // Destroys the entire network and properly freeing all the associated memory:
    fann_destroy($ann);
} else {
    echo 'ERROR: ann is empty.<br>';
}

// Inform about application finish and print time used:
echo 'INFO: Done train.php in ' . (round(microtime(true) * 1000) - $milliseconds) . ' milliseconds<br>';

/**
 * Method responsible to calculate letters using frequency.
 *
 * @param $text
 *
 * @return array
 */
function generate_frequencies($text)
{
    // Removed all, live just letters:
    $text = preg_replace("/[^\p{L}]/iu", "", strtolower($text));

    // Define frequency calculation parameters:
    $total = strlen($text);
    $data = count_chars($text);

    // Final calc:
    array_walk($data, function (&$item, $key, $total) {
        $item = round($item / $total, 3);
    }, $total);

    return array_values($data);
}

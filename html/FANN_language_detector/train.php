<?php
/**
 * This application will train neuron network decide what language text it is,
 * by checking how often is used same letter. This is simple method, but it works.
 */

/**
 * Define network parameters.
 * 256 - input parameters amount. It should be equal to letter in alphabet amount.
 * 128 - neurons in the second layer amount. NOTE: define this number by experiments.
 * 3   - input signals amount. We will su support 3 signals - 3 languages.
 * 1.0 - connection rate. If the connection rate is set to 1, the network will be fully connected,
 *       but if it is set to 0.5 only half of the connections will be set. Better not change it.
 * 0.7 - learning rate. The learning rate is used to determine how aggressive training should be for some of
 *       the training algorithms
 */
$ann = fann_create(array(256, 128, 3), 1.0, 0.7);

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

/**
 * Saves the entire network to a configuration file.
 */
fann_save($ann, "classify.txt");


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

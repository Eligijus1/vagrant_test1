<?php
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

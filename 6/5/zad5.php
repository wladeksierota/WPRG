<?php
function isPangram($text) {
    $alfabet = range('a', 'z');

    $lowerText = strtolower($text);

    foreach ($alfabet as $litera) {
        if (strpos($lowerText, $litera) === false) {
            return false;
        }
    }

    return true;
}

?>

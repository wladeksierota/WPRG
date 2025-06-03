<?php

function dolar($array, $n)
{
    if ($n < 0 or $n >= count($array)) {
        echo "BŁĄD";
    }
    $copy = array_splice($array, $n - 1);
    $new_a = array_splice($array, 0, $n);
    $new_a[$n] = "$";
    $mar = array_merge($new_a, $copy);

    print_r($mar);
}

dolar([1, 2, 3, 4, 5, 6, 7, 8, 9, 10], 4);

?>

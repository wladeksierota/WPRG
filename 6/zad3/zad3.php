<?php

function sequences_n($a1, $r, $n)
{
    echo "<br>";
    echo "$a1, $r, $n:\n";
    echo "<br>";
    if(is_numeric($a1)&&is_numeric($r)&&is_numeric($n)) {
        if($n>0) {
            $a2 = $a1;
            echo "Arithmetic: ";
            for ($i = 0; $i < $n; $i++) {
                if ($i > 0) {
                    $a1 = $a1 + $r;
                }
                echo $a1;
                if ($i < $n - 1) {
                    echo ",\n";
                }
            }
            echo "<br>";
            echo "Geometric: ";
            for ($i = 0; $i < $n; $i++) {
                if ($i > 0) {
                    $a2 = $a2 * $r;
                }
                echo $a2;
                if ($i < $n - 1) {
                    echo ",\n";
                }
            }
        }
        else{
            echo "N must be positive number!";
        }
    }
    else{
        echo "Parameters must be numeric!";
    }
}
sequences_n(5, 2, 10);
sequences_n(5, -2, 10);
sequences_n(-5, 2, 10);
sequences_n(5, 2.5, 5);
sequences_n(5, 2.5, -10);
sequences_n("start", 2, 10);
?>

<?php
function abcd($a, $b, $c, $d)
{
    if(($b-$a) != ($d-$c)){
        echo "bład";
    }

    $array = array();

    for($i = $a; $i <= $b; $i++) {
        $array[$i] = $c;
        $c++;
    }
    print_r($array);
}

abcd(3, 7, 10, 14);
?>

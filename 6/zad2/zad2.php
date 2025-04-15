<?php
function numbers($a)
{
    $suma = 0;
    if(is_numeric($a)) {
        while (ceil($a) != $a) {
            $a = $a * 10;
        }
        $length = ceil(log10(abs($a) + 1));
        $array = array_map('intval', str_split($a));
        for ($i = 0; $i < $length; $i++) {
            $suma += $array[$i];
        }
        if ($suma >= 10) {
            numbers($suma);
        }
        else{
            echo $suma;
            echo "<br>";
        }
    }
    else{
        echo "Parameter must be numeric!";
    }
}
echo "5210: \n";
numbers(5210);
echo "-5210: \n";
numbers(-5210);
echo "5210.5: \n";
numbers(5210.5);
echo "numbers: \n";
numbers("numbers");


?>

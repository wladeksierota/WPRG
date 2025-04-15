<!DOCTYPE html>
<html>
<head>
    <title>Title of the document</title>
</head>

<body>

<?php

function p_num($a, $b)
{
    if ($a < 0 or $b < 0) {
        echo "error";
        return 0;
    }
    echo "$a, $b: ";
    for($i = $a; $i < $b; $i++){
        if(check($i)){
            echo "$i, ";
        }
    }
}

function check($num)
{
    for ($J = 2; $J < $num; $J++)
    {
        if ($num % $J == 0)
        {
            return false;
        }
    }
    return true;
}

p_num(5, 10);
//p_num(10, 5);
//p_num(5.5, 10);
//p_num(-5, 10);
//p_num("PRIME", 10);

?>

</body>

</html>


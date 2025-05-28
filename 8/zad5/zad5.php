<?php
$input = isset($_POST['input']) ? $_POST['input'] : '';

$size = strlen($input);
$licznik = 0;

for($i = 0; $i < $size; $i++){
    if($input[$i] == '.' or $input[$i] == ','){
        $licznik = $i;
    }
}

echo "Liczba cyfr przed przecinkiem: " . ($size - $licznik - 1);
?>

<form method="post" action="">
    <label for="input">podaj liczbę zmiennoprzecinkową</label>
    <input type="text" id="input" name="input" required>
    <button type="submit">oblicz</button>
</form>

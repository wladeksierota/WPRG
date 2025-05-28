<?php
$input = isset($_POST['input']) ? $_POST['input'] : '';

$samog = ['a', 'e', 'i', 'o', 'u'];
$licznik = 0;

for($i = 0; $i < strlen($input); $i++){
    if(in_array($input[$i], $samog)){
        $licznik++;
    }
}
echo "liczba samogłosek w ciągu to " . $licznik;
?>

<form method="post" action="">
    <label for="input">Wprowadź ciąg znaków:</label>
    <input type="text" id="input" name="input" required>
    <button type="submit">Zlicz samogłoski</button>
</form>

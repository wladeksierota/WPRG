<?php
$input = isset($_POST['input']) ? $_POST['input'] : '';

echo "ciag dużymi literami: " . strtoupper($input) . "<br>";

echo "ciąg małymi literami: " . strtolower($input) . "<br>";

echo "pierwsza litera duża: " . ucfirst(strtolower($input)) . "<br>";

echo "pierwsze litery każdego słowa duże: " . ucwords(strtolower($input)) . "<br>";
?>


<form method="post" action="">
    <label for="input">podaj ciag znakow</label>
    <input type="text" id="input" name="input" required>
    <button type="submit"></button>
</form>

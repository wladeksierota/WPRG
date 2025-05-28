<?php
$input = isset($_POST['input']) ? $_POST['input'] : '';

$unwantedChars = ['√', ':', '*', '?', '^', 'n', '↔', '|', '+'];

$cleanedInput = str_replace($unwantedChars, '', $input);

echo "Oczyszczony ciąg: " . htmlspecialchars($cleanedInput);
?>

<form method="post" action="">
    <label for="input">podaj ciąg zawierający niepożądane znaki</label>
    <input type="text" id="input" name="input" required>
    <button type="submit">usuń znaki niepożądane</button>
</form>

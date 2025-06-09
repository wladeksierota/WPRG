<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Formularz</title>
</head>
<body>
<form method="get" action="zad1.php">
    <label for="birthdate">Podaj date urodzenia:</label>
    <input type="date" name="birthdate" required>
    <input type="submit" value="wyślij">
</form>
<?php
if (isset($_GET['birthdate'])) {
    $birthdate = $_GET['birthdate'];
    $birthDateObj = new DateTime($birthdate);
    $today = new DateTime();
    $dayOfWeek = $birthDateObj->format('l');
    $age = $birthDateObj->diff($today)->y;

    $nextBirthday = DateTime::createFromFormat('Y-m-d', $today->format('Y') . '-' . $birthDateObj->format('m-d'));
    if ($nextBirthday < $today) {
        $nextBirthday->modify('+1 year');
    }
    $daysToBirthday = $today->diff($nextBirthday)->days;
    echo "<h3>Wyniki:</h3>";
    echo "<p>Urodziłeś się w: <strong>" .$dayOfWeek. "</strong></p>";
    echo "<p>Masz: <strong>$age</strong> lat</p>";
    echo "<p>Do najbliższych urodzin zostało: $daysToBirthday</p>";
}
?>
</body>
</html>
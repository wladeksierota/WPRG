<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista odnośników</title>
</head>
<body>
<?php
$file = 'odnosniki.txt';

if (!file_exists($file)) {
    die("Plik nie istnieje");
}

$lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

if (empty($lines)) {
    die("Plik jest pusty");
}

echo "<ul>";
foreach ($lines as $line) {
    $parts = explode(';', $line, 2);
    if (count($parts) == 2) {
        $url = trim($parts[0]);
        $description = trim($parts[1]);
        echo "<li><a href=\"$url\">$description</a></li>";
    }
}
echo "</ul>";
?>
</body>
</html>
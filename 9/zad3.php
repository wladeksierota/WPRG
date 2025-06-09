<?php
$file = 'licznik.txt';

if (!file_exists($file)) {
    file_put_contents($file, '1');
    echo "Licznik odwiedzin: 1 (plik utworzony)";
    exit;
}

$licznik = (int)file_get_contents($file);

$licznik++;

file_put_contents($file, $licznik);

echo "Licznik odwiedzin: " . $licznik;
?>
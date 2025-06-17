<?php

$db_host = "szuflandia.pjwstk.edu.pl";
$db_user = "s33314";
$db_pass = "Wla.Sier";
$db_name = "s33314";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}

?>

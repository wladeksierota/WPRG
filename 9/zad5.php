<?php
$ipFile = 'special_ips.txt';

$userIP = $_SERVER['REMOTE_ADDR'];

$specialIPs = file($ipFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

if (in_array($userIP, $specialIPs)) {
    include 'strona1.php';
} else {
    include 'strona2.php';
}
?>

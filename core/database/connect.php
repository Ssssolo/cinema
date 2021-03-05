<?php
$con = mysqli_connect("localhost", "root", "", "cinema");

if (!$con) {
    echo "Eroare: Nu a fost posibilă conectarea la MySQL." . PHP_EOL;
    echo "Valoarea errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Valoarea error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
?>
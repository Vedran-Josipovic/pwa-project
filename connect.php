<?php
header('Content-Type: text/html; charset=utf-8');

$servername = "localhost";
$username = "root";
$password = "abba";
$dbname = "projekt_pwa";
$port = 3307;

$dbc = mysqli_connect($servername, $username, $password, $dbname, $port);

if (!$dbc) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($dbc, "utf8");

?>

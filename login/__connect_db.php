<?php

$db_host = "localhost";
$db_name = "the_wheel";
$db_user = "clifford";
$db_pass = "12345";

try {
    $pdo = new PDO("mysql:host={$db_host};dbname={$db_name}", $db_user, $db_pass, null);
    $pdo->query("SET NAMES utf8");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    echo "error:" . $ex->getMessage();
}

<?php

$db_host = "localhost";
$db_name = "the_wheel";
<<<<<<< HEAD
$db_user = "root";
$db_pass = "";
=======
$db_user = "clifford";
$db_pass = "a0953830559";
>>>>>>> 07cc52a17417d03a9bd769fc1bdcbf19e23b93cf

try {
    $pdo = new PDO("mysql:host={$db_host};dbname={$db_name}", $db_user, $db_pass, null);
    $pdo->query("SET NAMES utf8");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    echo "error:" . $ex->getMessage();
}

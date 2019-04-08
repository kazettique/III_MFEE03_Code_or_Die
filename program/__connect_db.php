<?php

$db_host = '192.168.27.7';
$db_name = 'the_wheel';
$db_user = 'leo';
$db_pass = '321123';


$dsn = "mysql:host={$db_host};dbname={$db_name}";

try{

    $pdo = new PDO($dsn, $db_user, $db_pass);

    $pdo->query("SET NAMES utf8");

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $ex){
    echo 'Error: '. $ex->getMessage();
}
if(! isset($_SESSION)){
    session_start();
}










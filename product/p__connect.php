<?php
$db_host = 'localhost';
$db_name = 'the_wheel';
$db_user = 'root';
$db_pass = '';


try{

    $pdo = new PDO("mysql:host={$db_host};dbname={$db_name}", $db_user, $db_pass);
    $pdo->query("SET NAMES utf8");
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $ex){
    echo "Error: ".$ex->getMessage();
  
} if(! isset($_SESSION)){
    session_start();
}
<?php
$db_host='192.168.27.7';
$db_name='the_wheel';
$db_user='ivi';
$db_password='admin1123';


try{
    $pdo=new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_password);
    $pdo->query("SET NAMES utf8");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo 'Connection Failed' . $e->getMessage();
}
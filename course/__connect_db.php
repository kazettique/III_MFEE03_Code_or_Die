<?php
// Connect to database

// For test use
// $db_host = 'localhost';
// $db_name = 'the_wheel';
// $db_user = 'root';
// $db_pass = '';


 // For project use
 // Ivy's Server
$db_host = '192.168.27.7';
 $db_name = 'the_wheel';
 $db_user = 'woody';
 $db_pass = '6211';


// 這裡使用雙引號
// mysql固定使用雙引號
$dsn = "mysql:host={$db_host};dbname={$db_name}";

try {
    // 連結資料庫
    $pdo = new PDO($dsn, $db_user, $db_pass);

    // 修改成utf8編碼以正常顯示中文字
    // 資料進去跟出來都使用utf8編碼
    // 先建立pdo物件，才能夠使用'query'
    $pdo->query("SET NAMES utf8");

    // 除錯??
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $ex) {
    echo 'Error: ' . $ex->getMessage();
}

if (!isset($_SESSION)) {
    session_start();
}
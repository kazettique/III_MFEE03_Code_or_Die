<?php
require __DIR__. '/__connect_db.php';

$sid = isset($_GET['e_sid']) ? intval($_GET['e_sid']) : 0;

$pdo->query("DELETE FROM `e_list` WHERE `e_sid`=$sid");

$goto = 'event_list.php'; 

if(isset($_SERVER['HTTP_REFERER'])){
    $goto = $_SERVER['HTTP_REFERER'];
}

header("Location: $goto");

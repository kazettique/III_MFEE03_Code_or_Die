<?php
require __DIR__. '/__connect_db.php';

$sid = isset($_GET['s_sid']) ? intval($_GET['s_sid']) : 0;

$pdo->query("DELETE FROM `signup` WHERE `s_sid`=$sid");

$goto = 'event_list2.php'; 

if(isset($_SERVER['HTTP_REFERER'])){
    $goto = $_SERVER['HTTP_REFERER'];
}

header("Location: $goto");

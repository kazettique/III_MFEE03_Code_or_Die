<?php

require __DIR__. '/__connect_db.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$pdo->query("DELETE FROM  member WHERE `m_sid`=$sid");


$goto = 'data_list4.php'; // 預設值

$page=$_GET['page'];

$perPage=$_GET['perPage'];

$city=$_GET['city'];

$city=$_GET['city'];

$keyword =$_GET['keyword'];

$sortway=$_GET['sortway'];

$temp = explode("#",$_SERVER['HTTP_REFERER'])[0];

$url=$temp."#".$page."&perPage=".$perPage."&city=".$city."&sortway=".$sortway."&keyword=".$keyword;


if(isset($_SERVER['HTTP_REFERER'])){
    $goto = $url;
}

header("Location: $goto");

<?php 
//require __DIR__.'/_cred.php';
require __DIR__.'/p__connect.php';

$sid = isset($_GET['p_sid']) ? intval($_GET['p_sid']) : 0;

$pdo->query("DELETE FROM `prouduct` WHERE `p_sid`=$sid");


$goto = 'p_data_list2.php';//預設值


if(isset($_SERVER['HTTP_REFERER'])){
        $goto =$_SERVER['HTTP_REFERER'];
}

header("Location: $goto");
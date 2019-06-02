<?php

require __DIR__ .'/__connect.php';

$result=[];

$rsid = isset($_GET['r_sid'])? intval($_GET['r_sid']) : 0;
if($rsid==0){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql ="SELECT * FROM `route_location` WHERE r_sid=$rsid";
$result= $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result, JSON_UNESCAPED_UNICODE);
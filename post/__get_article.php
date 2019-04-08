<?php
require __DIR__ . "./__connect_db.php";
$sid = $_POST["sid"];

$result = [];


$sql = "SELECT * FROM `test` WHERE `sid` = '$sid'";
$stmt = $pdo->query($sql);
$result = $stmt->fetch(PDO::FETCH_ASSOC);


echo json_encode($result, JSON_UNESCAPED_UNICODE);

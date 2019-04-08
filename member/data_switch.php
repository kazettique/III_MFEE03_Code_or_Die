<?php

require __DIR__ . '/__connect_db.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$sql="SELECT `m_sid`,`m_active` FROM `member` WHERE `m_sid` =$sid ";
$stmt = $pdo->query($sql);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

// echo $data;
print_r($data['m_active']);

if($data['m_active']==="正常"){
    $pdo->query("UPDATE `member` SET `m_active`='停權' WHERE `m_sid` =$sid  && `m_active`='正常'");
}

if($data['m_active']==="停權"){
    $pdo->query("UPDATE `member` SET `m_active`='正常' WHERE `m_sid` =$sid  && `m_active`='停權'");
}

// $pdo->query("UPDATE `member` SET `m_active`='停權' WHERE `m_sid` =$sid  && `m_active`='正常'");
// $pdo->query("UPDATE `member` SET `m_active`='正常' WHERE `m_sid` =$sid  && `m_active`='停權'");

$goto = 'data_list2.php'; // 預設值

$page = $_GET['page'];

$perPage = $_GET['perPage'];

$city = $_GET['city'];


$city = $_GET['city'];

$keyword = $_GET['keyword'];

$sortway = $_GET['sortway'];

$temp = explode("#", $_SERVER['HTTP_REFERER'])[0];

echo $temp;

echo "<br>";

$url = $temp . "#" . $page . "&perPage=" . $perPage . "&city=" . $city . "&sortway=" . $sortway . "&keyword=" . $keyword;

echo $url;

if (isset($_SERVER['HTTP_REFERER'])) {

    $goto = $url;
}

header("Location: $goto");

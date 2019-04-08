<?php

require __DIR__ . '/__connect.php';

$result=[
    'success'=>false,
    'errCode'=>0,
    'errMsg'=>''
];

$l_sid = isset($_GET['l_sid'])? intval($_GET['l_sid']) : 0;


try{
$stmt = $pdo->query("DELETE FROM `route_location` WHERE `l_sid`=$l_sid");

if($stmt->rowCount()==1){
    $result['errCode']=200;
    $result['success']=true;
    $result['errMsg']='路線刪除成功';

};
}catch(PDOException $e){
    $result['errCode']=407;
    $result['errMsg']='路線刪除不成功:<br>'.$e;
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
// $goto='display.php';

// if(isset($_SERVER['HTTP_REFERER'])){
//     $goto=$_SERVER['HTTP_REFERER'];
// }

// header("Location: $goto");
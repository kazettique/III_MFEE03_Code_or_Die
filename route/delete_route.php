<?php

require __DIR__ . '/__connect.php';

$result=[
    'success'=>false,
    'errCode'=>0,
    'errMsg'=>''
];

$r_sid = isset($_GET['r_sid'])? intval($_GET['r_sid']) : 0;
$img_stmt=$pdo->query("SELECT `r_img` FROM `route` WHERE `r_sid`='$r_sid'")->fetch(PDO::FETCH_ASSOC);
$r_img=$img_stmt['r_img'];

try{
$stmt = $pdo->query("DELETE FROM `route` WHERE `r_sid`=$r_sid");

if($stmt->rowCount()==1){
    $path = '../the_wheel_uploads/'.$r_img;
    if(unlink($path)){
    $result['errCode']=200;
    $result['success']=true;
    $result['errMsg']='路線刪除成功';
    }else{
    $result['errCode']=459;
    $result['errMsg']='圖像刪除失敗';
    }
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
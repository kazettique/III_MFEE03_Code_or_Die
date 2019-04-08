<?php
require __DIR__. '/__connect_db.php';

header('Content-Type: application/json');

$result = [
    'success' => false,
    'errorCode' => 0,
    'errorMsg' => '資料輸入不完整',
    'post' => [],       
        
];
$sid = isset($_POST['s_sid']) ? intval($_POST['s_sid']) : 0;

if(isset($_POST['e_sid']) and !empty($sid)){

    $e_sid = $_POST['e_sid'];
    $s_name = $_POST['s_name'];
    $s_phone = $_POST['s_phone'];
   
    $result['post'] = $_POST;  

}

    $sql = "UPDATE `signup` SET 
                `e_sid`=?,
                `s_name`=?,
                `s_phone`=?
                
                WHERE `s_sid`=?";

    try {
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $_POST['e_sid'],
            $_POST['s_name'],
            $_POST['s_phone'],
            $sid
        ]);

        if($stmt->rowCount()==1) {
            $result['success'] = true;
            $result['errorCode'] = 200;
            $result['errorMsg'] = '';

        } else {
            $result['errorCode'] = 402;
            $result['errorMsg'] = '資料沒有修改';
        }
    } catch(PDOException $ex){
        $result['errorCode'] = 403;
        $result['errorMsg'] = '資料更新發生錯誤';
    }

echo json_encode($result, JSON_UNESCAPED_UNICODE);





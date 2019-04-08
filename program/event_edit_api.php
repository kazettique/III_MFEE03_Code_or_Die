<?php
require __DIR__. '/__connect_db.php';
$upload_dir = __DIR__.'/uploads/';
header('Content-Type: application/json');

$result = [
'success' => false,
'errorCode' => 0,
'errorMsg' => '資料輸入不完整',
'post' => [], // 做 echo 檢查      
    
];
$sid = isset($_POST['e_sid']) ? intval($_POST['e_sid']) : 0;

if(!empty($_FILES['e_pic']['name'])){
    $e_name = $_POST['e_name'];
    $e_leader = $_POST['e_leader'];
    $e_depart = $_POST['e_depart'];
    $e_arrive = $_POST['e_arrive'];
    $e_date = $_POST['e_date'];
    $e_endTime = $_POST['e_endTime'];
    $e_via = $_POST['e_via'];
    $e_current = $_POST['e_current'];
    // $e_pic = $_POST['e_pic'];
    

    $filename = sha1($_FILES['e_pic']['e_name'].uniqid());

    $result['filename'] = $filename;
    $upload_file = $upload_dir.$filename;

    if(move_uploaded_file($_FILES['e_pic']['tmp_name'], $upload_file)){
        
        $upload_ok=1;
    }else{
        echo qq;
    }
    


    if($upload_ok==1){
        $e_name = $_POST['e_name'];
        $e_leader = $_POST['e_leader'];
        $e_depart = $_POST['e_depart'];
        $e_arrive = $_POST['e_arrive'];
        $e_date = $_POST['e_date'];
        $e_endTime = $_POST['e_endTime'];
        $e_via = $_POST['e_via'];
        $e_current = $_POST['e_current'];

        $sql = "UPDATE `e_list` SET 
        `e_name`=?,
        `e_leader`=?,
        `e_depart`=?,
        `e_arrive`=?,
        `e_date`=?,
        `e_endTime`=?,
        `e_via`=?,
        `e_current`=?,
        `e_pic`=?
        WHERE `e_sid`=?";


        try {
                
            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                    $_POST['e_name'],
                    $_POST['e_leader'],
                    $_POST['e_depart'],
                    $_POST['e_arrive'],
                    $_POST['e_date'],
                    $_POST['e_endTime'],
                    $_POST['e_via'],
                    $_POST['e_current'],
                    $filename,
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

    }

            
} else {
    $e_name = $_POST['e_name'];
    $e_leader = $_POST['e_leader'];
    $e_depart = $_POST['e_depart'];
    $e_arrive = $_POST['e_arrive'];
    $e_date = $_POST['e_date'];
    $e_endTime = $_POST['e_endTime'];
    $e_via = $_POST['e_via'];
    $e_current = $_POST['e_current'];
    // $e_pic = $_POST['e_pic'];
 
    $filename = sha1($_FILES['e_pic']['name'].uniqid());


    $result['filename'] = $filename;
    $upload_file = $upload_dir.$filename;


    if(!empty($sid)){
        $e_name = $_POST['e_name'];
        $e_leader = $_POST['e_leader'];
        $e_depart = $_POST['e_depart'];
        $e_arrive = $_POST['e_arrive'];
        $e_date = $_POST['e_date'];
        $e_endTime = $_POST['e_endTime'];
        $e_via = $_POST['e_via'];
        $e_current = $_POST['e_current'];

        $sql = "UPDATE `e_list` SET 
        `e_name`=?,
        `e_leader`=?,
        `e_depart`=?,
        `e_arrive`=?,
        `e_date`=?,
        `e_endTime`=?,
        `e_via`=?,
        `e_current`=?
        WHERE `e_sid`=?";


        try {
                
            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                $_POST['e_name'],
                $_POST['e_leader'],
                $_POST['e_depart'],
                $_POST['e_arrive'],
                $_POST['e_date'],
                $_POST['e_endTime'],
                $_POST['e_via'],
                $_POST['e_current'],
                // $_POST['e_pic'],
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
    

        }
    

    }
    
echo json_encode($result, JSON_UNESCAPED_UNICODE);
// header('Location: event_list.php');
?>

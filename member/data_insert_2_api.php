<?php
    require __DIR__. '/__connect_db.php';

    header('Content-Type: application/json');

    $result=[
        'success'=> false,
        'errorCode' => 0,
        'errorMsg' => '資料輸入不完整',
        'post' => [], // 做 echo 檢查  

    ];

  
    if(isset($_POST['checkme'])){
        $name = $_POST['m_name'];
        $email = $_POST['m_email'];
        $mobile = $_POST['m_mobile'];
        $birthday = $_POST['m_birthday'];
        $address = $_POST['m_address'];
        $city=$_POST['m_city'];
        $town=$_POST['m_town'];
        

        $result['post'] = $_POST;  // 做 echo 檢查


        if(empty($name) or empty($email) or empty($mobile)){
            $result['errorCode'] = 400;
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            exit;
        }
    
        // TODO: 檢查 name 長度
        // TODO: 檢查 email 格式
        if(! filter_var($email, FILTER_VALIDATE_EMAIL)){
            $result['errorCode'] = 405;
            $result['errorMsg'] = 'Email 格式不正確';
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            exit;
        }

        // TODO: 檢查 mobile 格式
        function isPhone($mobile) {
            if (preg_match("/^09[0-9]{2}-[0-9]{3}-[0-9]{3}$/", $mobile)) {
                return true;    // 09xx-xxx-xxx
            } else if(preg_match("/^09[0-9]{2}-[0-9]{6}$/", $mobile)) {
                return true;    // 09xx-xxxxxx
            } else if(preg_match("/^09[0-9]{8}$/", $mobile)) {
                return true;    // 09xxxxxxxx
            } else {
                $result['errorCode'] = 405;
                $result['errorMsg'] = '手機格式不正確';
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                exit;
            }
        }
      


        $sql="INSERT INTO `member`(
             `m_name`, `m_mobile`, `m_email`,`m_photo`,`m_address`,`m_birthday`,`m_active`,`m_password`,`m_city`,`m_town`
            ) VALUES (?,?,?,?,?,?,?,?,?,?)";


    try{
        $stmt=$pdo->prepare($sql);

        $stmt->execute([
            $_POST['m_name'],
            $_POST['m_mobile'],
            $_POST['m_email'],
            $_POST['myimg_src'],
            $_POST['m_address'],
            $_POST['m_birthday'],
            true,
            $_POST['m_password'],
            $_POST['m_city'],
            $_POST['m_town'],

        ]);


        if($stmt->rowCount()==1) {
            $result['success'] =true;
            $result['errorCode'] =200;
            $result['errorMsg'] ='';
        } else {           
                $result['errorCode'] = 402;
                $result['errorMsg'] = '資料新增錯誤';
            
        }
    }catch(PDOException $ex){
        $result['errorCode'] = 403;
        $result['errorMsg'] = 'Email 重複輸入';
    }

    
        


    }

    echo json_encode($result, JSON_UNESCAPED_UNICODE);

?>


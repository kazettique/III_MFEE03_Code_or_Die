<?php
    require __DIR__. '/__connect_db.php';

    header('Content-Type: application/json');

    $result=[
        'success'=> false,
        'errorCode' => 0,
        'errorMsg' => '資料輸入不完整',
        'data' => [],
        'post'=> "",
        'row'=> 0,
    ];

    if(isset($_POST["e_search"])){
       
        $sql="SELECT * FROM `e_list` WHERE `e_sid` LIKE ? OR e_name LIKE ? OR e_leader LIKE ? OR e_depart LIKE ? OR e_arrive LIKE ? OR e_date LIKE ?";
        $result['post'] =$_POST["e_search"];
    try{
        $stmt=$pdo->prepare($sql);
        $str= "%".$_POST['e_search']."%";
        $stmt->execute([
             $str,
             $str,
             $str,
             $str,
             $str,
             $str,
        ]);

        $result['data'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result['row'] = $stmt->rowCount();
        $result['errorMsg']="";
        $result['success'] =true;
        
    }catch(PDOException $ex){
        $result['errorMsg'] =$ex->getMessage();
    }

    }else{
        $result['errorCode'] = 400;
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }

    echo json_encode($result, JSON_UNESCAPED_UNICODE);



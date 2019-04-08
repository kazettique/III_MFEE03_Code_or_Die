<?php
    require __DIR__. '/__connect_db.php';

    header('Content-Type: application/json');

    $result=[
        'success'=> false,
        'errorCode' => 0,
        'errorMsg' => '資料輸入不完整',
        'data' => [],
        'keyword'=>"",
        'row'=>0

    ];

  
    if(isset($_POST["m_search"])){
       
        $sql="SELECT * FROM `member` WHERE m_sid LIKE ? OR m_mobile LIKE ? OR m_name LIKE ? OR m_email LIKE ? OR m_address LIKE ? OR m_birthday LIKE ? OR m_active LIKE ? OR m_city LIKE ? OR m_town LIKE ?";
        $result['keyword'] =$_POST["m_search"];
    try{
        $stmt=$pdo->prepare($sql);
        $str= "%".$_POST['m_search']."%";
        $stmt->execute([
             $str,
             $str,
             $str,
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



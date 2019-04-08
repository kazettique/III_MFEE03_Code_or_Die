<?php

require __DIR__. '/p__connect.php';

header('Content-Type:application/json');

$result= [
    'success' => false ,
    'errorCode' =>0,
    'errorMsg' =>'閉嘴Monkey',
    'post'=>"",
    'data'=>[],
    'row'=>0


];

//名稱 說明 價格
//類別 部件 品牌 尺寸 價錢 顏色

    if(isset($_POST['search'])){
        $sql = "SELECT * FROM `prouduct` WHERE p_sid LIKE ? OR p_name LIKE ? OR p_description LIKE ? OR p_price LIKE ? OR p_genre LIKE ? OR p_genre2 LIKE ? OR p_brand LIKE ? OR p_color LIKE ? OR p_size LIKE ?";
        $result['post']=$_POST['search'];


        try{
            $stmt = $pdo->prepare($sql);
            $sr = "%".$_POST['search']."%";
            $stmt->execute([
               $sr,
               $sr,
               $sr,
               $sr,
               $sr,
               $sr,
               $sr,
               $sr,
               $sr,
            ]);
                $result['data'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $result['row'] = $stmt->rowCount();
                $result['errorMsg']="";
                $result['success']=true;



        }catch(PDOException $ex){
            $result['errorMsg'] =$ex->getMessage();
        }
            

    }else{
        $result['erroeCode'] = 400;
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }










    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    

   

    








?>
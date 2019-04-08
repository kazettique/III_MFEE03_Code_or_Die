<?php
require __DIR__.'/__connect.php';
header('Content-Type: application/json');

$result=[
    'success'=> false,
    'errMsg'=>'資料輸入不完整',
    'get'=>[]
];

$rsid=isset($_GET['r_sid']) ? intval($_GET['r_sid']):0;

    $sql = "UPDATE `route` SET 
    `r_on`= NOT `r_on`
     WHERE `r_sid`=?;";

   
   try{
       $stmt=$pdo->prepare($sql);
        $stmt->execute([
            $rsid
        ]);

        if($stmt->rowCount()==1){
            $result['success']=true;
            $result['errMsg']='';
        $stmt=$pdo->query("SELECT `r_on` FROM `route` WHERE `r_sid`={$rsid}");
        $result['get']=$stmt->fetch(PDO::FETCH_ASSOC);
        }else{
            $result['errMsg']='這條路線不存在';
        }

    }catch(PDOException $e){
        $result['errMsg']='更新狀態錯誤<br>'.$e;
    }
    


echo json_encode($result, JSON_UNESCAPED_UNICODE);
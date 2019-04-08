<?php
require __DIR__.'/__connect.php';
header('Content-Type: application/json');


$result=[
    'success'=> false,
    'errMsg'=>'資料輸入不完整',
    'errCode'=>0,
    'post'=>[]
];

$lsid=isset($_POST['l_sid'][0]) ? intval($_POST['l_sid'][0]):0;


$sql = "SELECT * FROM `route_location` WHERE `l_sid`=$lsid";
$row= $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
if (empty($row)){
    $result['errCode']=410;
    $result['errMsg']="地點不存在";
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}



if(isset($_POST['l_name']) and !empty($lsid)){


    $l_name=$_POST['l_name'][0];
    $l_country=$_POST['l_country'][0];
    $l_area=$_POST['l_area'][0];
    $l_intro=$_POST['l_intro'][0];

    $result['post']=$_POST;


    if(empty($l_name) or empty($l_country)){
        $result['errCode']=400;
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }

    $sql = "UPDATE `route_location` SET 
    `l_name`=?,
    `l_country`=?,
    `l_area`=?,
    `l_intro`=?
     WHERE `l_sid`=?;";

   
   try{
       $stmt=$pdo->prepare($sql);
        $stmt->execute([
            $l_name,
            $l_country,
            $l_area,
            $l_intro,
            $lsid,
        ]);

        if($stmt->rowCount()==1){

                $result['success']=true;
                $result['errCode']=200;
                $result['errMsg']='地點修改成功';
        }else{
            $result['errCode']=402;
            $result['errMsg']='地點修改錯誤';
        }

    }catch(PDOException $e){
        $result['errMsg']='地點沒有修改<br>'.$e;
        $result['errCode']=403;
    }
    
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);
// ?>
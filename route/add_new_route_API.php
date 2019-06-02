<?php
require __DIR__.'/__connect.php';
header('Content-Type: application/json');
$result=[
    'success'=> false,
    'errMsg'=>'資料輸入不完整',
    'errCode'=>0,
    'post'=>[],
    'last_sid'=>0,
];

if(isset($_POST['r_name'])){
    $r_name=$_POST['r_name'];
    $r_time=$_POST['r_time'];
    $r_tag=$_POST['r_tag'];
    $r_country=$_POST['r_country'];
    $r_area=$_POST['r_area'];
    $r_depart=$_POST['r_depart'];
    $r_arrive=$_POST['r_arrive'];
    $r_intro=$_POST['r_intro'];
    $r_time_added=$_POST['r_time_added'];
    $r_l_num=$_POST['r_l_num'];
    $r_img=isset($_POST['r_img'])?$_POST['r_img']:'';
    

    $result['post']=$_POST;

    if(empty($r_tag) or empty($r_depart) or empty($r_arrive) or empty($r_name) or empty($r_time)){
        $result['errCode']=400;
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }

    $s_sql = "SELECT * FROM `route` WHERE 
   `r_name`=? AND
    `r_tag`=? AND
    `r_intro`=? AND
    `r_depart`=? AND
    `r_country`=? AND
    `r_arrive`=?;";
    
    $s_stmt= $pdo->prepare($s_sql);
    $s_stmt->execute(
        [$r_name,
        $r_tag,
        $r_intro,
        $r_depart,
        $r_country,
        $r_arrive,]
    );
    
    if ($s_stmt->rowCount()>=1){
        $result['errCode']=409;
        $result['errMsg']="路線已存在，請重新修改";
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }

    include __DIR__.'/upload.php';

    

    $sql = "INSERT INTO`route`(
            `r_name`, `r_intro`, `r_time`, `r_tag`, `r_country`, 
            `r_area`, `r_depart`, `r_arrive`, `r_img`,`r_time_added`, `r_l_num`) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
   
   try{
       $stmt=$pdo->prepare($sql);
        $stmt->execute([
                $r_name, 
                $r_intro, 
                $r_time, 
                $r_tag, 
                $r_country, 
                $r_area, 
                $r_depart, 
                $r_arrive, 
                $r_img,
                $r_time_added,
                $r_l_num
            ]);

        if($stmt->rowCount()==1){
            $result['last_sid']=$pdo->lastInsertId();
            if(!empty($r_img)){
            if(move_uploaded_file($_FILES['r_img']['tmp_name'],$upload_file)){
                $result['success']=true;
                $result['errCode']=200;
                $result['errMsg']='';
            }else{
                $result['errMsg']='暫存圖檔無法轉移';
                $result['errCode']=452;
            }}else{
                $result['success']=true;
                $result['errCode']=200;
                $result['errMsg']='';
            }
        }else{
            $result['errCode']=402;
            $result['errMsg']='路線新增錯誤';
        }

    }catch(PDOException $e){
        $result['errMsg']='路線新增錯誤<br>'.$e;
        $result['errCode']=403;
    }
    
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
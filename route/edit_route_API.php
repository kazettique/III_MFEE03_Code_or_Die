<?php
require __DIR__.'/__connect.php';
header('Content-Type: application/json');

$result=[
    'success'=> false,
    'errMsg'=>'資料輸入不完整',
    'errCode'=>0,
    'post'=>[]
];

$rsid=isset($_POST['r_sid']) ? intval($_POST['r_sid']):0;
$rcountry=isset($_POST['r_country']) ? $_POST['r_country']:'';
$rarea=isset($_POST['r_area']) ? $_POST['r_area']:'';

$sql = "SELECT * FROM `route` WHERE r_sid=$rsid";
$row= $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
if (empty($row)){
    $result['errCode']=410;
    $result['errMsg']="路線不存在";
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

$img_delete=$row['r_img'];

if(isset($_POST['r_name']) and !empty($rsid)){


    $r_name=$_POST['r_name'];
    $r_time=$_POST['r_time'];
    $r_tag=$_POST['r_tag'];
    $r_country=$rcountry;
    $r_area=$rarea;
    $r_depart=$_POST['r_depart'];
    $r_arrive=$_POST['r_arrive'];
    $r_intro=$_POST['r_intro'];

    $result['post']=$_POST;

    if(empty($r_tag) or empty($r_depart) or empty($r_arrive) or empty($r_time)or empty($r_country)){
        $result['errCode']=400;
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }



    //---------------------------------檢查格式----------------------------------------
      
    $s_sql = "SELECT * FROM `route` WHERE 
    `r_name`='$r_name' AND
        `r_tag`='$r_tag' AND
        `r_intro`='$r_intro' AND
        `r_depart`='$r_depart' AND
        `r_country`='$r_country' AND
        `r_arrive`='$r_arrive';";
        
    $s_stmt= $pdo->prepare($s_sql);
    $s_stmt->execute();
    if ($s_stmt->rowCount()>=2){
        $result['errCode']=409;
        $result['errMsg']="路線已存在，請重新修改";
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }
    //---------------------------------檢查格式----------------------------------------

    //---------------------------------upload cover img ----------------------------------------
    $upload_dir = '../the_wheel_uploads/';
    $new_img=false;
    if(!empty($_FILES['r_img']['name'])){
        $filename = sha1($_FILES['r_img']['name'].uniqid());

        $result['filename']=$filename;
        $new_img=true;
        switch($_FILES['r_img']['type']){
            case 'image/jpeg':
                $filename .= '.jpg';
                break;
    
            case 'image/png':
                $filename .= '.png';
                break;
    
            default:
                $result['errMsg']='圖像格式錯誤';
                $result['errCode']=451;
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                exit;
        }
    
        $upload_file = $upload_dir.$filename;
        $r_img=$filename;
    }else{
        $r_img=$row['r_img'];
    }

    
    //---------------------------------upload cover img ----------------------------------------
   


    $sql = "UPDATE `route` SET 
    `r_name`=?,
    `r_intro`=?,
    `r_time`=?,
    `r_tag`=?,
    `r_country`=?,
    `r_area`=?,
    `r_depart`=?,
    `r_arrive`=?,
     `r_img`=? 
     WHERE `r_sid`=?;";


   
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
            $rsid

        ]);

        if($stmt->rowCount()==1){
            if($new_img){
                if(move_uploaded_file($_FILES['r_img']['tmp_name'],$upload_file)){
                    $path = '../the_wheel_uploads/'.$img_delete;
                    if(file_exists($path)){
                        if(unlink($path)){
                            $result['success']=true;
                            $result['errCode']=200;
                            $result['errMsg']='';
                        }else{
                            $result['errCode']=459;
                            $result['errMsg']='修改封面未刪除乾淨';
                        }
                    }else{
                        $result['success']=true;
                        $result['errCode']=200;
                        $result['errMsg']='';
                    }

                }else{
                    $result['errMsg']='暫存圖檔無法轉移';
                    $result['errCode']=452;
                }
            }else{
                $result['success']=true;
                $result['errCode']=200;
                $result['errMsg']='';
            }

        }else{
            $result['errCode']=402;
            $result['errMsg']='路線沒有更新';
        }

    }catch(PDOException $e){
        $result['errMsg']='路線更新錯誤<br>'.$e;
        $result['errCode']=403;
    }
    
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
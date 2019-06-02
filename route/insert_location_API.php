<?php
require __DIR__.'/__connect.php';
header('Content-Type: application/json');
// var_dump($_POST);

$result=[
    'success'=> false,
    'errMsg'=>'資料輸入不完整',
    'errCode'=>0,
    'post'=>[]
];

//  echo '----------------------';

 $values =[];
 $question='';

$num =count($_POST['l_name']);

for($i=0;$i<$num;$i++){

     $k = isset($_POST['l_name'][$i])? $_POST['l_name'][$i]:'';
     $s =isset($_POST['l_intro'][$i])?$_POST['l_intro'][$i]:'';
     $lrsid =isset($_POST['r_sid'][$i])?$_POST['r_sid'][$i]:'';
     $lcountry =isset($_POST['l_country'][$i])?$_POST['l_country'][$i]:'';
     $larea =isset($_POST['l_area'][$i])?$_POST['l_area'][$i]:'';
     $lorder =isset($_POST['l_order'][$i])?$_POST['l_order'][$i]:'';

     if(empty($lrsid)){
        $result['errCode']=460;
        $result['errMsg']="無法確定地點歸屬路線";
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
     }

     if(empty($k)){
        $result['errCode']=461;
        $result['errMsg']="地點名稱未填寫";
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
     }

     $question.='(?,?,?,?,?,?),';
     array_push($values, $k);
     array_push($values, $s);
     array_push($values, $lrsid);
     array_push($values, $lcountry);
     array_push($values, $larea);
     array_push($values, $lorder);
    // $values .= "'$k','$s',";
    
}

// var_dump($values) ;
// echo '---------------';
// echo $question;
// echo '---------------';
$question = substr($question,0,-1);
// echo $question;



    $sql = "INSERT INTO`route_location`(
            `l_name`, `l_intro`,`r_sid`,`l_country`,`l_area`,`l_order`) 
    VALUES $question;";
   
   try{
       $stmt=$pdo->prepare($sql);
        $stmt->execute($values);

        if($stmt->rowCount()==$num){

                $result['success']=true;
                $result['errCode']=200;
                $result['errMsg']='地點新增成功';
            // if(move_uploaded_file($_FILES['r_img']['tmp_name'],$upload_file)){

            // }else{
            //     $result['errMsg']='暫存圖檔無法轉移';
            //     $result['errCode']=452;
            // }
        }else{
            $result['errCode']=402;
            $result['errMsg']='地點新增錯誤';
        }

    }catch(PDOException $e){
        $result['errMsg']='地點新增錯誤<br>'.$e;
        $result['errCode']=403;
    }
    

echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>
<?php
require __DIR__.'/__connect.php';
header('Content-Type: application/json');


$result=[
    'success'=> false,
    'errMsg'=>'資料輸入不完整',
    'errCode'=>0,
    'post'=>[],
    'sql'=> "",
    'value'=> ""
];
$num = count ($_POST['l_name']);
$values =[];
$question='';

for($i=0;$i<$num;$i++){

    $s =isset($_POST['l_sid'][$i])?$_POST['l_sid'][$i]:'';
    $k = isset($_POST['l_name'][$i])? $_POST['l_name'][$i]:'';
    $lrsid=isset($_POST['r_sid'][$i])?$_POST['r_sid'][$i]:'';
    $lcountry =isset($_POST['l_country'][$i])?$_POST['l_country'][$i]:'';
    $larea =isset($_POST['l_area'][$i])?$_POST['l_area'][$i]:'';
    $intro =isset($_POST['l_intro'][$i])?$_POST['l_intro'][$i]:'';
    $order =isset($_POST['l_order'][$i])?$_POST['l_order'][$i]:'';

    if(empty($k)){
    $result['errCode']=461;
    $result['errMsg']="地點名稱未填寫";
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
    }

    if(empty($lcountry)){
    $result['errCode']=462;
    $result['errMsg']="地點所屬國家未填寫";
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
    }


    $question.='(?,?,?,?,?,?,?),';
    array_push($values, $s);
    array_push($values, $k);   
    array_push($values, $lrsid);
    array_push($values, $lcountry);
    array_push($values, $larea);
    array_push($values, $intro);
    array_push($values, $order);
    
}
$question = substr($question,0,-1);

$sql="INSERT INTO `route_location` (
    `l_sid`,
    `l_name`,
    `r_sid`,
    `l_country`,
    `l_area`,
    `l_intro`,
    `l_order`)
    VALUES $question
    ON DUPLICATE KEY UPDATE l_sid=VALUES(l_sid),
    `l_name`=VALUES(`l_name`),
    `r_sid`=VALUES(`r_sid`),
    `l_country`=VALUES(`l_country`),
    `l_area`=VALUES(`l_area`),
    `l_intro`= VALUES(`l_intro`),
    `l_order`=VALUES(`l_order`);";
   
   try{
       $result["sql"]= $sql;
       $result['value'] = $values;
       $stmt=$pdo->prepare($sql);
        $stmt->execute($values);

        if($stmt->rowCount()>0){

                $result['success']=true;
                $result['errCode']=200;
                $result['errMsg']='地點修改成功';
        }else{
            $result['errCode']=402;
            $result['errMsg']='地點沒有修改';
        }

    }catch(PDOException $e){
        $result['errMsg']='地點修改錯誤<br>'.$e;
        $result['errCode']=403;
    };
echo json_encode($result, JSON_UNESCAPED_UNICODE);
// ?>
<?php
require __DIR__. '/__connect_db.php';
$upload_dir = __DIR__.'/uploads/';
    header('Content-Type: application/json');
   
$result = [
        'success'=>false,
        'errorCode'=>0,
        'errorMsg'=>'資料輸入不完整',
        'post'=>[],//做echo檢查
];


 if(isset($_POST['checkme'])){
    $e_name = $_POST['e_name'];
    $e_leader = $_POST['e_leader'];
    $e_depart = $_POST['e_depart'];
    $e_arrive = $_POST['e_arrive'];
    $e_date = $_POST['e_date'];
    $e_endTime = $_POST['e_endTime'];
    $e_via = $_POST['e_via'];
    $e_current = $_POST['e_current'];
    // $e_pic = $_POST['e_pic'];


  $filename = sha1($_FILES['e_pic']['name'].uniqid());
  
  $result['filename'] = $filename;
  $upload_file = $upload_dir.$filename;
  
  
  if(move_uploaded_file($_FILES['e_pic']['tmp_name'], $upload_file)){
      $result['success'] = true;
  }else{
      $result['info'] = '檔案無法搬移';
  }


    $sql = "INSERT INTO `e_list` 
    (`e_name`, `e_leader`, `e_depart`, `e_arrive`, `e_date`, `e_endTime`, `e_via`, `e_current`, `e_pic`
    
    ) VALUES(

      ?,?,?,?,?,?,?,?,?)";

try {
  $stmt = $pdo->prepare($sql);

  $stmt->execute([
    $_POST['e_name'],
    $_POST['e_leader'],
    $_POST['e_depart'],
    $_POST['e_arrive'],
    $_POST['e_date'],
    $_POST['e_endTime'],
    $_POST['e_via'],
    $_POST['e_current'],
    $filename,
  ]);

  if($stmt->rowCount()==1) {
    $result['success']= true;
    $result['errorCode']= 200;
    $result['errorMsg']= '資料正確';

  } else {
  
   $result['errorCode']= 402;
   $result['errorMsg']= '資料新增錯誤';
  }

}
  catch(PDOException $ex){
   $result['errorCode']= 403;
   $result['errorMsg']= 'Email重複輸入';
 
  }

}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
// header('Location: event_list.php');
?>

<?php
require __DIR__. '/p__connect.php';
$upload_dir = __DIR__.'/uploads/';
    header('Content-Type: application/json');
   
$result = [
        'success'=>false,
        'errorCode' =>0,
        'errorMsg ' =>'資料輸入不完整',
        'post'=>[],//做echo檢查
];



 if(isset($_POST['p_name'])){
    $name = $_POST['p_name'];
    $quantity = $_POST['quantity'];
    $description = $_POST['p_description'];
    $price = $_POST['p_price'];
    $genre = $_POST['p_genre'];
    $genre2 = $_POST['p_genre2'];
    $brand = $_POST['p_brand'];
    $color = $_POST['p_color'];
    $size = $_POST['p_size'];

    $result['post'] = $_POST;


  $filename = sha1($_FILES['p_photo']['name'].uniqid());
  
  // switch($_FILES['p_photo']['type']){
  //     case 'image/jpeg':
  //         $filename .= '.jpg';
  //         break;
  //     case 'image/png':
  //         $filename  .= '.png';
  //         break;
  //     default:
  //         $result['info'] = '格式不符';
  //         echo json_encode($result,JSON_UNESCAPED_UNICODE);
  //         exit;
  // }
  $result['filename'] = $filename;
  $upload_file = $upload_dir.$filename;
  
  
  if(move_uploaded_file($_FILES['p_photo']['tmp_name'], $upload_file)){
      $result['success'] = true;
  }else{
      // $result['info'] = '檔案無法搬移';
  }





    $sql = "INSERT INTO `prouduct` (`p_photo`, `p_name`, `quantity`, `p_description`, `p_price`, `p_genre`, `p_genre2`, `p_brand`, `p_color`, `p_size`
            ) VALUES(
        ?,?,?,?,?,?,?,?,?,?)";
try {
  $stmt = $pdo->prepare($sql);

  $stmt->execute([
    $filename,
    $_POST['p_name'],
    $_POST['quantity'],
    $_POST['p_description'],
    $_POST['p_price'],
    $_POST['p_genre'],
    $_POST['p_genre2'],
    $_POST['p_brand'],
    $_POST['p_color'],
    $_POST['p_size']
  ]);

  

    if($stmt->rowCount()==1) {
      $result['success']= true;
      $result['errorCode']= 200;
      $result['errorMsg']= '資料正確';
    } else {
        
        $result['errorCode']= 402;
        $result['errorMsg']= '資料新增錯誤';
        }
} catch(PDOException $ex){
   $result['errorCode']= 403;
   $result['errorMsg']= 'Email重複輸入';
 
}


}





echo json_encode($result, JSON_UNESCAPED_UNICODE);
// header('Location: p_data_list2.php');
?>
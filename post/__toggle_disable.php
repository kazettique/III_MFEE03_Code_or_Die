<?php

require __DIR__ . "./__connect_db.php";


// $result = [
//     "success" => false,
//     "errorCode" => 0,
//     "errorMsg" => "",
//     "post" => []
// ];


$sid = $_POST["sid"];
$disable = intval($_POST["disable"]);

echo $sid, $disable;




if (isset($_POST["sid"])) {
  #$result["post"] = $_POST;

  #if(empty($name) or empty($email) or empty($mobile)){
  #$result["errorCode"] = 400;
  #echo json_encode($result, JSON_UNESCAPED_UNICODE);
  #exit;
  #};

  # if(! filter_var($email, FILTER_VALIDATE_EMAIL)){
  # $result["errorCode"] = 405;
  # $result["errorMsg"] = "Invalid email format";
  # echo json_encode($result, JSON_UNESCAPED_UNICODE);
  # exit;
  # }


  # $sql="INSERT INTO `address_book`(`name`, `email`, `mobile`, `birthday`, `address`)
  #VALUES (?, ?, ?, ?, ?)";

  $sql = "UPDATE `test` SET `disable`=? WHERE`sid`=$sid";

  $stmt = $pdo->prepare($sql);

  $stmt->execute([
    $disable,
  ]);
}

$goto = "listtest.php";

echo $disable;

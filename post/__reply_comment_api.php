<?php

require __DIR__ . "./__connect_db.php";


$result = [
    "success" => false,
    "errorCode" => 0,
    "errorMsg" => "",
    "post" => [],
    "data" => []
];


$sid = $_POST["sid"];
$comment = $_POST["comment"];







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

    $sql = "UPDATE `test` SET `comment`=? WHERE `sid`=$sid";
    try {
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $_POST["comment"]

        ]);
        if ($stmt->rowCount() == 1) {
          $rsql = sprintf("SELECT `comment` FROM `test` WHERE `sid`=$sid");
          $stmt = $pdo->query($rsql);
          $result["data"] = $stmt->fetch(PDO::FETCH_ASSOC);
          $result["success"] = true;
        } else {
            $result["success"] = false;
            $result["errorCode"] = 402;
        }
    } catch (PDOException $ex) {
        $result["success"] = false;
        $result["errorCode"] = 403;
        $result["errorMsg"] = "Email duplicated";
    }
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
#header("location: listtest.php");

 
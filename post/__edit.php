<?php

require __DIR__ . "./__connect_db.php";
$page_name = "edit";

$result = [
    "success" => false,
    "errorCode" => 0,
    "errorMsg" => "",
    "post" => []
];

$type = $_POST["type"];
$sid = $_POST["sid"];
$editor_data = $_POST["content"];
$page = $_POST["hash"];






if (isset($_POST["content"])) {
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

    $sql = "UPDATE `test` SET `text`=?, `type`=?, `title`=? WHERE `sid`=$sid";
    try {
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $_POST["content"],
            $_POST["type"],
            $_POST["title"],

        ]);
        echo $_POST["content"];
        if ($stmt->rowCount() == 1) {
            $result["success"] = true;
            $result["errorCode"] = 200;
            $result["post"] = $editor_data;
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
header("location: listtest.php");

 
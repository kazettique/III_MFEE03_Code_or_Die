<?php
require __DIR__."./__connect_db.php";
$uploaddir = __DIR__."/upload/";
$filename = sha1($_FILES["uploaded"]["name"].uniqid());
$sid = $_POST["sid"];
switch ($_FILES["uploaded"]["type"]) {
case "image/jpeg":
   $filename .= ".jpeg";
   break;
case "image/png":
    $filename .= ".png";
    break;
default:
    $result["info"] = "3";
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;

}

$uploaded = $uploaddir.$filename;

if (move_uploaded_file($_FILES["uploaded"]["tmp_name"], $uploaded)) {
    $result["success"] = true;
    $result["filename"] = $filename;
} else {
    $result["info"] = "upload failed2";
}
echo $filename;
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

$sql = "UPDATE `test` SET `imgname`=? WHERE `sid`=$sid";
try {
    $stmt = $pdo->prepare($sql);

    $stmt->execute([$filename]);
    
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
echo json_encode($result);
header("location: list.php");

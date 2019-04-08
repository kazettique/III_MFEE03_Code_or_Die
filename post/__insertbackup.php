<?php

require __DIR__ . "./__connect_db.php";
$uploaddir = __DIR__ . "/upload/";
$page_name = "insert";

header("Content-Type: application/json");


$result = [
  "success" => false,
  "filename" => "",
  "errorCode" => 0,
  "errorMsg" => "",
  "post" => []
];

$type = $_POST["type"];
$editor_data = $_POST["content"];


//upload img
if (empty($_FILES["uploaded"])) {
  $result["info"] = "upload failed1";
  echo json_encode($result, JSON_UNESCAPED_UNICODE);
  exit;
}

$filename = sha1($_FILES["uploaded"]["name"] . uniqid());

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

$uploaded = $uploaddir . $filename;

if (move_uploaded_file($_FILES["uploaded"]["tmp_name"], $uploaded)) {
  $result["success"] = true;
  $result["filename"] = $filename;
} else {
  $result["info"] = "upload failed2";
}

if (isset($_POST["content"])) {
  $sql = "INSERT INTO `test`(`text`, `imgname`, `type`, `title`, `date`) VALUES (?, ?, ?, ?, ?)";
  try {
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
      $_POST["content"],
      $filename,
      $type,
      $_POST["title"],
      $_POST["date"]
    ]);

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
header("location: editor.php");

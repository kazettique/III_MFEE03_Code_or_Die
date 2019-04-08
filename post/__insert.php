<?php

require __DIR__ . "./__connect_db.php";

$page_name = "insert";




$result = [
    "success" => false,
    "errorCode" => 0,
    "errorMsg" => "",
    "post" => []
];

$type = $_POST["type"];
$editor_data = $_POST["content"];



if (isset($_POST["content"])) {
    $sql = "INSERT INTO `test`(`text`, `type`, `title`, `date`, `author`) VALUES (?, ?, ?, ?, ?)";
    try {
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $_POST["content"],
            $type,
            $_POST["title"],
            $_POST["date"],
            $_POST["author"]
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
header("location: listtest.php");

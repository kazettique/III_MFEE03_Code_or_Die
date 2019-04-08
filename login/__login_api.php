<?php
session_start();
require __DIR__ . "./__connect_db.php";
// header("Content-Type: application/json");
$result = [
    "success" => false,
    "admin" => []
];

if (isset($_POST['username']) && isset($_POST['password'])) {

    $username = $_POST['username'];

    $sql = sprintf("SELECT * FROM `admin` WHERE `id` = '$username'");
    $stmt = $pdo->query($sql);
    $result["admin"] = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($_POST['password'] == $result["admin"]["password"]) {

        $result["success"] = true;
        $_SESSION["username"] = $result["admin"]["name"];
    } else {
        $result["success"] = false;
    }
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);

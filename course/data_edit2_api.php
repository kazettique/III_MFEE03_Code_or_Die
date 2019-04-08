<?php
require __DIR__. '/__connect_db.php';

// 告訴瀏覽器要輸出的格式為JSON
header('Content-type: application/json');

$result = [
    'success' => false,
    'errorCode' => 0,
    'errorMsg' => '資料輸入不完整',
    'post' => [], // 做 echo 檢查
];

$sid = isset($_POST['sid']) ? intval($_POST['sid']) : 0;

// name跟sid必須有值
if(isset($_POST['c_name'])) {
    // 1. 修改資料之前可以先確認該筆資料是否存在
    $c_name = $_POST['c_name'];
    $c_instructor = $_POST['c_instructor'];
    $c_intro = $_POST['c_intro'];
    $c_photo = $_POST['c_photo'];
    $c_target = $_POST['c_target'];
    $c_deadline = $_POST['c_deadline'];

    $result['post'] = $_POST; // 做 echo 檢查



    // 's' means 'selected' here
//    $s_sql = "SELECT * FROM `address_book` WHERE `sid`=? OR `email`=?";
//    $s_stmt = $pdo->prepare($s_sql);
//    $s_stmt->execute([$sid, $_POST['email']]);
//
//    switch ($s_stmt->rowCount()) {
//        case 0:
//            $result['errorCode'] = 410;
//            $result['errorMsg'] = '該筆資料不存在';
//            echo json_encode($result, JSON_UNESCAPED_UNICODE);
//            exit;
//        //break;
//        case 2:
//            $result['errorCode'] = 420;
//            $result['errorMsg'] = 'Email 已存在';
//            echo json_encode($result, JSON_UNESCAPED_UNICODE);
//            exit;
//        case 1:
//            $row = $s_stmt->fecth(PDO::FETCH_ASSOC);
//            if ($row['sid'] != $sid) {
//                $result['errorCode'] = 430;
//                $result['errorMsg'] = '該筆資料不存在';
//                echo json_encode($result, JSON_UNESCAPED_UNICODE);
//                exit;
//            }
//    }

    $sql = "UPDATE `course` SET
                `c_name`=?,
                `c_instructor`=?,
                `c_intro`=?,
                `c_photo`=?,
                `c_target`=?,
                `c_deadline`=?
                WHERE `c_sid`=?";
    try {
        // 'PDO::prepare': Prepares a statement for execution and returns a statement object
        $stmt = $pdo->prepare($sql);

        // execute: Executes a prepared statement
        $stmt->execute([
            $_POST['c_name'],
            $_POST['c_instructor'],
            $_POST['c_intro'],
            $_POST['c_photo'],
            $_POST['c_target'],
            $_POST['c_deadline'],
            $sid
        ]);

        // PDOStatement::rowCount — Returns the number of rows affected by the last SQL statement
        if ($stmt->rowCount()==1) {
            $result['success'] = true;
            $result['errorCode'] = 200;
            $result['errorMsg'] = '';
        } else {
            $result['errorCode'] = 402;
            $result['errorMsg'] = '資料沒有修改';
        }
    } catch (PDOException $ex) {
        $result['errorCode'] = 403;
        $result['errorMsg'] = '資料更新發生錯誤';
    }
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
//header('Location: data_list.php');

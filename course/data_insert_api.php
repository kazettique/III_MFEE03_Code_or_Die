<?php
// 新增資料API

require __DIR__ . '/__connect_db.php';
header('Content-Type: application/json');
// 上傳檔案之路徑
$upload_dir = './upload_img/';

// info預設值
$info = [
    "success" => false,
    "msg" => [
        'type' => '',
        'info' => ''
    ]
];

$c_photo = $_FILES['c_photo'];
$c_photo_name = $c_photo['name'];
$c_photo_type = $c_photo['type'];
$c_photo_tmp_name = $c_photo['tmp_name'];


// 若圖片<input>欄位沒有選取的檔案，則終止程式
if (empty($c_photo)) {
    echo json_encode($info, JSON_UNESCAPED_UNICODE);
    exit;
}

// 修改檔案原始名稱
$filename = sha1($c_photo_name . uniqid());

switch ($c_photo_type) {
    case 'image/jpeg':
        $filename .= '.jpg';
        break;
    case 'image/png':
        $filename .= '.png';
        break;
    default:
        $msg['info'] = '格式不符';
        exit;
}

// 'my_file': 欄位名稱
// 'name': 原始檔名
$upload_file = $upload_dir . $filename;

// move_uploaded_file
// php會將傳完的檔案放在一個暫存的資料夾
// 'tmp_name': 暫存的檔名，沒有副檔名
// CAUTION! 若在瀏覽器出現Permission Denied訊息，請檢查目標資料匣的存取權限
// 將所有帳戶的存取權限都打開(READ & WRITE)
if (move_uploaded_file($c_photo_tmp_name, $upload_file)) {
    // 檔案名稱
//     echo "{$c_photo_name}<br>";
    // 檔案類型
//     echo "{$c_photo_type}<br>";
    // 檔案大小(byte)
//     echo "{$c_photo['size']}<br>";
    // 顯示上傳成功訊息
    // echo 'success';
    $info['msg'] = [
        'type' => 'success',
        'info' => '檔案上傳成功',
    ];

} else {
    $info['msg'] = [
        'type' => 'danger',
        'info' => '檔案上傳失敗',
    ];
    echo json_encode($info, JSON_UNESCAPED_UNICODE);
    exit;
}

$c_photo = $filename;

// 先賦予'空字串'
$c_name =
$c_instructor =
$c_intro =
$c_fundGoal =
$c_startDate =
$c_endDate = '';

// $_POST裡面的值要跟html表單中的'name'屬性的相等
$c_name = $_POST['c_name'];
$c_instructor = $_POST['c_instructor'];
$c_intro = $_POST['c_intro'];
$c_fundGoal = $_POST['c_fundGoal'];
$c_startDate = $_POST['c_startDate'];
$c_endDate = $_POST['c_endDate'];

// todo 檢查所有元素皆不能為'空字串'或'null'

$sql = "INSERT INTO `course`(
        `c_name`, `c_instructor`, `c_intro`, `c_photo`, `c_fundGoal`, `c_startDate`, `c_endDate`
        ) VALUES (
          ?, ?, ?, ?, ?, ?, ?
        )";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $c_name,
        $c_instructor,
        $c_intro,
        $c_photo,
        $c_fundGoal,
        $c_startDate,
        $c_endDate
    ]);

    if ($stmt->rowCount() == 1) {
        $info["success"] = true;
        $info["msg"] = [
            'type' => 'success',
            'info' => '資料新增成功',
        ];
    } else {
        $info["msg"] = [
            'type' => 'danger',
            'info' => '資料新增錯誤',
        ];
    }
} catch (PDOException $ex) {
//    echo $ex;
    $info["msg"] = [
        'type' => 'danger',
        'info' => 'System Error!!',
    ];
}
echo json_encode($info, JSON_UNESCAPED_UNICODE);
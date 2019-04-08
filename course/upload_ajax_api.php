<?php
// 摘要：用ajax的方式上傳檔案

$upload_dir = __DIR__. '/uploads/';

header('Content-Type: application/json');

// 定義上傳結果的初始值
$result = [
    'success' => false,
    'filename' => '',
    'info' => '',
];

if(empty($_FILES['my_file'])){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

// sha1:
// uniqid — Generate a unique ID
// Gets a prefixed unique identifier based on the current time in microseconds.
// uniqid根據時間(毫秒)生成一個id，是每一個生成的檔名都不同，然後再進行sha1編碼
// REF: http://php.net/manual/en/function.uniqid.php
// 使用uniqid隨機生成一個檔名，也可以使用rand()函式來生成隨檔名
$filename = sha1($_FILES['my_file']['name']. uniqid());

// 只允許jpeg及png檔案的上傳
switch($_FILES['my_file']['type']){
    case 'image/jpeg':
        $filename .= '.jpg';
        break;
    case 'image/png':
        $filename .= '.png';
        break;
    default:
        $result['info'] = '格式不符';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
}

$result['filename'] = $filename;

// 暫存檔案的搬移，更新成目標路徑
$upload_file = $upload_dir. $filename;

if(move_uploaded_file($_FILES['my_file']['tmp_name'], $upload_file)){
    $result['success'] = true;
} else {
    $result['info'] = '暫存檔無法搬移';
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);









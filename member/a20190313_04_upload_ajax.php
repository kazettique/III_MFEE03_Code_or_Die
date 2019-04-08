<?php
$upload_dir = __DIR__. '/uploads/';

header('Content-Type: application/json');

$result = [
    'success' => false,
    'filename' => '',
    'info' => '',
];

if(empty($_FILES['my_file'])){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

$filename = sha1($_FILES['my_file']['name']. uniqid());

//uniqid 抓取毫秒數

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
$upload_file = $upload_dir. $filename;

if(move_uploaded_file($_FILES['my_file']['tmp_name'], $upload_file)){
    $result['success'] = true;
} else {
    $result['info'] = '暫存檔無法搬移';
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);
// echo '<br>';
// print_r($result);
// echo '<br>';
// var_dump($result);

// echo 'acf';







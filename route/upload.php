 <?php 
// header('Content-Type:application/json');

$upload_dir = '../the_wheel_uploads/';
// $upload_dir =__DIR__. '/upload/';

// $result=[
//     'success'=> false,
//     'filename' => '',
//     'errMsg'=>'',
//     'errCode'=>0,
    
// ];


if(empty($_FILES['r_img']['name'])){
    $result['errCode']=450;
    $result['errMsg']='沒有上傳圖像';
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

$filename = sha1($_FILES['r_img']['name'].uniqid());

$result['filename']=$filename;

switch($_FILES['r_img']['type']){
    case 'image/jpeg':
        $filename .= '.jpg';
        break;

    case 'image/png':
        $filename .= '.png';
        break;

    default:
        $result['errMsg']='圖像格式錯誤';
        $result['errCode']=451;
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
}

$result['filename']=$filename;

$upload_file = $upload_dir.$filename;




// echo json_encode($result, JSON_UNESCAPED_UNICODE);

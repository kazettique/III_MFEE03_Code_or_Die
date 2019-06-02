<?php
require __DIR__.'/__connect.php';
header('Content-Type: application/json');
$result=[
    'success'=> false,
    'errMsg'=>'沒有輸入留言',
];

if(isset($_POST['r_c'])){
    
    if(empty($_POST['r_c'])){
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }

    $sql = "INSERT INTO `route_comment`(
            `r_sid`, `m_sid`, `r_c`, `r_c_time`) 
    VALUES (?, ?, ?, ?)";
   
   try{
       $stmt=$pdo->prepare($sql);
        $stmt->execute([
                $_POST['r_sid'], 
                $_POST['m_sid'],
                $_POST['r_c'],
                $_POST['r_c_time']
            ]);

        if($stmt->rowCount()==1){
            

                $result['success']=true;
                $result['errMsg']='';
                $sql = "SELECT rc.`r_c`, m.`m_name`, m.`m_photo`, rc.`r_c_time`, a.`name`
                        FROM `route_comment` AS rc  
                        LEFT JOIN `member` AS m ON m.`m_sid` = rc.`m_sid` 
                        LEFT JOIN `admin` AS a ON a.`id` = rc.`m_sid`
                        LEFT JOIN `route`AS r ON r.`r_sid`= rc.`r_sid` 
                        WHERE r.`r_sid`= {$_POST['r_sid']}";
   
                $result['all']=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            
        }else{
            $result['errMsg']='留言新增錯誤';
        }

    }catch(PDOException $e){
        $result['errMsg']='留言新增錯誤<br>'.$e;
    }
    
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
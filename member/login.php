<?php
require __DIR__. '/__connect_db.php';

$user = '';
$password = '';


if(isset($_POST['user']) and isset($_POST['password'])){

    $user = $_POST['user'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `member` WHERE `m_email`=? AND `m_password`=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $user,
        $password,
    ]);
    
  

   
    if($stmt->rowCount()==1) {
       
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        print_r($row);
        
        foreach ($row as $key => $value) {
            echo 'key='.$key.' ; value='.$value.'<br>';
        }
      
       echo $row['m_sid'].'<br>';

       $sid=$row['m_sid'];
       echo $sid.'<br>';
       

       $my_array=array($user,$sid);
       $_SESSION['admin'] = $my_array;
       echo   $_SESSION['admin'][1].'<br>';

        header('Location: data_edit2.php?sid='.$sid);
        // header('Location: data_list3.php');
        exit;
    } else {
        $msg = '帳號或密碼錯誤';
    }

}


?>
<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.css">
    <script src="./js/jquery-3.3.1.js"></script>
    <script src="./bootstrap/js/bootstrap.bundle.js"></script>
</head>
<body>
<div class="container">

    <?php if(! isset($_SESSION['admin'])): ?>

        <?php if(isset($msg)): ?>
            <div class="alert alert-danger" role="alert">
                <?= $msg ?>
            </div>
        <?php endif ?>

        <form method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="user" placeholder="用戶名稱" value="<?= $user ?>">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="密碼" value="<?= $password ?>">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    <?php else: ?>

    <?php 
      $sid =  $_SESSION['admin'][1] ;
      header('Location: data_edit2.php?sid='.$sid);
    ?>
        <script>
            // var str ="";
            // console.log(str);
            // location.href = `./data_edit2.php?sid=""`;

        
          
        </script>
    <?php endif; ?>
</div>

</body>
</html>

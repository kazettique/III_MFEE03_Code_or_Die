<?php
require __DIR__. '/__connect_db.php';
$page_name = 'event_insert2';

$sid = isset($_GET['e_sid']) ? intval($_GET['e_sid']) : 0;

$sql = "SELECT * FROM `e_list` WHERE 1";

$stmt = $pdo->query($sql);

$e_sid = '';
$s_name = '';
$s_phone = '';

if(isset($_POST['checkme'])){
    $e_name = htmlentities($_POST['e_sid']);
    $e_leader = htmlentities($_POST['s_name']);
    $e_depart = htmlentities($_POST['s_phone']);


    $sql = "INSERT INTO `signup`(
            `e_sid`, `s_name`, `s_phone`
            ) VALUES (
              ?, ?, ?
            )";
    try {
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $_POST['e_sid'],
            $_POST['s_name'],
            $_POST['s_phone'],
        ]);

        if($stmt->rowCount()==1) {
            
            $success = true;
            // $msg = [
            //     'type' => 'success',
            //     'info' => '資料新增成功',
            // ];
            // swal({
            //     title: "報名成功",
            //     text: "已報名活動",
            //     icon: "success",
            //     button: "確定!",
            // });

            header('Location: event_list2.php');
        } else {
            $msg = [
                'type' => 'danger',
                'info' => '資料新增錯誤',
            ];
        }
    } catch(PDOException $ex){
        $msg = [
            'type' => 'danger',
            'info' => 'Email 重複輸入',
        ];
    }

}

?>
<?php include __DIR__. '/__html_head.php';  ?>
<?php include __DIR__.'/../_navbar.php'; ?>
    <style>
        .form-group small {
            color: red !important;
        }

    </style>
<div class="container">

    <div class="row">
        <div class="col-lg-6">
            <?php if(isset($msg)): ?>
                <div class="alert alert-<?= $msg['type'] ?>" role="alert">
                    <?= $msg['info'] ?>
                </div>
            <?php endif ?>
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">報名活動
                    </h5>

                    <form name="form1" method="post" onsubmit="return checkForm()">
                        <input type="hidden" name="checkme" value="check123">
                        <div class="form-group">
                            <label for="e_sid"></label>
                                <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <label class="input-group-text" for="genre">活動</label>
                                </div>
                                <select class="custom-select" id="e_sid" name="e_sid" value="<?= $row['e_sid'] ?>">
                                    <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                                    <option value="<?= $row['e_sid'] ?>"><?= $row['e_name'] ?></option>
                                    <?php endwhile ?>
                                </select>
                                </div>
                            <small id="e_sidHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="s_name">姓名</label>
                            <input type="text" class="form-control" id="s_name" name="s_name" placeholder=""
                                   value="<?= $s_name ?>">
                            <small id="s_nameHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="s_phone">電話</label>
                            <input type="text" class="form-control" id="s_phone" name="s_phone" placeholder=""
                                   value="<?= $s_phone ?>">
                            <small id="s_phoneHelp" class="form-text text-muted"></small>
                        </div>


                        <button type="submit" class="btn bgc-green color-white">送出</button>
                    </form>

                </div>
                <button class="btn bgc-green text-align:right;"> <a href="event_list.php" class="color-white">回到上一頁</a></button>
            </div>
        </div>
    </div>

</div>

    <script>
        const fields = [
            'e_sid',
            's_name',
            's_phone',
        ];

        const fs = {};
        for(let v of fields){
            fs[v] = document.form1[v];
        }
        // console.log(fs);
        // console.log('fs.e_name:', fs.e_name);

        const checkForm = ()=>{
           
            swal({
                title: "報名成功",
                text: "已報名活動",
                icon: "success",
                button: "確定!",
            });
            let isPassed = true;

            
            const fsv = {};
            for(let v of fields){
                fsv[v] = fs[v].value;
            }
            console.log(fsv);
        }
    </script>
<?php include __DIR__. '/__html_foot.php'; ?>

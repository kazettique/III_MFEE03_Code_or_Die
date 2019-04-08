<?php
require __DIR__. '/__connect_db.php';
$page_name = 'event_edit2';

$sid = isset($_GET['s_sid']) ? intval($_GET['s_sid']) : 0;

$sql = "SELECT * FROM `signup` WHERE `s_sid`=$sid";

$stmt = $pdo->query($sql);
if($stmt->rowCount()==0){
    header('Location: event_list2.php');
    exit;
}
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<?php include __DIR__. '/__html_head.php';  ?>
<?php include __DIR__.'/../sidebar/__nav.php'; ?>
    <style>
        .form-group small {
            color: red !important;
        }

    </style>
<div class="container">

    <div class="row">
        <div class="col-lg-6">

                <div id="info_bar" class="alert alert-success" role="alert" style="display: none">
                </div>

            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">修改活動資料
                    </h5>

                    <form name="form1" method="post" action="event_edit_api.php" onsubmit="return checkForm();">
                        <input type="hidden" name="checkme" value="check123">
                        <input type="hidden" name="s_sid" value="<?= $row['s_sid']?>" value="<?= $row['e_sid']?>" value="<?= $row['s_name']?>" value="<?= $row['s_phone']?>">
                        <div class="form-group">
                            <label for="e_sid">活動名稱</label>
                            <input type="text" class="form-control" id="e_sid" name="e_sid" placeholder=""
                                   value="<?= $row['e_sid']?>">
                            <small id="e_sidHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="s_name"></label>發起人</label>
                            <input type="text" class="form-control" id="s_name" name="s_name" placeholder=""
                                   value="<?= $row['s_name']?>">
                            <small id="s_nameHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="s_phone">出發地</label>
                            <input type="text" class="form-control" id="s_phone" name="s_phone" placeholder=""
                                   value="<?= $row['s_phone']?>">
                            <small id="s_phoneHelp" class="form-text text-muted"></small>
                        </div>
                      

                        <button id="submit_btn" type="submit" class="btn bgc-green color-white">送出</button>
                    </form>

                </div>
                <button class="btn bgc-green text-align:right;"> <a href="event_list2.php" class="color-white">回到上一頁</a></button>
            </div>
        </div>
    </div>


</div>
    <script>
        const info_bar = document.querySelector('#info_bar');
        const submit_btn = document.querySelector('#submit_btn');

        const fields = [
            'e_sid',
            's_name',
            's_phone',
        ];

       
        const fs = {};
        for(let v of fields){
            fs[v] = document.form1[v];
        }
        

        const checkForm = ()=>{
            let isPassed = true;
            info_bar.style.display = 'none';

            
            const fsv = {};
            for(let v of fields){
                fsv[v] = fs[v].value;
            }

            if(isPassed) {
                let form = new FormData(document.form1);

                submit_btn.style.display = 'none';

                fetch('event_edit2_api.php', {
                    method: 'POST',
                    body: form
                })
                    .then(response=>response.json())
                    .then(obj=>{
                        console.log(obj);

                        info_bar.style.display = 'block';

                        if(obj.success){
                            // info_bar.className = 'alert alert-success';
                            // info_bar.innerHTML = '資料修改成功';
                            swal({
                            title: "資料修改成功!",
                            text: "您的資料已經變更",
                            icon: "success",
                            button: "確定!",
                            });
                            // location.href = 'event_list2.php';
                        } else {
                            info_bar.className = 'alert alert-danger';
                            info_bar.innerHTML = obj.errorMsg;
                        }

                        submit_btn.style.display = 'block';
                    });
            }
            return false;
        };
       
    </script>

<?php include __DIR__. '/__html_foot.php';  ?>

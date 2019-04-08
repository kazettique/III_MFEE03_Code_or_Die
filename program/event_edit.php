<?php
require __DIR__. '/__connect_db.php';
$page_name = 'event_edit';

$sid = isset($_GET['e_sid']) ? intval($_GET['e_sid']) : 0;

$sql = "SELECT * FROM `e_list` WHERE `e_sid`=$sid";
$stmt = $pdo->query($sql);

if($stmt->rowCount()==0){
    header('Location: event_list.php');
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
                        <input type="hidden" name="e_sid" value="<?= $row['e_sid']?>" value="<?= $row['e_leader']?>" value="<?= $row['e_depart']?>" value="<?= $row['e_arrive']?>" value="<?= $row['e_date']?>" value="<?= $row['e_endTime']?>" value="<?= $row['e_via']?>" value="<?= $row['e_current']?>" value="<?= $row['e_pic']?>">

                        <div class="form-group">
                            <label for="e_name">活動名稱</label>
                            <input type="text" class="form-control" id="e_name" name="e_name" placeholder=""
                                   value="<?= $row['e_name']?>">
                            <small id="e_nameHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="e_leader"></label>發起人</label>
                            <input type="text" class="form-control" id="e_leader" name="e_leader" placeholder=""
                                   value="<?= $row['e_leader']?>">
                            <small id="e_leaderHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="e_depart">出發地</label>
                            <input type="text" class="form-control" id="e_depart" name="e_depart" placeholder=""
                                   value="<?= $row['e_depart']?>">
                            <small id="e_departHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="e_arrive">目的地</label>
                            <input type="text" class="form-control" id="e_arrive" name="e_arrive" placeholder=""
                                   value="<?= $row['e_arrive']?>">
                            <small id="e_arriveHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="e_date">日期</label>
                            <input type="text" class="form-control" id="e_date" name="e_date" placeholder="YYYY-MM-DD"
                                   value="<?= $row['e_date']?>">
                            <small id="e_dateHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="e_endTime">預計結束時間</label>
                            <input type="text" class="form-control" id="e_endTime" name="e_endTime" placeholder="YYYY-MM-DD"
                                   value="<?= $row['e_endTime']?>">
                            <small id="e_endTimeHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="e_via">中途停靠站</label>
                            <input type="text" class="form-control" id="e_via" name="e_via" placeholder=""
                                   value="<?= $row['e_via']?>">
                            <small id="e_viaHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="e_current">目前人數</label>
                            <input type="text" class="form-control" id="e_current" name="e_current" placeholder=""
                                   value="<?= $row['e_current']?>">
                            <small id="e_currentHelp" class="form-text text-muted"></small>
                        </div>

                        <div class="form-group">
                            <label for="e_pic">照片</label>
                            <input type="file" class="form-control-file" id="e_pic" name="e_pic" placeholder="" accept="image/*" value="<?= $row['e_pic']?>">
                            <small id="e_picHelp" class="form-text text-muted"></small>
                        </div>


                        <button id="submit_btn" type="submit" class="btn bgc-green color-white">送出</button>
                    </form>
                    
                </div>
                <button class="btn bgc-green text-align:right;"> <a href="event_list.php" class="color-white">回到上一頁</a></button>
            </div>
        </div>
    </div>


</div>
    <script>
        const info_bar = document.querySelector('#info_bar');
        const submit_btn = document.querySelector('#submit_btn');
        const form1 = document.querySelector('#form1');

        const fields = [
            'e_name',
            'e_leader',
            'e_depart',
            'e_arrive',
            'e_date',
            'e_endTime',
            'e_via',
            'e_current',
            'e_pic',
        ];

       
        const fs = {};
        for(let v of fields){
            fs[v] = document.form1[v];
        }
        
        const pic = document.querySelector('#pic');
        const epic = document.querySelector('#e_pic');
        epic.addEventListener("change", ()=> {
        pic.src= URL.createObjectURL(event.target.files[0]);

        });
        


        const checkForm = ()=>{
            let isPassed = true;
            // info_bar.style.display = 'none';

            
            const fsv = {};
            for(let v of fields){
                fsv[v] = fs[v].value;
            }

            if(isPassed) {
                let form = new FormData(document.form1);

                submit_btn.style.display = 'none';

                fetch('event_edit_api.php', {
                    method: 'POST',
                    body: form
                })
                    .then(response=>response.json())
                    .then(obj=>{
                        // console.log(obj);

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
                            // location.href = 'event_list.php';
                        } else {
                            info_bar.className = 'alert alert-danger';
                            info_bar.innerHTML = obj.errorMsg;
                        }

                        submit_btn.style.display = 'block';
                    });
            }
            // return isPassed;
            return false;
        };
       
    </script>

<?php include __DIR__. '/__html_foot.php';  ?>

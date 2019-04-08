<?php
require __DIR__. '/__connect_db.php';
$page_name = 'data_edit2';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$sql = "SELECT * FROM course WHERE c_sid=$sid";

$stmt = $pdo->query($sql);
// 若沒有資料，導向至data_list頁面
if($stmt->rowCount()==0){
    header('Location: data_list.php');
    exit;
}
// 將值拿出來
$row = $stmt->fetch(PDO::FETCH_ASSOC);
// undone

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
        <div class="col-lg-10">
            <!-- 如果有錯誤或成功訊息則顯示 -->
            <!-- undone -->
            <div id="info_bar" class="alert alert-success" role="alert" style="display: none;">
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        編輯活動
                    </h5>
                    <form name="form1" method="post" onsubmit="return checkForm();" enctype="multipart/form-data">
                        <input type="hidden" name="checkme" value="check123">
                        <input type="hidden" name="sid" value="<?= $row['c_sid']?>">
                        <div class="form-group">
                            <label for="c_name">課程名稱</label>
                            <input type="text" class="form-control" id="c_name" name="c_name" placeholder="請輸入課程名稱"
                                   value="<?= $row['c_name']?>">
                            <small id="nameHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="c_instructor">課程教練</label>
                            <input type="text" class="form-control" id="c_instructor" name="c_instructor" placeholder="請輸入教練姓名"
                                   value="<?= $row['c_instructor']?>">
                            <small id="instructorHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="c_intro">課程內容</label>
                            <textarea class="form-control" id="c_intro" name="c_intro" cols="30" rows="3" placeholder="請輸入課程內容及簡介"><?= $row['c_intro'] ?></textarea>
                            <small id="introHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="c_photo">教練頭像</label>
                            <img id="uploadPhoto" src="<?= './upload_img/'. $row['c_photo'] ?>" alt="" width="200px">
                            <input type="file" class="form-control" id="c_photo" name="c_photo" placeholder="更換照片(JPG,PNG檔)">
                            <small id="birthdayHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="c_target">目標集資金額</label>
                            <input type="text" class="form-control" id="c_target" name="c_target" placeholder="請輸入目標金額(NT$)"
                                   value="<?= $row['c_target'] ?>">
                            <small id="targetHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="c_deadline">集資截止日</label>
                            <input type="date" class="form-control" id="c_deadline" name="c_deadline" placeholder="請輸入截止日期"
                                   value="<?= $row['c_deadline'] ?>">
                            <small id="deadlineHelp" class="form-text text-muted"></small>
                        </div>
                        <button id="submit_btn" type="submit" onclick="" class="btn btn-success">送出資料</button>
                        <a href="javascript: history.back()" class="btn btn-dark">返回列表</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 表格檢查script -->
<script>

    const info_bar = document.querySelector('#info_bar');
    const submit_btn = document.querySelector('#submit_btn');

    const fields = [
        'c_name',
        'c_instructor',
        'c_intro',
        'c_photo',
        'c_target',
        'c_deadline',
    ];

    // 拿到每個欄位的參照
    const fs = {};
    for(let v of fields){
        fs[v] = document.form1[v];
    }
    console.log(fs);
    console.log('fs.name: ', fs.name);


    const checkForm = ()=>{
        let isPassed = true;
        info_bar.style.display = 'none';

        // 拿到每個欄位的值
        const fsv = {};
        for(let v of fields){
            fsv[v] = fs[v].value;
        }
        console.log('fsv: ', fsv);


        if(isPassed) {
            let form = new FormData(document.form1);

            // submit_btn.style.display = 'none';

            fetch('data_edit2_api.php', {
                method: 'POST',
                body: form
            })
                .then(response=>response.json())
                // .then(response=>response.text())
                // .then(text => console.log(text))
                .then(obj=>{
                    // console.log(obj);
                    // location.href = 'data_list.php';
                    // info_bar.style.display = 'block';

                    // if(obj.success){
                    //     info_bar.className = 'alert alert-success';
                    //     info_bar.innerHTML = '資料修改成功';
                    //     location.href = 'data_list.php';
                    //     // header('Location: data_list.php');
                    // } else {
                    //     info_bar.className = 'alert alert-danger';
                    //     info_bar.innerHTML = obj.errorMsg;
                    //     location.href = 'data_list.php';
                    // }

                    // submit_btn.style.display = 'block';
                    // setTimeout(redirect, 300);
                }
                );
        }
        return false;
    }
    // const redirect =() => {
    //     location.href = 'data_list.php';
    // };
    // header('Location: data_list.php');
</script>

<?php include __DIR__. '/__html_foot.php';  ?>


<?php
require __DIR__ . '/__connect_db.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
$sql = "SELECT * FROM course WHERE c_sid=$sid";
$stmt = $pdo->query($sql);

if ($stmt->rowCount() == 0) {
    header('Location: data_list.php');
    exit;
}

$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<?php include __DIR__ . '/__html_head.php'; ?>
    <!-- 暫用navbar(自製) -->
<?php //include __DIR__ . '/__navBar.php'; ?>
    <!-- 共用navbar -->
    <?php include __DIR__.'/../sidebar/__nav.php'; ?>
    <!-- 導入通用資料表格 -->
<?php include __DIR__ . '/__html_form.php'; ?>

    <!-- data_edit Script -->
    <script>

        // Fill values from database into the form.
        $('#c_name').attr('value', "<?= $row['c_name']?>");
        $('#c_fundGoal').attr('value', "<?= $row['c_fundGoal']?>");
        $('#c_startDate').attr('value', "<?= $row['c_startDate']?>");
        $('#c_endDate').attr('value', "<?= $row['c_endDate']?>");
        $('#c_instructor').attr('value', "<?= $row['c_instructor']?>");
        $('#c_photo').attr('src', "./upload_img/<?= $row['c_photo'] ?>");
        $('#upload_photo').attr('src', "./upload_img/<?= $row['c_photo'] ?>");
        // Using BACK TICK to avoid "SYNTAX ERROR"!!
        // Because CKEditor added 'line break' AUTOMATICALLY in content of textarea and saving into database.
        // Don't ask me why! I don't know either!
        $('#c_intro').text(`<?= $row['c_intro']?>`);

        const my_img = document.querySelector('#upload_photo');
        const my_file = document.querySelector('#c_photo');
        const info_bar = document.querySelector('#info_bar');
        const submit_btn = document.querySelector('#submit_btn');

        const fields = [
            'c_name',
            'c_instructor',
            'c_intro',
            'c_photo',
            'c_fundGoal',
            'c_startDate',
            'c_endDate'
        ];

        // 拿到每個欄位的參照
        const fieldsObj = {};
        for (let val of fields) {
            fieldsObj[val] = document.course_form[val];
        }

        my_file.addEventListener('change', event => {
            fieldsObj.c_photo = my_file.value;
            $('#c_photo').attr('value', fieldsObj.c_photo);
        });

        // FUNCTION: Form Input Format Checker
        const checkForm = () => {
            let isPassed = true;
            // info_bar.style.display = 'none';
            // 拿到每個欄位的值
            const fieldsObjVal = {};
            let i = 1; // test use
            for (let val of fields) {
                // console.log('[line.233] i = ' + i); // test use
                if (val === 'c_fundGoal') {
                    fieldsObjVal[val] = removeThousandSeparator(fieldsObj[val].value);
                    // console.log('(line.236) fieldsObjVal[val]: ' + fieldsObjVal[val]);
                } else if (val === 'c_photo') {
                    // fieldsObjVal[val] = fieldsObj[val].value;
                    // console.log('[line.239] fieldsObj.c_photo: ' + fieldsObj.c_photo);
                } else if (val === 'c_intro') {
                    // fieldsObjVal[val] = $('.cke_editable').find('p').text();
                    // console.log('[line.242] p.text(): ' + fieldsObjVal[val])
                } else {
                    fieldsObjVal[val] = fieldsObj[val].value;
                    // console.log('[line.245] fieldsObjVal[val]: ' + fieldsObjVal[val]);
                }
                i++; // test use
            }

            /*
            // 樣式初始化
            for (let val of fields) {
                console.log('fieldsObj[val]: ' + fieldsObj[val]);
                // fieldsObj[val].style.borderColor = '#cccccc';
                document.querySelector('#' + val + 'Help').innerHTML = '';
                console.log('the end: (line.245) '+ fieldsObj[val]);
            }
            */
            /*
            // 集資金額內容檢查
            if (fieldsObjVal.c_fundGoal === 0) {
                fieldsObj.c_fundGoal.style.borderColor = 'red';
                document.querySelector('#c_fundGoalHelp').innerHTML = '集資金額不能為零!';
                isPassed = false;
            }
            */

            if (isPassed) {
                let form = new FormData(document.course_form);
                submit_btn.style.className = 'btn btn-disabled col-lg-8';

                let trans_num = removeThousandSeparator(form.get('c_fundGoal'));
                form.set('c_fundGoal', trans_num);

                let get_textarea = getTextareaContent();
                form.set('c_intro', get_textarea);

                console.log(form.get('c_photo'));

                // console.log('[line.277] form.c_fundGoal: ' + form.get('c_fundGoal'));
                fetch('data_insert_api.php', {
                    method: 'POST',
                    body: form
                })
                    .then(response => response.json())
                    .then(obj => {
                        // console.log('[line.273] obj:' + obj);
                        // console.log('[line 285]: ' + JSON.stringify(obj));
                        //
                        // for (let key in obj) {
                        //     console.log('[line 287] obj key: ' + key + ' / ' + 'value: ' + obj[key]);
                        // }

                        info_bar.style.display = 'block';

                        if (obj.success) {
                            info_bar.className = 'alert alert-success';
                            info_bar.innerHTML = '資料新增成功';
                        } else {
                            info_bar.className = 'alert alert-danger';
                            info_bar.innerHTML = obj.errorMsg;
                        }
                        submit_btn.style.className = 'btn btn-success';
                    });
            }
            return false;
        };


    </script>
<?php include __DIR__ . '/__html_foot.php'; ?>
<?php
require __DIR__ . '/__connect_db.php';
$page_name = 'data_insert';

?>
<?php include __DIR__ . '/__html_head.php';  ?>
<?php include __DIR__ . '/__navbar.php';  ?>
<style>
    .form-group small {
        color: red !important;
    }

    body {
        /* background-color: #dcdce2; */
    }

    .imgbox {
        width: 180px;
        height: 180px;
        border: 1px solid black;
        /* overflow: hidden; */
        background-image: url(https://images2.imgbox.com/b0/c3/sQxunS2i_o.png);
        opacity: 0.7;
        background-size: cover;
    }

    h5{
        /* background:linear-gradient(#000000,#FFFFFF) */
        margin:-20px;
        background:#1c2938;
        color:#FFFFFF;
    }

    .card{
        /* background:radial-gradient(#a7a8bd,#475164);
        box-shadow: 12px 15px 18px #474747; */
        /* background-color: #dcdce2; */
       
    }

    #my_file{
        display: block;
    }

    #submit_btn{
        border:1px solid #2addc7;
    }

    #submit_btn:hover{
        color:black;
    }
</style>
<div class="container">

    <div class="row">
        <div class="col-lg-8 mx-auto my-5">

           

            <div class="card border-0">

                <div class="card-body  ">
                    <h5 class="card-title text-center font-weight-bold py-2 display-5">註冊會員
                    </h5>

                    <form name="form1" method="post" onsubmit="return checkForm();">

                        <input type="hidden" name="checkme" value="check123">

                        <div class="form-group">
                            <div class="imgbox ">
                                <img id="myimg" src="" alt="" width="100%" height="100%" style="object-fit: cover ">
                            </div>
                            <br>
                            <input type="file" name="my_file" id="my_file" class="" >

                            <input type="hidden" id="myimg_src" name="myimg_src" value="">
                        </div>


                        <div class="form-group">
                            <label for="m_name">姓名</label>
                            <input type="text" class="form-control col-12 " id="m_name" name="m_name" placeholder="" value="">
                            <small id="m_nameHelp" class="form-text text-muted"></small>
                        </div>

                        <div class="form-group">
                            <label for="m_mobile">手機</label>
                            <input type="text" class="form-control col-12 " id="m_mobile" name="m_mobile" placeholder="" value="">
                            <small id="m_mobileHelp" class="form-text text-muted"></small>
                        </div>

                        <div class="form-group">
                            <label for="m_email">電郵(帳號)</label>
                            <input type="text" class="form-control col-12 " id="m_email" name="m_email" placeholder="" value="">
                            <small id="m_emailHelp" class="form-text text-muted"></small>
                        </div>

                        <div class="form-group">
                            <label for="m_password">密碼</label>
                            <input type="password" class="form-control col-12 " id="m_password" name="m_password" placeholder="" value="">
                            <small id="m_passwordHelp" class="form-text text-muted"></small>
                        </div>

                        <div class="form-group">
                            <label for="confirm_password">確認密碼</label>
                            <input type="password" class="form-control col-12 " id="confirm_password" name="confirm_password" placeholder="" value="">
                            <small id="confirm_passwordHelp" class="form-text text-muted"></small>
                        </div>

                        <div class="form-group">
                            <label for="m_birthday">生日</label>
                            <input type="date" class="form-control col-12 " id="m_birthday" name="m_birthday" placeholder="YYYY-MM-DD" value="">
                            <small id="m_birthdayHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <!-- <label for="m_address">地址</label>
                            <textarea class="form-control" id="m_address" name="m_address" cols="30" rows="3"></textarea> -->
                            <!-- <small id="m_addressHelp" class="form-text text-muted"></small> -->
                            <label for="m_address">地址</label>
                            <div id="zipcode3" class="d-flex">
                                <div class="f3 col-6 pl-0 " data-role="county" >
                                </div>
                                <div class="f4 col-6 pr-0 " data-role="district" >
                                </div>
                            </div>
                            <input  id="m_address" name="m_address" type="text" class="f13 address form-control my-3 ">

                            <script>
                                $("#zipcode3").twzipcode({
                                    "zipcodeIntoDistrict": true,
                                    "css": ["city form-control ", "town form-control "],
                                    "countyName": "m_city", // 指定城市 select name
                                    "districtName": "m_town"  // 指定地區 select name
                                });
                            </script>


                        </div>
                      



                        <div class="d-flex justify-content-around">
                        <button id="submit_btn" type="submit" class="btn btn-info" style="background-color:#2addc7">送出資料</button>
                        <a href="javascript:history.back()" class="btn btn-dark">返回列表</a>
                        </div>
                    </form>

                </div>
            </div>
            <div id="info_bar" class="alert alert-success" role="alert" style="display: none">
            </div>
        </div>
    </div>




</div>
<script>
    //圖片上傳開始

    const myimg = document.querySelector('#myimg');
    const my_file = document.querySelector('#my_file');
    const myimg_src = document.querySelector('#myimg_src');

    my_file.addEventListener('change', event => {
        //console.log(event.target);
        const fd = new FormData();

        fd.append('my_file', my_file.files[0]);

        fetch('a20190313_04_upload_ajax.php', {
                method: 'POST',
                body: fd
            })
            .then(response => response.json())
            .then(obj => {
                console.log(obj);
                myimg.setAttribute('src', 'uploads/' + obj.filename);
                console.log(myimg);
                myimg_src.value = 'uploads/' + obj.filename;
                console.log(myimg_src.value);

            });
    });

    //圖片上傳結束


    const info_bar = document.querySelector('#info_bar');
    const submit_btn = document.querySelector('#submit_btn');

    const fields = [
        'm_name',
        'm_mobile',
        'm_email',
        'm_password',
        'confirm_password',
        'm_birthday',
        
    ];

    // 拿到每個欄位的參照
    const fs = {};
    for (let v of fields) {
        fs[v] = document.form1[v];
    }
    console.log(fs);
    console.log('fs.name:', m_name)


    const checkForm = () => {
        let isPassed = true;
        info_bar.style.display = 'none';

        // 拿到每個欄位的值
        const fsv = {};
        for (let v of fields) {
            fsv[v] = fs[v].value;
        }
        console.log(fsv);


        let email_pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        let mobile_pattern = /^09\d{2}\-?\d{3}\-?\d{3}$/;

        for (let v of fields) {
            fs[v].style.borderColor = '#cccccc';
            document.querySelector('#' + v + 'Help').innerHTML = '';
        }

        if (fsv.m_name.length < 2) {
            fs.m_name.style.borderColor = 'red';
            document.querySelector('#m_nameHelp').innerHTML = '請填寫正確的姓名!';

            isPassed = false;
        }
        if (!email_pattern.test(fsv.m_email)) {
            fs.m_email.style.borderColor = 'red';
            document.querySelector('#m_emailHelp').innerHTML = '請填寫正確的 Email!';
            isPassed = false;
        }
        if (!mobile_pattern.test(fsv.m_mobile)) {
            fs.m_mobile.style.borderColor = 'red';
            document.querySelector('#m_mobileHelp').innerHTML = '請填寫正確的手機號碼!';
            isPassed = false;
        }

        if (fsv.m_password !== fsv.confirm_password) {
            fs.m_password.style.borderColor = 'red';
            fs.confirm_password.style.borderColor = 'red';
            document.querySelector('#m_passwordHelp').innerHTML = '兩次密碼輸入不一致!';
            document.querySelector('#confirm_passwordHelp').innerHTML = '兩次密碼輸入不一致!';
            isPassed = false;

        }


        if (isPassed) {
            let form = new FormData(document.form1);

            console.log(form);

            submit_btn.disabled = true;

            fetch('data_insert_2_api.php', {
                    method: 'POST',
                    body: form
                })
                .then(response => response.json())
                .then(obj => {
                    console.log(obj);

                    info_bar.style.display = 'block';

                    if (obj.success) {
                        info_bar.className = 'alert alert-success';
                        info_bar.innerHTML = '註冊成功';
                        swal({
                            title: "您已經成功註冊",
                            text: "恭喜您成為我們的會員",
                            icon: "success",
                            button: "確定!",
                        });
                    } else {
                        info_bar.className = 'alert alert-danger';
                        info_bar.innerHTML = obj.errorMsg;
                        
                    }


                });



        }
        return false;
    };
</script>
<?php include __DIR__ . '/__html_foot.php';  ?> 
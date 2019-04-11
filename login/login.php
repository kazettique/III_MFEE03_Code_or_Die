<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP|Noto+Sans+KR|Noto+Sans+TC" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../resources/css/utilities.css">
    <link rel="stylesheet" href="../resources/css/login-screen.css">
</head>
  <body>
      
    <div class="wrap d-flex justify-content-between">
        <div>
            <div class="title-wrap"><img src="../resources/images/maintitle1.svg" alt=""></div>

            <div class="wheel-img-wrap"><img src="../resources/images/wheel-img-svg.svg" alt=""></div>

            <div class="the-wheel-wrap d-flex flex-column justify-content-between align-items-start">
                <div class="the-wrap"><img src="../resources/images/the wheel-the.svg" class="img-fluid" alt=""></div>
                <p>管理者後台</p>
                <div class="wheel-wrap"><img src="../resources/images/the wheel-wheel.svg" alt=""></div>
            </div>

            <div class="bgc-red tag-decor"></div>
        </div>
        <div class="subwrap d-flex align-items-center">
            <form action="" class="login-info d-flex flex-column">
                <div class="position-relative">
                    <input id="username" class="form-control bgc-gray pl-5" type="text" placeholder="帳號" name="username">
                    <i class="material-icons position-absolute position-top-half l-0">account_circle</i>
                </div>
            <div class="position-relative">
                <input id="password" class="form-control bgc-gray pl-5" type="password" placeholder="密碼" name="password">
                <i class="material-icons position-absolute position-top-half l-0">lock</i>
            </div>
            <button id="submit" type="submit" class="btn bgc-red color-white align-self-end px-sm-4">登入</button>
            </form>
        </div>
        <div id="hint">
        <div class="subwrap d-flex align-items-center">
            <div class="side-text-wrap">
                <img src="../resources/images/side-text-the-wheel.svg" alt="" class="img-fluid">
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
    <script>
        $("#submit").click(function(event) {
            event.preventDefault();
            let name = $("#username").val();
            let pw = $("#password").val();
            console.log(name.length, pw.length);
            if (name.length == 0 || pw.length == 0) {
                $("#hint").text("請輸入帳號密碼!");
            } else {
                fetch("__login_api.php", {
                    method: "post",
                    headers: new Headers({
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'Accept':'application/x-www-form-urlencoded'
                    }),
                    body: `username=${name}&password=${pw}`
                }).then(res => res.json()).then(json => {
                    console.log(json)
                    if (json["success"]) {
                        Swal.fire({
                            type: "success",
                            title: "登入成功!",
                            text: "請點選左方三角形開始使用",
                            showConfirmButton: false
                        })
                        
                        setTimeout(()=> {window.location = "../sidebar/__nav.php"}, 1000);
                        
                    } else {
                        $("#hint").text("帳號或密碼錯誤!");
                       
                    }
                });
            }
        })
    </script>

  </body>
</html>
<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    #forlogin{
        width:500px;
        padding: 20px 40px;
        margin: 100px auto;
        text-align: center;
        border:1px solid #2addc7;
        box-shadow: 0 2px 3px #ccc;
        box-sizing: border-box;
        border-radius: 10px;
        background-color: rgba(0,0,0, 0.7);
    }
    input{
        color: white;
    }
    h6 {
        background-color: #2addc7;
        height: 40px;
        border-radius: 10px;
        color:white;
        font-weight: bold;
        display:flex;
        justify-content:center;
        align-items: center;
    }
    #hint {
        color: #e14040;
        padding:10px;
        font-weight: bold;
        height: 40px;
      
    }
    body{
        background: url(./back.jpg);
        background-size: 100vw auto;
        
    }
  
</style>
<body>
    <div id="forlogin">
        <h6>管理員登入</h6>
        <form id="form1" action="" method="">
            <div class="input-field" display="block">
            <input  type="text" name="username" placeholder="帳號" required id="username">
            <input type="password" name="password" placeholder="密碼" required id="password">
            </div>
            <input class="waves-effect waves-light btn" type="submit" value="Submit" id="submit">
        </form>
        
        <div id="hint">

        </div>
    </div> 
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.js" integrity="sha256-fNXJFIlca05BIO2Y5zh1xrShK3ME+/lYZ0j+ChxX2DA=" crossorigin="anonymous"></script>
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
                        'Content-Type': 'application/x-www-form-urlencoded'
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
                        
                        setTimeout(()=> {window.location = "/sidebar/__nav.php"}, 1000);
                        
                    } else {
                        $("#hint").text("帳號或密碼錯誤!");
                       
                    }
                });
            }
        })
    </script>

</body>

</html>
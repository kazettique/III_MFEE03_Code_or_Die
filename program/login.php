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

<body>
    <form id="form1" action="" method="">
        <input type="text" name="username" placeholder="Enter your username" required id="username">
        <input type="password" name="password" placeholder="Enter your password" required id="password">
        <input type="submit" value="Submit" id="submit">
    </form>
    <div id="hint">

    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.js" integrity="sha256-fNXJFIlca05BIO2Y5zh1xrShK3ME+/lYZ0j+ChxX2DA=" crossorigin="anonymous"></script>
    <script>
        $("#submit").click(function(event) {
            event.preventDefault();
            let adminName = $("#username").val();
            let pw = $("#password").val();
            console.log(adminName.length, pw.length);
            if (adminName.length == 0 || pw.length == 0) {
                $("#hint").text("請輸入帳號密碼!");
            } else {
                fetch("__login_api.php", {
                    method: "post",
                    headers: new Headers({
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }),
                    body: `username=${adminName}&password=${pw}`
                }).then(res => res.json()).then(json => {
                    console.log(json)
                    if (json["success"]) {
                        window.location = "http://localhost/_navbar.php";
                    } else {
                        $("#hint").text("帳號或密碼錯誤!");
                    }
                });
            }
        })
    </script>

</body>

</html>
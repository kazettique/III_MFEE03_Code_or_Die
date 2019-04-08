<?php

session_start();

if (isset($_SESSION['user_id'])) {
    echo $_SESSION['user_id'];
} else {
    header("Location: http://localhost/login/login.php");
}
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
    <h1>LOGIN!</h1>
</body>
</html>
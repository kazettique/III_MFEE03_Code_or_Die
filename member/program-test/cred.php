<?php

session_start();
require __DIR__ . "./__connect_db.php";
if (isset($_SESSION['username'])) {
  $adminName = $_SESSION['username'];
  $sql = sprintf("SELECT * FROM `admin` WHERE `name` = '$adminName'");
  $stmt = $pdo->query($sql);
} else {

  header("Location: http://localhost/login/login.php");
}

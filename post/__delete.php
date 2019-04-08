<?php
    require __DIR__."./__connect_db.php";
    
    $sid = isset($_GET["sid"])? intval($_GET["sid"]) : 0;
    echo $sid;
    $pdo->query("DELETE FROM `test` WHERE `sid`=$sid");

    $goto = "list.php";

    #if (isset($_SERVER["HTTP_REFERER"])) {
        #$goto = $_SERVER["HTTP_REFERER"];
    #}

    header("location: $goto");

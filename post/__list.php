<?php
    require __DIR__."./__connect_db.php";
   

    $result = [];


    $sql = "SELECT * FROM `test`";
    $stmt = $pdo->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
   

    echo json_encode($result, JSON_UNESCAPED_UNICODE);

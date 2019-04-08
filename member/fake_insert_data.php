<?php
require __DIR__. '/__connect_db.php';

$begin = microtime(true);
echo $begin. '<br>';

    $sql = "INSERT INTO `member`(
             `m_name`, `m_mobile`, `m_email`, `m_photo`,`m_address`,`m_birthday`,`m_active`,`m_password`
            ) VALUES (
               ?, ?, ?, ?, ?, ?, ?, ?
            )";

    $stmt = $pdo->prepare($sql);

    // 開始 Transaction
    $pdo->beginTransaction();

    for($i=1; $i<50; $i++) {
        $stmt->execute([
            "單車愛好者$i",
            "0901$i",
            "TheWheel{$i}@gobike.com",
            "http://lorempixel.com/800/800/sports/3/",
            "台北市大安區{$i}號",
            "1990-02-21",
            "1",
            "01{$i}"
        ]);
    }

    // 提交 Transaction
    $pdo->commit();

$end = microtime(true);
echo $end. '<br>';
echo $end-$begin. '<br>';
<?php
exit;
require __DIR__ . '/__connect.php';


$sql='INSERT INTO 
    `route`(`r_name`, `m_sid`, `r_intro`, `r_time`, `r_tag`, `r_country`, `r_area`, `r_start`, `r_end`) 
    VALUES 
    (?,?,?,?,?,?,?,?,?)';


$stmt=$pdo->prepare($sql);


$pdo->beginTransaction();

    for($i=0;$i<=200;$i++){
        $stmt->execute([
            "臺北市到淡水$i",
            "$i",
            "這一條開心的路線$i",
            "{$i}h",
            "Day-trip",
            "Taiwan",
            "台北",
            "台北車站",
            "淡水老街"
        ]);
    };

$pdo->commit();


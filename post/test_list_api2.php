<?php
require __DIR__ . "./__connect_db.php";


$result = [
    "success" => false,
    
    
    "data" => null,
   
];





$d_sql = sprintf("SELECT `type`, `views` FROM `test`");

$stmt = $pdo->query($d_sql);
$result["data"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
$result["success"] = true;

#print_r($result["data"]);
$type = [
    "totalnews" => 0,
    "test" => 0,
    "testviews" => 0,
    "test1" => 0,
    "test1views" => 0,
    "totalviews" => 0
];

$data = [
    "車友新聞" => [
        "count" => 0,
        "views" => 0
    ],
    "國際賽事" => [
        "count" => 0,
        "views" => 0
    ],
    "新車上市" => [
        "count" => 0,
        "views" => 0
    ],
    "相關裝備" => [
        "count" => 0,
        "views" => 0
    ],
    "totalviews" => 0,
    "top10" => []
];


foreach ($result["data"] as $value) {
    $data["totalviews"] += intval($value["views"]);
    switch ($value) {
        case $value["type"] == "車友新聞":
         $data["車友新聞"]["views"] += intval($value["views"]);
         break;
        case $value["type"] == "國際賽事":
         $data["國際賽事"]["views"] += intval($value["views"]);
         break;
        case $value["type"] == "新車上市":
         $data["新車上市"]["views"] += intval($value["views"]);
         break;
        case $value["type"] == "相關裝備":
         $data["相關裝備"]["views"] += intval($value["views"]);
         break;
       
    }
    foreach ($value as $k => $v) {
        $type["totalnews"] +=1;
        #echo $v;
        switch ($v) {
            case "車友新聞":
            $data["車友新聞"]["count"] += 1;
            break;
            case "國際賽事":
            $data["國際賽事"]["count"]+= 1;
            break;
            case "新車上市":
            $data["新車上市"]["count"]+= 1;
            break;
            case "相關裝備":
            $data["相關裝備"]["count"]+= 1;
            break;
        }
    }
}

$t_sql = sprintf("SELECT `type`,`title`, `views` FROM `test` ORDER BY `views` DESC LIMIT %s, %s", 0, 9);

$stmt = $pdo->query($t_sql);
$data["top10"] = $stmt->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($data, JSON_UNESCAPED_UNICODE);

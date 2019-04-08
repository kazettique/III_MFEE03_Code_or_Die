<?php
    require __DIR__."./__connect_db.php";
    
    $perPage = 5;
    $type = $_POST["type"];
    
    $result = [
        "success" => false,
        "page" => 0,
        "perPage" => $perPage,
        "totalRows" => 0,
        "totalPages" => 0,
        "data" => [],
    ];

    $page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;

    $t_stmt = $pdo->query("SELECT COUNT(*) FROM `test` WHERE `type`= '$type'");
    $t_rows = $t_stmt->fetch(PDO:: FETCH_NUM);
    $result["totalRows"] = $t_rows[0];

    $t_pages = ceil($t_rows[0] / $perPage);
    $result["totalPages"] = $t_pages;
    if ($page < 1) {
        $page = 1;
    }
    if ($page > $t_pages) {
        $page = $t_pages;
    }

    $sql = "SELECT * FROM `test` WHERE `type` = '$type'  LIMIT $perPage";
    $stmt = $pdo->query($sql);
    $result["data"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $result["success"] = true;
    $result["page"] = $page;

    echo json_encode($result, JSON_UNESCAPED_UNICODE);

<?php
require __DIR__ . "./p__connect.php";
$per_page = isset($_GET['perPage']) ? intval($_GET['perPage']) : 5;

if (isset($_POST["genre2"])) {
    $genre2 = $_POST["genre2"];
}

if (isset($_POST["search"])) {
    $sear = $_POST["search"];
    $search = "%" . $_POST["search"] . "%";
}

$result = [
    "success" => false,
    "page" => 0,
    "perPage" => $per_page,
    "totalRows" => 0,
    "totalPages" => 0,
    "data" => [],
    "type" => "",
    "search" => ""
];


$page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
$result["page"] = $page;


 if ($_POST["genre2"] !== "none" && $_POST["search"] === "") {
     $t_sql = "SELECT COUNT(*) FROM `prouduct` WHERE `p_genre2`='$genre2'";
 }
if ($_POST["genre2"] === "none" && $_POST["search"] !== "") {
    $t_sql = "SELECT COUNT(*) FROM `prouduct` WHERE `p_name` LIKE '$search' ";
}
    if ($_POST["genre2"] !== "none" && $_POST["search"] !== "") {
     $t_sql = "SELECT COUNT(*) FROM `prouduct` WHERE `p_genre2`='$genre2' AND `p_name` LIKE '$search'";
 }
if ($_POST["genre2"] === "none" && $_POST["search"] === "") {
    $t_sql = "SELECT COUNT(*) FROM `prouduct`";
}
$t_stmt = $pdo->query($t_sql);
$t_rows = $t_stmt->fetch(PDO::FETCH_NUM);
$result["totalRows"] = $t_rows[0];
if ($t_rows[0] == 0) {
    $result = [
        "success" => false,
        "page" => 0,
        "perPage" => $per_page,
        "totalRows" => 0,
        "totalPages" => 0,
        "data" => [],
    ];
    echo json_encode($result);
    exit;
}
$t_pages = ceil($t_rows[0] / $per_page);

$result["totalPages"] = $t_pages;
if ($page > $t_pages) {
    $page = $t_pages;
}
if ($page < 1) {
    $page = 1;
}



if ($_POST["genre2"] !== "none" && $_POST["search"] === "") {
    $sql = sprintf("SELECT * FROM `prouduct` WHERE `p_genre2`='$genre2' LIMIT %s, %s", ($page - 1) * $per_page, $per_page);
}
if ($_POST["genre2"] === "none" && $_POST["search"] !== "") {
    $sql = sprintf("SELECT * FROM `prouduct` WHERE `p_genre2` LIKE '%s' LIMIT %s, %s", $search, ($page - 1) * $per_page, $per_page);
}
if ($_POST["genre2"] !== "none" && $_POST["search"] !== "") {
    $sql = sprintf("SELECT * FROM `prouduct` WHERE `p_genre2`='$genre2' AND `p_name` LIKE '%s' LIMIT %s, %s", $search, ($page - 1) * $per_page, $per_page);
}
if ($_POST["genre2"] === "none" && $_POST["search"] === "") {
    $sql = sprintf("SELECT * FROM `prouduct` LIMIT %s, %s", ($page - 1) * $per_page, $per_page);
}

$stmt = $pdo->query($sql);
$result["data"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
$result["success"] = true;
$result["genre2"] = $genre2;
$result["search"] = $search;


echo json_encode($result);

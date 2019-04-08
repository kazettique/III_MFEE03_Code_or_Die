<?php
require __DIR__ . "./__connect_db.php";
$per_page = 5;

if (isset($_POST["type"])) {
    $type = $_POST["type"];
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


if ($_POST["type"] !== "none" && $_POST["search"] === "") {
    $t_sql = "SELECT COUNT(*) FROM `test` WHERE `type`='$type' ORDER BY `sid` DESC";
}
if ($_POST["type"] === "none" && $_POST["search"] !== "") {
    $t_sql = "SELECT COUNT(*) FROM `test` WHERE `title` LIKE '$search' ORDER BY `sid` DESC ";
}
if ($_POST["type"] !== "none" && $_POST["search"] !== "") {
    $t_sql = "SELECT COUNT(*) FROM `test` WHERE `type`='$type' AND `title` LIKE '$search' ORDER BY `sid` DESC";
}
if ($_POST["type"] === "none" && $_POST["search"] === "") {
    $t_sql = "SELECT COUNT(*) FROM `test` ORDER BY `sid` DESC ";
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



if ($_POST["type"] !== "none" && $_POST["search"] === "") {
    $sql = sprintf("SELECT * FROM `test` WHERE `type`='$type' ORDER BY `sid` DESC LIMIT %s, %s", ($page - 1) * $per_page, $per_page);
}
if ($_POST["type"] === "none" && $_POST["search"] !== "") {
    $sql = sprintf("SELECT * FROM `test` WHERE `title` LIKE '%s' ORDER BY `sid` DESC LIMIT %s, %s", $search, ($page - 1) * $per_page, $per_page);
}
if ($_POST["type"] !== "none" && $_POST["search"] !== "") {
    $sql = sprintf("SELECT * FROM `test` WHERE `type`='$type' AND `title` LIKE '%s' ORDER BY `sid` DESC LIMIT %s, %s", $search, ($page - 1) * $per_page, $per_page);
}
if ($_POST["type"] === "none" && $_POST["search"] === "") {
    $sql = sprintf("SELECT * FROM `test` ORDER BY `sid` DESC LIMIT %s, %s", ($page - 1) * $per_page, $per_page);
}

$stmt = $pdo->query($sql);
$result["data"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
$result["success"] = true;
$result["type"] = $type;
$result["search"] = $search;


echo json_encode($result);

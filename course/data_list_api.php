<?php
// 摘要：顯示資料表的API

// Import the database
require __DIR__ . '/__connect_db.php';

// 每頁有幾筆資料
$per_page = 30;

// 設定初始值
$result = [
    'success' => 0,   // echo values
    'page' => 0,   // echo values
    'totalRow' => 0,   // echo values
    'perPage' => $per_page,
    'totalPages' => 0,
    'data' => [],   // echo values
    'errorCode' => 0,
    'errorMsg' => '',
];

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// 計算總筆數
$t_sql = "SELECT COUNT(1) FROM course";
$t_stmt = $pdo->query($t_sql);
$total_rows = $t_stmt->fetch(PDO::FETCH_NUM)[0];
$result['totalRow'] = intval($total_rows);

// 計算總頁數
$total_pages = ceil($total_rows / $per_page);
$result['totalPages'] = $total_pages;


if ($page < 1) $page = 1;
if ($page > $total_pages) $page = $total_pages;
$result['page'] = $page;

$sql = sprintf("SELECT * FROM course ORDER BY c_sid DESC LIMIT %s, %s", ($page - 1) * $per_page, $per_page);
$stmt = $pdo->query($sql);

// 所有資料一次拿出來
$result['data'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
$result['success'] = true;

echo json_encode($result, JSON_UNESCAPED_UNICODE);

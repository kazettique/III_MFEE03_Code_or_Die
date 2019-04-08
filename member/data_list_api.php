<?php
require __DIR__ . '/__connect_db.php';

$per_page = isset($_GET['perPage']) ? intval($_GET['perPage']) : 5;

$keyword = isset($_GET['keyword']) ? ($_GET['keyword']) : "";

$result = [
    'success' => false,
    'page' => 0,
    'totalRows' => 0,
    'perPage' => $per_page,
    'totalPages' => 0,
    'data' => [],
    'errorCode' => 0,
    'errorMsg' => '',
    'keyword' => $keyword,
];

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;



// 算總筆數
$t_sql = "SELECT COUNT(1) FROM member";
$t_stmt = $pdo->query($t_sql);
$total_rows = $t_stmt->fetch(PDO::FETCH_NUM)[0];
$result['totalRows'] = intval($total_rows);

if (isset($_GET['keyword'])) {
    $t_sql = "SELECT * FROM `member` WHERE m_sid LIKE ? OR m_mobile LIKE ? OR m_name LIKE ? OR m_email LIKE ? OR m_address LIKE ? OR m_birthday LIKE ? OR m_active LIKE ? OR m_city LIKE ? OR m_town LIKE ?";
    $t_stmt = $pdo->prepare($t_sql);
    $str = "%" . $_GET['keyword'] . "%";
    $t_stmt->execute([
        $str,
        $str,
        $str,
        $str,
        $str,
        $str,
        $str,
        $str,
        $str,
    ]);

    $total_rows = $t_stmt->rowCount();
    $result['totalRows'] = $total_rows;


    if ($total_rows == 0) {
        $result = [
            'success' => false,
            'page' => 0,
            'totalRows' => 0,
            'perPage' => $per_page,
            'totalPages' => 0,
            'data' => [],
            'errorCode' => 0,
            'errorMsg' => '',
        ];
        echo json_encode($result);
        exit;
    }

    $result['data'] = $t_stmt->fetchAll(PDO::FETCH_ASSOC);
}



// 總頁數
$total_pages = ceil($total_rows / $per_page);
$result['totalPages'] = $total_pages;

if ($page < 1) $page = 1;
if ($page > $total_pages) $page = $total_pages;
$result['page'] = $page;




$sql = sprintf("SELECT * FROM member ORDER BY m_sid DESC LIMIT %s, %s", ($page - 1) * $per_page, $per_page);
$stmt = $pdo->query($sql);

// 所有資料一次拿出來



if (isset($_GET['keyword'])) {
    $sql = sprintf("SELECT * FROM `member` WHERE m_sid LIKE ? OR m_mobile LIKE ? OR m_name LIKE ? OR m_email LIKE ? OR m_address LIKE ? OR m_birthday LIKE ? OR m_active LIKE ? OR m_city LIKE ? OR m_town LIKE ? ORDER BY m_sid DESC LIMIT %s, %s", ($page - 1) * $per_page, $per_page);
    $stmt = $pdo->prepare($sql);
    $str = "%" . $_GET['keyword'] . "%";
    $stmt->execute([
        $str,
        $str,
        $str,
        $str,
        $str,
        $str,
        $str,
        $str,
        $str,
    ]);
}

$result['data'] = $stmt->fetchAll(PDO::FETCH_ASSOC);



$result['success'] = true;

// 將陣列轉換成 json 字串
echo json_encode($result, JSON_UNESCAPED_UNICODE);

//JSON_UNESCAPED_UNICODE不要跳脫字元

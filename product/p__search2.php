<?php
require __DIR__ . '/p__connect.php';
$per_page = isset($_GET['perPage']) ? intval($_GET['perPage']) : 5;
$keyword = isset($_GET['keyword']) ? ($_GET['keyword']) : "";
$sel_genre = isset($_GET['sel_genre2']) ? ($_GET['sel_genre2']) : "";

$result = [
    'success' => false,
    'page' => 0,
    'totalRows' => 0,
    'perPage' => $per_page,
    'totalPages' => 0,
    'data' => [],
    'errorCode' => 200,
    'errorMsg' => '',
    'keyword' => $keyword,
     'sel_genre2' => $sel_genre,
    
];
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
// 算總筆數
$t_sql = "SELECT COUNT(*) FROM prouduct";
$t_stmt = $pdo->query($t_sql);
$total_rows = $t_stmt->fetch(PDO::FETCH_NUM)[0];
$result['totalRows'] = intval($total_rows);









if (isset($_GET['sel_genre2'])) {
    $t_sql = "SELECT * FROM `prouduct` WHERE p_genre2 LIKE ?";
    $t_stmt = $pdo->prepare($t_sql);
    $str_c = "%" . $_GET['sel_genre2'] . "%";
    $t_stmt->execute([
        $str_c,
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
            'errorCode' => 201,
            'errorMsg' => '',
            'keyword' => $keyword,
            'sel_genre2' => $sel_genre,
        ];
        echo json_encode($result);
        exit;
    }
}
if (!empty($_GET['keyword'])) {
    $t_sql =  "SELECT * FROM prouduct WHERE p_sid LIKE ? OR p_name LIKE ? OR p_description LIKE ? OR p_price LIKE ? OR p_genre LIKE ? OR p_genre2 LIKE ? OR p_brand LIKE ? OR p_color LIKE ? OR p_size LIKE ?";
    $t_stmt = $pdo->prepare($t_sql);
    $str = "%".$_GET['keyword'] ."%";
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
            'errorCode' => 202,
            'errorMsg' => '',
            'keyword' => $keyword,
            'sel_genre2' => $sel_genre,
        ];
        echo json_encode($result);
        exit;
    }
}
if (!empty($_GET['keyword']) && !empty($_GET['sel_genre2'])) {
    $t_sql = "SELECT * FROM `prouduct` WHERE p_genre2 LIKE ? AND (p_sid LIKE ? OR p_name LIKE ? OR p_description LIKE ? OR p_genre LIKE ? OR p_price LIKE ? OR p_brand LIKE ? OR p_color LIKE ? OR p_size LIKE ?)";
    $t_stmt = $pdo->prepare($t_sql);
    $str_c = "%".$_GET['sel_genre2']."%";
    $str = "%".$_GET['keyword']."%";
    $t_stmt->execute([
        $str_c,
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
            'errorCode' => 203,
            'errorMsg' => '',
        ];
        echo json_encode($result);
        exit;
    }
}

$total_pages = ceil($total_rows / $per_page);
$result['totalPages'] = $total_pages;
if ($page < 1) $page = 1;
if ($page > $total_pages) $page = $total_pages;
$result['page'] = $page;
$sql = sprintf("SELECT * FROM prouduct  LIMIT %s, %s",($page - 1) * $per_page, $per_page);
$stmt = $pdo->query($sql);
// 所有資料一次拿出來
if (!empty($_GET['sel_genre2'])) {
    // $sql = sprintf("SELECT * FROM `prouduct` WHERE p_genre2 LIKE ? LIMIT %s, %s",$per_page, $per_page);
     $sql = sprintf("SELECT * FROM `prouduct` WHERE `p_genre2`='$sel_genre' LIMIT %s, %s", ($page - 1) * $per_page, $per_page);
    $stmt = $pdo->prepare($sql);
    $str_c = "%" . $_GET['sel_genre2'] . "%";
    $stmt->execute([
        $str_c,
    ]);
};
// if (!empty($_GET['keyword'])) {
//     //$sql = sprintf("SELECT * FROM `prouduct` WHERE `p_name` LIKE $keyword LIMIT %s, %s", $keyword, ($page - 1) * $per_page, $per_page);
//      $sql = sprintf("SELECT * FROM `prouduct` WHERE p_sid LIKE ? OR p_name LIKE ? OR p_description LIKE ? OR p_price LIKE ? OR p_genre LIKE ?  OR p_brand LIKE ? OR p_color LIKE ? OR p_size LIKE ? LIMIT %s, %s");
//     $stmt = $pdo->prepare($sql);
//     $str = "%" . $_GET['keyword'] . "%";
//     $stmt->execute([
//         $str,
//         $str,
//         $str,
//         $str,
//         $str,
//         $str,
//         $str,
//         $str,
//         $str,
//     ]);
// } ;
// if (!empty($_GET['keyword']) && !empty($_GET['sel_genre2'])) {
//     $sql = sprintf("SELECT * FROM `prouduct` WHERE p_genre2 LIKE ? AND (p_sid LIKE ? OR p_name LIKE ? OR p_description LIKE ? OR p_price LIKE ? OR p_genre LIKE ? OR p_brand LIKE ? OR p_color LIKE ? OR p_size LIKE ?)LIMIT %s, %s");
//     $stmt = $pdo->prepare($sql);
//     $str_c = "%" . $_GET['sel_genre2'] . "%";
//     $str = "%" . $_GET['keyword'] . "%";
//     $stmt->execute([
//         $str_c,
//         $str,
//         $str,
//         $str,
//         $str,
//         $str,
//         $str,
//         $str,
//         $str,
//     ]);
//     }
$result['data'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
$result['success'] = true;
// 將陣列轉換成 json 字串
echo json_encode($result, JSON_UNESCAPED_UNICODE);
//JSON_UNESCAPED_UNICODE不要跳脫字元
<?php
    require __DIR__.'./p__connect.php';
    //$page_name = 'data_list';

    
    $per_page = isset($_GET['perPage']) ? intval($_GET['perPage']) : 5;
    $result =[
        'succes'=>false,
        'page'=>0,
        'totalRow'=>0,
        'perPage'=>$per_page,
        'totalPages'=>0,
        'data'=>[],
        'errorCode'=>0,
        'errorMsg'=>'',
        
    ];


    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

    // 算總筆數
    $t_sql = "SELECT COUNT(1) FROM prouduct";
    $t_stmt = $pdo->query($t_sql);
    $total_rows = $t_stmt->fetch(PDO::FETCH_NUM)[0];
    $result['totalRow'] = $total_rows;
    
    // 總頁數
    $total_pages = ceil($total_rows/$per_page);
    $result['totalPages'] = $total_pages;

    if($page < 1) $page = 1;
    if($page > $total_pages) $page = $total_pages;
    $result['page'] = $page;
    


    $sql = sprintf("SELECT * FROM prouduct  LIMIT %s, %s", ($page-1)*$per_page, $per_page);
    $stmt = $pdo->query($sql);

    // 所有資料一次拿出來
    $result['data'] =$stmt->fetchAll(PDO::FETCH_ASSOC);
    $result['success'] =true;
    //將陣列轉換成json字串
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
    

?>

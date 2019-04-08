<?php

require __DIR__ .'/__connect.php';
$per_page=isset($_GET['perPage'])? intval($_GET['perPage']):10;
$orderBy='DESC';
if(isset($_GET['orderBy'])){
    if(boolval($_GET['orderBy'])){
        $orderBy='ASC';
    }
}

$result=[
    'totalRoutes'=> 0,
    'perPage' => $per_page,
    'totalPages' => 0,
    'page'=>0,
    'orderBy'=>$orderBy,
    'data'=> [],
];

$t_sql='SELECT COUNT(1) FROM `route`';
$t_stmt=$pdo->query($t_sql);
$total_routes=$t_stmt->fetch(PDO::FETCH_NUM)[0];
$result['totalRoutes']=$total_routes;

$total_pages=ceil($total_routes/$per_page);
$result['totalPages']=$total_pages;

$page = isset($_GET['page'])? intval($_GET['page']) : 1;
if ($page<=1){$page=1;}
if ($page>$total_pages){ $page=$total_pages;}
$result['page']=$page;


$sql_lim=($page-1)*$per_page;
$all_sql= "SELECT *
            FROM `route` 
            ORDER BY `route`.`r_sid` {$orderBy}
            LIMIT {$sql_lim} , {$per_page}";
$all_stmt=$pdo->query($all_sql);
$result['data'] = $all_stmt->fetchAll(PDO::FETCH_ASSOC);




echo json_encode($result, JSON_UNESCAPED_UNICODE);
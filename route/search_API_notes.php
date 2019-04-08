<?php
require __DIR__.'/__connect.php';
header('Content-Type: application/json');
// var_dump($_POST);
$per_page=10;
$result=[
    'success'=> false,
    'errMsg'=>'路線不存在請重新輸入',
    'errCode'=>0,
    'data'=>[],
    'totalRoutes'=> 0,
    'perPage' => $per_page,
    'totalPages' => 0,
    'page'=>0,
];

SELECT `route`.`r_sid`,`route`.`r_intro`, `route_location`.`l_sid`,`route_location`.`l_intro`,`route`.`r_tag`  FROM `route` LEFT JOIN `route_location` 
        ON `route`.`r_sid`=`route_location`.`r_sid` WHERE
        `r_tag`='短途' AND (`r_intro` LIKE '%a%' OR `l_intro`LIKE '%$a%') GROUP BY `r_sid`

SELECT `route`.`r_sid` FROM `route` LEFT JOIN `route_location` 
        ON `route`.`r_sid`=`route_location`.`r_sid` WHERE (`r_tag`='短途' OR `r_tag`='環島' OR `r_tag`='跨國' )  AND (
             `r_intro` LIKE '%a%'  
            OR `r_name` LIKE '%a%' 
            OR `r_country` LIKE '%a%' 
            OR `r_area` LIKE '%a%' 
            OR `r_depart` LIKE '%a%' 
            OR `r_arrive` LIKE '%$a%'
            OR `l_name` LIKE '%a%' 
            OR `l_intro` LIKE '%a%' 
            OR `l_via` LIKE '%a%' 
            OR `l_country` LIKE '%a%' 
            OR `l_area` LIKE '%a%') GROUP BY `r_sid`

SELECT  `route`.*,`route_location`.`l_name`
        FROM `route` LEFT JOIN  `route_location` ON 
        `route`.`r_sid`=`route_location`.`r_sid`
        WHERE `route`.`r_name`LIKE '%yyy%' OR
        `l_name` LIKE '%yyy%' OR
        `r_name` LIKE '%yyy%' OR
        `r_time` LIKE '%yyy%' OR
        `r_tag` LIKE '%yyy%' OR
        `r_country` LIKE '%yyy%' OR
        `r_area` LIKE '%yyy%' OR
        `r_depart` LIKE '%yyy%' OR
        `r_arrive` LIKE '%yyy%' OR
         `l_name` LIKE '%yyy%' OR
         `l_intro` LIKE '%yyy%' OR
         `l_via` LIKE '%yyy%' OR
         `l_country` LIKE '%yyy%' OR
         `l_area` LIKE '%1%'


SELECT `r_sid` FROM `route_location` WHERE 
`l_name` LIKE '%yyy%' 
OR `l_intro` LIKE '%yyy%' 
OR `l_via` LIKE '%yyy%' 
OR `l_country` LIKE '%yyy%' 
OR `l_area` LIKE '%yyy%' 
UNION DISTINCT 
SELECT `r_sid` FROM `route`WHERE 
`r_intro`LIKE '%yyy%' 
OR `r_name` LIKE '%yyy%' 
OR `r_time` LIKE '%yyy%' 
OR `r_tag` LIKE '%yyy%' 
OR `r_country` LIKE '%yyy%' 
OR `r_area` LIKE '%yyy%' 
OR `r_depart` LIKE '%yyy%' 
OR `r_arrive` LIKE '%yyy%'

ORDER BY `r_sid` ASC

// --------------------------------------------search multiple keywords start -----------------------------
// $searchtxt=$pdo->quote($_GET['search']);

$searchtxt= 'aaa bbb ccc ddd eee fff ggg';


$keys = explode(" ",$searchtxt);



$sql = "SELECT  `route`.*,`route_location`.`l_name`
        FROM `route` LEFT JOIN  `route_location` ON 
        `route`.`r_sid`=`route_location`.`r_sid`
        WHERE 
        `r_intro`LIKE '%$searchtxt%' OR
        `r_name` LIKE '%$searchtxt%' OR
        `r_time` LIKE '%$searchtxt%' OR
        `r_tag` LIKE '%$searchtxt%' OR
        `r_country` LIKE '%$searchtxt%' OR
        `r_area` LIKE '%$searchtxt%' OR
        `r_depart` LIKE '%$searchtxt%' OR
        `r_arrive` LIKE '%$searchtxt%' OR
        `l_name` LIKE '%$searchtxt%' OR
        `l_intro` LIKE '%$searchtxt%' OR
        `l_via` LIKE '%$searchtxt%' OR
        `l_country` LIKE '%$searchtxt%' OR
        `l_area` LIKE '%$searchtxt%'
         ";

foreach($keys as $k){
        $sql .= "OR `r_intro`LIKE '%$k%' 
        OR `r_name` LIKE '%$k%' 
        OR `r_time` LIKE '%$k%' 
        OR `r_tag` LIKE '%$k%'
        OR `r_country` LIKE '%$k%'
        OR `r_area` LIKE '%$k%'
        OR `r_depart` LIKE '%$k%'
        OR `r_arrive` LIKE '%$k%'
        OR  `l_name` LIKE '%$k%'
        OR  `l_intro` LIKE '%$k%'
        OR `l_via` LIKE '%$k%'
        OR `l_country` LIKE '%$k%'
        OR `l_area` LIKE '%$k%' ";
}

var_dump($sql);
// --------------------------------------------search multiple keywords end-----------------------------

// $searchtxt=$_GET['search'];
//  $sql = "SELECT * FROM `route` WHERE
//         `r_intro`LIKE '%$searchtxt%' OR        
//         `r_name` LIKE '%$searchtxt%' OR        
//         `r_time` LIKE '%$searchtxt%' OR
//         `r_tag` LIKE '%$searchtxt%' OR
//         `r_country` LIKE '%$searchtxt%' OR
//         `r_area` LIKE '%$searchtxt%' OR
//         `r_depart` LIKE '%$searchtxt%' OR
//         `r_arrive` LIKE '%$searchtxt%' ";
   
//    try{
//        $stmt=$pdo->prepare($sql);
//         $stmt->execute();

//         if($stmt->rowCount()!==0){

//                 $result['success']=true;
//                 $result['errCode']=200;
//                 $result['errMsg']='search success';
//                 $result['data']=$stmt->fetchAll(PDO::FETCH_ASSOC);



                // $result['totalRoutes']=$stmt->rowCount();
                
                // $total_pages=ceil( $result['totalRoutes']/$per_page);
                // $result['totalPages']=$total_pages;
                
                // $page = isset($_GET['page'])? intval($_GET['page']) : 1;
                // if ($page<=1){$page=1;}
                // if ($page>$total_pages){ $page=$total_pages;}
                // $result['page']=$page;
                
                
                // $sql_lim=($page-1)*$per_page;
                // $all_sql= "SELECT *
                // FROM `route` LIMIT {$sql_lim} , {$per_page}";
                // $all_stmt=$pdo->query($all_sql);
                // $result['data'] = $all_stmt->fetchAll(PDO::FETCH_ASSOC);



    //     }

    // }catch(PDOException $e){
    //     $result['errMsg']='search fail<br>'.$e;
    //     $result['errCode']=403;
    // }
    

// echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>
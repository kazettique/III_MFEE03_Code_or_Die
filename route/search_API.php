<?php
require __DIR__.'/__connect.php';
header('Content-Type: application/json');
// var_dump($_POST);
$per_page=isset($_GET['perPage'])? intval($_GET['perPage']):10;
$result=[
    'success'=> false,
    'errMsg'=>'路線不存在請重新輸入',
    'aaa'=>'',
    'errCode'=>0,
    'data'=>[],
    'totalRoutes'=> 0,
    'perPage' => $per_page,
    'totalPages' => 0,
    'page'=>0,
    'sql'=>''
];
// --------------------------------------------search sql prepare -----------------------------
$sql='';
$sql_l="SELECT `r_sid` FROM `route_location` WHERE ";
$sql_r="SELECT `r_sid` FROM `route`WHERE ";
$string=isset($_GET['search'])? "{$_GET['search']}":'';
$tag=isset($_GET['tag'])? "{$_GET['tag']}":'';
$country=isset($_GET['country'])? "{$_GET['country']}":'';
if ($country==' '){$country='';}
$area=isset($_GET['area'])? "{$_GET['area']}":'';




if($string!=='0' AND empty($string) AND empty($tag) AND empty($country)){
    $result['errMsg']='未輸入關鍵字';
    $result['errCode']=11111;
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}elseif(($string =='0' OR !empty($string)) AND empty($tag) AND empty($country)){
    $result['aaa']='1';
    searchtxt();
}elseif(($string !=='0' AND empty($string)) AND !empty($tag) AND empty($country)){
    $result['aaa']='2';
    searchtag();
}elseif(($string !=='0' AND empty($string)) AND empty($tag) AND !empty($country) AND empty($area)){
    $result['aaa']='3';
    searchcountry();
}elseif($string =='0' OR !empty($string) AND !empty($tag) AND empty($country)){
    $result['aaa']='4';
    search_txt_tag();
}elseif($string =='0' OR !empty($string) AND empty($tag) AND !empty($country) AND empty($area)){
    $result['aaa']='5';
    search_txt_country();

}elseif($string !=='0' AND empty($string) AND empty($tag) AND !empty($country) AND !empty($area)){
    $result['aaa']='6';
    search_country_area();

}elseif($string =='0' OR !empty($string) AND empty($tag) AND !empty($country) AND !empty($area)){
    $result['aaa']='7';
    search_txt_country_area();

}elseif($string !=='0' AND empty($string) AND !empty($tag) AND !empty($country) AND empty($area)){
    $result['aaa']='8';
    search_tag_country();

}elseif($string !=='0' AND empty($string) AND !empty($tag) AND !empty($country) AND !empty($area)){
    $result['aaa']='9';
    search_tag_country_area();

}elseif($string =='0' OR !empty($string) AND !empty($tag) AND !empty($country) AND empty($area)){
    $result['aaa']='10';
    search_txt_tag_country();

}elseif($string =='0' OR !empty($string) AND !empty($tag) AND !empty($country) AND !empty($area)){
    $result['aaa']='11';
    search_txt_tag_country_area();

}


function searchtxt(){
    global $string;
    global $sql_l;
    global $sql_r;
    global $sql;
    $searchtxt=$string;
    $keys = explode(" ",$searchtxt);

    $sql_l.="`l_name` LIKE '%$searchtxt%' 
            OR `l_intro` LIKE '%$searchtxt%' 
            OR `l_via` LIKE '%$searchtxt%' 
            OR `l_country` LIKE '%$searchtxt%' 
            OR `l_area` LIKE '%$searchtxt%'";

    foreach($keys as $k){
            $sql_l .= "
            OR `l_name` LIKE '%$k%'
            OR `l_intro` LIKE '%$k%'
            OR `l_via` LIKE '%$k%'
            OR `l_country` LIKE '%$k%'
            OR `l_area` LIKE '%$k%' ";
    }

    $sql_r.=" `r_intro` LIKE '%$searchtxt%'  
            OR `r_name` LIKE '%$searchtxt%' 
            OR `r_country` LIKE '%$searchtxt%' 
            OR `r_area` LIKE '%$searchtxt%' 
            OR `r_depart` LIKE '%$searchtxt%' 
            OR `r_arrive` LIKE '%$searchtxt%'";

    foreach($keys as $k){
            $sql_r .= "
            OR `r_intro`LIKE '%$k%' 
            OR `r_name` LIKE '%$k%' 
            OR `r_country` LIKE '%$k%'
            OR `r_area` LIKE '%$k%'
            OR `r_depart` LIKE '%$k%'
            OR `r_arrive` LIKE '%$k%'
    ";
    }

    $sql=$sql_l.'UNION DISTINCT '.$sql_r;
}

function searchtag(){
    global $tag,$sql_r,$sql;

    $str= "";
    
    $keys2 = explode(" ",$tag);
    
    foreach($keys2 as $k){
        $str.="`r_tag`='".$k."' OR ";
    }
    $str=substr($str,0,-3);
    
    $sql_r.= $str;

    $sql=$sql_r;
}

function searchcountry(){
    global $country;
    global $sql_r;
    global $sql;

    $sql="SELECT `route`.`r_sid` FROM `route` LEFT JOIN `route_location` 
    ON `route`.`r_sid`=`route_location`.`r_sid` WHERE (`route`.`r_country`= '".$country."' OR `route_location`.`l_country`= '". $country . "' ) GROUP BY `r_sid`;";
}

function search_country_area(){
    global $country,$sql,$area;

    $sql .= "SELECT `route`.`r_sid` FROM `route` LEFT JOIN `route_location` 
    ON `route`.`r_sid`=`route_location`.`r_sid` WHERE (`route`.`r_country`= '".$country."' OR `route_location`.`l_country`= '". $country . "' ) AND (`route`.`r_area`= '" .$area. "' OR `route_location`.`l_area` = '" .$area. "' ) GROUP BY `r_sid`;";
    
    $result['sql']=$sql;
}

function search_txt_tag(){
    global $tag;
    global $string;
    global $sql;

    $sql.="SELECT `route`.`r_sid` FROM `route` LEFT JOIN `route_location` 
        ON `route`.`r_sid`=`route_location`.`r_sid` WHERE ( ";

    $str= "";
    
    $keys2 = explode(" ",$tag);
    
    foreach($keys2 as $k){
        $str.="`r_tag`='".$k."' OR ";
    }
    $str=substr($str,0,-3);
    $str.=") AND ( "; 
    
    $searchtxt=$string;
    $keys = explode(" ",$searchtxt);
    $str.=" `r_intro` LIKE '%$searchtxt%'  
            OR `r_name` LIKE '%$searchtxt%' 
            OR `r_country` LIKE '%$searchtxt%' 
            OR `r_area` LIKE '%$searchtxt%' 
            OR `r_depart` LIKE '%$searchtxt%' 
            OR `r_arrive` LIKE '%$searchtxt%'";

    foreach($keys as $k){
            $str .= "
            OR `r_intro`LIKE '%$k%' 
            OR `r_name` LIKE '%$k%' 
            OR `r_country` LIKE '%$k%'
            OR `r_area` LIKE '%$k%'
            OR `r_depart` LIKE '%$k%'
            OR `r_arrive` LIKE '%$k%'
    ";
    }
    
    $str.="OR `l_name` LIKE '%$searchtxt%' 
            OR `l_intro` LIKE '%$searchtxt%' 
            OR `l_via` LIKE '%$searchtxt%' 
            OR `l_country` LIKE '%$searchtxt%' 
            OR `l_area` LIKE '%$searchtxt%'";

    foreach($keys as $k){
            $str .= "
            OR `l_name` LIKE '%$k%'
            OR `l_intro` LIKE '%$k%'
            OR `l_via` LIKE '%$k%'
            OR `l_country` LIKE '%$k%'
            OR `l_area` LIKE '%$k%' ";
    }

    $sql.= $str . ') GROUP BY `r_sid`;';
}

function search_txt_country(){
    global $country,$string,$sql;

    $sql.="SELECT `route`.`r_sid` FROM `route` LEFT JOIN `route_location` 
    ON `route`.`r_sid`=`route_location`.`r_sid` WHERE ( `r_country`= '{$country}' || `l_country`= '{$country}') AND (";

    $searchtxt=$string;
    $keys = explode(" ",$searchtxt);
    $str=" `r_intro` LIKE '%$searchtxt%'  
            OR `r_name` LIKE '%$searchtxt%' 
            OR `r_country` LIKE '%$searchtxt%' 
            OR `r_area` LIKE '%$searchtxt%' 
            OR `r_depart` LIKE '%$searchtxt%' 
            OR `r_arrive` LIKE '%$searchtxt%'";

    foreach($keys as $k){
            $str .= "
            OR `r_intro`LIKE '%$k%' 
            OR `r_name` LIKE '%$k%' 
            OR `r_country` LIKE '%$k%'
            OR `r_area` LIKE '%$k%'
            OR `r_depart` LIKE '%$k%'
            OR `r_arrive` LIKE '%$k%'
    ";
    }

    $str.="OR `l_name` LIKE '%$searchtxt%' 
            OR `l_intro` LIKE '%$searchtxt%' 
            OR `l_via` LIKE '%$searchtxt%' 
            OR `l_country` LIKE '%$searchtxt%' 
            OR `l_area` LIKE '%$searchtxt%'";

    foreach($keys as $k){
            $str .= "
            OR `l_name` LIKE '%$k%'
            OR `l_intro` LIKE '%$k%'
            OR `l_via` LIKE '%$k%'
            OR `l_country` LIKE '%$k%'
            OR `l_area` LIKE '%$k%' ";
    }

    $sql.= $str . ') GROUP BY `r_sid`;';
    
}


function search_txt_country_area(){
    global $country,$string,$sql,$area;

    $sql.="SELECT `route`.`r_sid` FROM `route` LEFT JOIN `route_location` 
    ON `route`.`r_sid`=`route_location`.`r_sid` WHERE ( `r_country`= '{$country}' OR `l_country`= '{$country}') AND (`r_area`= '{$area}' OR `l_area` = '{$area}') AND (";

    $searchtxt=$string;
    $keys = explode(" ",$searchtxt);
    $str =" `r_intro` LIKE '%$searchtxt%'  
            OR `r_name` LIKE '%$searchtxt%' 
            OR `r_country` LIKE '%$searchtxt%' 
            OR `r_area` LIKE '%$searchtxt%' 
            OR `r_depart` LIKE '%$searchtxt%' 
            OR `r_arrive` LIKE '%$searchtxt%'";

    foreach($keys as $k){
            $str .= "
            OR `r_intro`LIKE '%$k%' 
            OR `r_name` LIKE '%$k%' 
            OR `r_country` LIKE '%$k%'
            OR `r_area` LIKE '%$k%'
            OR `r_depart` LIKE '%$k%'
            OR `r_arrive` LIKE '%$k%'
    ";
    }

    $str.="OR `l_name` LIKE '%$searchtxt%' 
            OR `l_intro` LIKE '%$searchtxt%' 
            OR `l_via` LIKE '%$searchtxt%' 
            OR `l_country` LIKE '%$searchtxt%' 
            OR `l_area` LIKE '%$searchtxt%'";

    foreach($keys as $k){
            $str .= "
            OR `l_name` LIKE '%$k%'
            OR `l_intro` LIKE '%$k%'
            OR `l_via` LIKE '%$k%'
            OR `l_country` LIKE '%$k%'
            OR `l_area` LIKE '%$k%' ";
    }

    $sql.= $str . ') GROUP BY `r_sid`;';
    
}

function search_tag_country(){
    global $tag,$country,$sql;
    
    $sql.="SELECT `route`.`r_sid` FROM `route` LEFT JOIN `route_location` 
    ON `route`.`r_sid`=`route_location`.`r_sid` WHERE ( ";
    
    $str= "";
    
    $keys2 = explode(" ",$tag);
    
    foreach($keys2 as $k){
        $str.="`r_tag`='".$k."' OR ";
    }
    $str=substr($str,0,-3);

    $sql=$sql . $str .") AND ( `r_country`= '{$country}' OR `l_country`= '{$country}') GROUP BY `r_sid`;";
}

function search_tag_country_area(){
    global $sql,$tag,$country,$area;
    
    $sql ="SELECT `route`.`r_sid` FROM `route` LEFT JOIN `route_location` 
    ON `route`.`r_sid`=`route_location`.`r_sid` WHERE ( ";
    
    $str= "";
    
    $keys2 = explode(" ",$tag);
    
    foreach($keys2 as $k){
        $str.="`r_tag`='".$k."' OR ";
    }
    $str=substr($str,0,-3);

    $sql=$sql . $str .") AND ( `r_country`= '{$country}' OR `l_country`= '{$country}') AND (`r_area`= '{$area}' OR `l_area` = '{$area}') GROUP BY `r_sid`;";
}

function search_txt_tag_country(){
    global $sql,$tag,$country,$string;
    
    $sql ="SELECT `route`.`r_sid` FROM `route` LEFT JOIN `route_location` 
    ON `route`.`r_sid`=`route_location`.`r_sid` WHERE ( ";
    
    $str= "";
    
    $keys2 = explode(" ",$tag);
    
    foreach($keys2 as $k){
        $str.="`r_tag`='".$k."' OR ";
    }
    $str=substr($str,0,-3);

    $sql=$sql . $str .") AND ( `r_country`= '{$country}' OR `l_country`= '{$country}') AND ( ";

    $searchtxt=$string;
    $keys = explode(" ",$searchtxt);
    $str=" `r_intro` LIKE '%$searchtxt%'  
            OR `r_name` LIKE '%$searchtxt%' 
            OR `r_country` LIKE '%$searchtxt%' 
            OR `r_area` LIKE '%$searchtxt%' 
            OR `r_depart` LIKE '%$searchtxt%' 
            OR `r_arrive` LIKE '%$searchtxt%'";

    foreach($keys as $k){
            $str .= "
            OR `r_intro`LIKE '%$k%' 
            OR `r_name` LIKE '%$k%' 
            OR `r_country` LIKE '%$k%'
            OR `r_area` LIKE '%$k%'
            OR `r_depart` LIKE '%$k%'
            OR `r_arrive` LIKE '%$k%'
    ";
    }

    $str.="OR `l_name` LIKE '%$searchtxt%' 
            OR `l_intro` LIKE '%$searchtxt%' 
            OR `l_via` LIKE '%$searchtxt%' 
            OR `l_country` LIKE '%$searchtxt%' 
            OR `l_area` LIKE '%$searchtxt%'";

    foreach($keys as $k){
            $str .= "
            OR `l_name` LIKE '%$k%'
            OR `l_intro` LIKE '%$k%'
            OR `l_via` LIKE '%$k%'
            OR `l_country` LIKE '%$k%'
            OR `l_area` LIKE '%$k%' ";
    }

    $sql.= $str . ') GROUP BY `r_sid`;';
}

function search_txt_tag_country_area(){
    global $sql,$tag,$country,$string, $area;
    
    $sql ="SELECT `route`.`r_sid` FROM `route` LEFT JOIN `route_location` 
    ON `route`.`r_sid`=`route_location`.`r_sid` WHERE ( ";
    
    $str= "";
    
    $keys2 = explode(" ",$tag);
    
    foreach($keys2 as $k){
        $str.="`r_tag`='".$k."' OR ";
    }
    $str=substr($str,0,-3);

    $sql=$sql . $str .") AND ( `r_country`= '{$country}' OR `l_country`= '{$country}') AND (`r_area`= '{$area}' OR `l_area` = '{$area}') AND ( ";

    $searchtxt=$string;
    $keys = explode(" ",$searchtxt);
    $str=" `r_intro` LIKE '%$searchtxt%'  
            OR `r_name` LIKE '%$searchtxt%' 
            OR `r_country` LIKE '%$searchtxt%' 
            OR `r_area` LIKE '%$searchtxt%' 
            OR `r_depart` LIKE '%$searchtxt%' 
            OR `r_arrive` LIKE '%$searchtxt%'";

    foreach($keys as $k){
            $str .= "
            OR `r_intro`LIKE '%$k%' 
            OR `r_name` LIKE '%$k%' 
            OR `r_country` LIKE '%$k%'
            OR `r_area` LIKE '%$k%'
            OR `r_depart` LIKE '%$k%'
            OR `r_arrive` LIKE '%$k%'
    ";
    }

    $str.="OR `l_name` LIKE '%$searchtxt%' 
            OR `l_intro` LIKE '%$searchtxt%' 
            OR `l_via` LIKE '%$searchtxt%' 
            OR `l_country` LIKE '%$searchtxt%' 
            OR `l_area` LIKE '%$searchtxt%'";

    foreach($keys as $k){
            $str .= "
            OR `l_name` LIKE '%$k%'
            OR `l_intro` LIKE '%$k%'
            OR `l_via` LIKE '%$k%'
            OR `l_country` LIKE '%$k%'
            OR `l_area` LIKE '%$k%' ";
    }

    $sql.= $str . ') GROUP BY `r_sid`;';
}

// var_dump($sql);
// echo '--------------------------------------------search multiple keywords end-----------------------------';
$s_rsid;

try{
    $stmt=$pdo->query($sql);
    $s_rsid=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $countrsid=count($s_rsid);
    if($countrsid>0){
        // var_dump($s_rsid);
    }else{
        $result['errMsg']="沒有包含所有條件的路線";
        $result['errCode']=403;
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }
}catch(PDOException $e){
        $result['errMsg']='search fail<br>'.$e;
        $result['errCode']=403;
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
};

// echo '--------------------------------------------first search  end-----------------------------';
$rsids=[];
$questions='';
for($i=0;$i<$countrsid;$i++){
    $questions.='?,';
array_push($rsids, $s_rsid[$i]['r_sid']);
}
$questions = substr($questions,0,-1);


$sql= "SELECT * FROM `route` WHERE `r_sid` IN ($questions)";
// ------------------------------------prepare second search END----------------------------------------
// echo $sql;
try{
        $stmt=$pdo->prepare($sql);
        $stmt->execute($rsids);
        
    if($stmt->rowCount()>0){
        $result['data']=$stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $result['totalRoutes']=$stmt->rowCount();

        $total_pages=ceil( $result['totalRoutes']/$per_page);
        $result['totalPages']=$total_pages;
        // var_dump($stmt);
    }


}catch(PDOException $e){
        $result['errMsg']='search fail<br>'.$e;
        $result['errCode']=403;
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
}

// --------------------------------------------pagination-----------------------------


$orderBy='DESC';
if(isset($_GET['orderBy'])){
    if(boolval($_GET['orderBy'])){
        $orderBy='ASC';
    }
}
$page = isset($_GET['page'])? intval($_GET['page']) : 1;
if ($page<=1){$page=1;}
if ($page>$result['totalPages']){ $page=$result['totalPages'];}
$result['page']=$page;

$sql_lim=($page-1)*$per_page;

$sql .= " ORDER BY `route`.`r_sid` {$orderBy} LIMIT $sql_lim,$per_page";

try{
    $stmt=$pdo->prepare($sql);
    $stmt->execute($rsids);
    if($stmt->rowCount()>0){
        $result['success']=true;
        $result['errCode']=200;
        $result['errMsg']='search success';
    }
}catch(PDOException $e){
    $result['errMsg']='search fail<br>'.$e;
    $result['errCode']=403;
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
}

$result['data'] = $stmt->fetchAll(PDO::FETCH_ASSOC);




echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>
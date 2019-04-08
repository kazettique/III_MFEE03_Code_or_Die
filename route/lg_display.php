<?php
require __DIR__.'/__connect.php';
$page_name='edit';

$rsid = isset($_GET['r_sid'])? intval($_GET['r_sid']):0;

$sql = "SELECT * FROM `route` WHERE r_sid=$rsid";
$row= $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
if (empty($row)){
    header("Location:display.php");
    exit;
}

$sql ="SELECT * FROM `route_location` WHERE r_sid=$rsid";
$row2= $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
if (empty($row)){
  
}

include __DIR__ .'/__html_head.php';
include __DIR__ . '/__nav.php';
?>
<style>
    .cover-img{
        width:100%;
        height:50vh;
        overflow:hidden;
        position:relative;
    }

    .cover-img img{
        width:100%;
        object-fit:cover;
    }

    .icon_edit{
        position:absolute;
        top:3vh;
        right:3vw;
    }

    #details{
        padding-top:5rem;
        text-align:center;
    }
</style>



<div class="container mt-5">
    <div class="cover-img">
        <img src="../the_wheel_uploads/<?=$row['r_img']?>" alt="">
        <a class="icon_edit" href="edit_route.php?r_sid=<?=$row['r_sid']?>"><i class="fas fa-edit"></i></a>
    </div>
    
    <h1 class="my-5"><?=$row['r_name']?></h1>

                  
    <h4>預計時間:<?=$row['r_time']?></h4>
    <h4>路線類型:<?=$row['r_tag']?></h4>
    <h4>國家:<?=$row['r_country']?></h4>
    <h4>地區:<?=$row['r_area']?></h4>
    <h4>出發地:<?=$row['r_depart']?></h4>
    <h4>目的地:<?=$row['r_arrive']?></h4>
    <h4>簡介:</h4>
    <p><?=$row['r_intro']?></p>
    


    <div id="details">
    <h4><?=$row['r_depart']?></h4>
    <p><i class='fas fa-arrow-down'></i></p>
    <?php
    $str = "";
    
    for($i=0;$i<count($row2);$i++){ 
        $k=$i+1;
        $str .= "<h4>地點{$k}&nbsp&nbsp&nbsp{$row2[$i]['l_name']}</h4>
                <p>{$row2[$i]['l_intro']}</p>
                <p><i class='fas fa-arrow-down'></i></p>
                ";
    };
    ?>

    <?= $str;?>
    
    
    <h4><?=$row['r_arrive']?></h4>
    </div>

    


</div>

<div style="height:10rem"></div>




<?php 
include __DIR__. '/__html_foot.php';
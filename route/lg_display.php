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

$sql = "SELECT rc.`r_c`, m.`m_name`, m.`m_photo`, rc.`r_c_time`, a.`name`
        FROM `route_comment` rc  
        LEFT JOIN `member` AS m ON m.`m_sid` = rc.`m_sid` 
        LEFT JOIN `admin` AS a ON a.`id` = rc.`m_sid`
        LEFT JOIN `route`AS r ON r.`r_sid`= rc.`r_sid` 
        WHERE r.`r_sid`= $rsid";
$row3 = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

include __DIR__ .'/__html_head.php';
include  '../sidebar/__nav.php';

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

    .avatar{
        width:50px;
        height:50px;
        border-radius:50%;
        background-color:black;
        overflow:hidden;
    }
    .avatar img{
        width:100%;
        height:100%;
        object-fit:cover;
    }
    .comment_box{
        background-color:#ccc;
    }
    textarea{
        resize:none;
        height:100px;
        width:500px;
    }
</style>



<div class="container mt-5">
    <div class="cover-img">
        <img src="dirname__/../../../the_wheel_uploads/<?=$row['r_img']?>" alt="">
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




<div class="comment-section" style="border:1px solid black">
    <ul class="list-unstyled" id="comments">
    <?php
        $times[] = [];
        for ($i=0; $i<count($row3); $i++){

            $user = $row3[$i]["name"] == null? $row3[$i]["m_name"]:$row3[$i]["name"];
            $times[]=$row3[$i]["r_c_time"];
            echo "<li class='comment_box m-3'>
                    <p class='p-3'>{$row3[$i]["r_c"]}</p>
                    <div class='d-flex justify-content-end align-items-center'>
                        <span>{$user}<br><span class='localtime'>{$row3[$i]["r_c_time"]}</span></span>

                        <div class='avatar m-2'>
                            <img src='{$row3[$i]["m_photo"]}' alt=''>
                        </div> 
                    
                    </div>
                </li>";
        };
    ?>
    </ul>

    <? isset($_SESSION['sid']);?>
    <form method="POST" onsubmit="return false" name="newComment">
        <textarea placeholder="輸入你想要寫的內容..." name="r_c"></textarea>
        <input name="m_sid" class="d-none" value="<?= $_SESSION["id"]?>"> 
        <input name="r_sid" class="d-none" value="<?=$rsid?>"> 
        <input name="r_c_time" class="d-none" id="r_c_time">
        <button type="button" onclick="add_comment()" class="btn btn-primary">Submit</button>
    </form>
</div>


<div style="height:10rem"></div>
</div>

<script>
    function tolocaltime(){
        let timetags = document.getElementsByClassName('localtime');
        const comments = document.getElementById('comments')
        if(timetags.length !== 0){
            let times = <?=json_encode($times)?>;
            for(i=0;i<timetags.length;i++){
                timetags[i].innerHTML = new Date(times[i+1]).toLocaleString()
            }
        }
    }
    tolocaltime()



    function add_comment(){
        document.querySelector('#r_c_time').value=new Date().toGMTString();

        let n_comment = new FormData(document.newComment);
        fetch("./add_new_comment_API.php", {
            method: 'POST',
            body: n_comment
        })
        .then(res=>res.json())
        .then(obj=>{
            comments.innerHTML=''
            let str=""
            let all=obj.all
            for (i=0; i<all.length; i++){
                let user = all[i]["name"] == null? all[i]["m_name"]:all[i]["name"];
                let time = new Date(all[i]["r_c_time"]).toLocaleString()
                str += `
                <li class='comment_box m-3'>
                    <p class='p-3'>${all[i]["r_c"]}</p>
                    <div class='d-flex justify-content-end align-items-center'>
                        <span>${user} <br> <span class='localtime'>${time}</span></span>
                        <div class='avatar m-2'>
                            <img src='${all[i]["m_photo"]}' alt=''>
                        </div> 
                    
                    </div>
                </li>`
            }

            comments.insertAdjacentHTML('afterbegin', str)
            $('textarea').val('');
            // tolocaltime()
        })
        
    }
</script>

<?php 
include __DIR__. '/__html_foot.php';
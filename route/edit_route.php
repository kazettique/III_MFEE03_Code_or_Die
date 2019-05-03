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


include __DIR__ .'/__html_head.php';

?>
<style>
    h3{
        text-align:center;
        margin:1rem;
    }

        .checkform{
        border-color:red;
    }
    small{
        color:red;
        text-align:left;
    }
    .tagbtn input{
        display:none;
    }
    .bgc-selected{
        background-color:#1fbeac!important;
    }
    .tagbtn:hover{
    color:white;
    background-color:#1fbeac;
    box-shadow:0px 0px 3px #2addc7;
}
</style>
<!-- --------------------------Main Form HTML Start-------------------------------------------------------------------------- -->
<?php include __DIR__.'/../sidebar/__nav.php'; ?>
<div class="container mt-5 col-lg-6">
        <h3>修改路線</h3>
        <form name="form1" method="post" enctype="multipart/form-data" onsubmit="return checkform()">
        <input type="hidden" class="form-control" name="r_sid" value="<?=$row['r_sid']?>">
            <div class="form-group">
                <label for="r_name">路線名稱</label>
                <input type="text" class="form-control" name="r_name" id="r_name" aria-describedby="emailHelp" value="<?=$row['r_name']?>">
                <small id="nameHelp" class="form-text "></small>
            </div>
            <div class="form-group">
                <label for="r_time">預計時間</label>
                <input type="text"  name="r_time" id="r_time"class="form-control"  value="<?=$row['r_time']?>">
                <small id="timeHelp" class="form-text text-muted">請按照格式 *D *H *M可省略任意若時間過或短</small>
            </div>
            <div class="form-group">
                <label class="tagbtn btn bgc-green color-white">短途
                    <input type="radio" name="r_tag" value="短途">
                </label>
                <label class="tagbtn btn bgc-green color-white">長途
                    <input type="radio" name="r_tag" value="長途">
                </label>
                <label class="tagbtn btn bgc-green color-white">環島
                    <input type="radio" name="r_tag" value="環島">
                </label>
                <label class="tagbtn btn bgc-green color-white">跨國
                    <input type="radio" name="r_tag" value="跨國">
                </label>
            </div>
            <div class="row mt-3">

                <div class="form-group col-sm-6">
                    <label for="r_country">國家</label>
                    <select name="r_country" id="r_country" class="form-control">
                    </select>  
                    </div>

                <div class="form-group col-sm-6">
                    <label for="r_area">地區</label>
                    <select name="r_area" id="r_area" class="form-control">
                    </select>    
                </div>

            </div>

            <div class="form-group">
                <label for="r_depart">出發地</label>
                <input type="text" name="r_depart" id="r_depart" class="form-control" value="<?=$row['r_depart']?>">
            </div>
            <div class="form-group">
                <label for="r_arrive">目的地</label>
                <input type="text" name="r_arrive" id="r_arrive" class="form-control" value="<?=$row['r_arrive']?>">
            </div>
            <div class="form-group">
                <label for="r_intro">簡介</label>
                <textarea type="text" name="r_intro" id="r_intro" class="form-control"><?=$row['r_intro']?></textarea>
            </div>
            
            
            <div class="form-group">
                <label for="r_img">路線封面</label>
                <input type="file" name="r_img" id="r_img" class="form-control" onchange="javascript:preview()">
            </div>
            <div>
                <img id="r_img_img" class="my-2" alt="圖像不存在請重新上傳" width="600" height="300" src="dirname__/../../../the_wheel_uploads/<?=$row['r_img']?>"/>
            </div>
            
            
            <button type="submit" id="submit" class="btn bgc-green color-white">Submit</button>
        </form>

    <div id="info_bar" class="alert alert-success" role="alert" style="display: none; margin-top:1rem">
    </div>
</div>
<script>
    <?php include __DIR__ .'/tw.js';?>

    for(i in database){
        $('#r_country').append('<option value="'+i+'">'+i+'</option>')
    }

    for(k in database['<?=$row['r_country']?>']){
        $(`#r_area`).append('<option value="'+database['<?=$row['r_country']?>'][k]+'">'+database['<?=$row['r_country']?>'][k]+'</option>');
    }

    $('#r_country').change(function(){
        $('#r_area').empty();
        var county = ($(this).val());
            for(k in database[county]){
                $('#r_area').append('<option value="'+database[county][k]+'">'+database[county][k]+'</option>');
        }
    })
    document.querySelector('#r_country').value ='<?=$row['r_country']?>';
    form1.r_tag.value='<?=$row['r_tag']?>'
    document.querySelector('#r_area').value ='<?=$row['r_area']?>';
</script> 

<?php include __DIR__ . '/edit_location.php';?>
<!-- --------------------------Main Form HTML End-------------------------------------------------------------------------- -->
<div style="height:10rem"></div>

<script>
    function preview(){
        rimg_img=document.getElementById('r_img_img');
        document.getElementById('r_img_img').src = window.URL.createObjectURL(r_img.files[0]);
    }

    $('.tagbtn input:checked').closest('label').addClass('bgc-selected');
    $('.tagbtn').click(function(){
        $('.tagbtn').removeClass('bgc-selected')
        $('.tagbtn input:checked').closest('label').addClass('bgc-selected');
    });
</script>


<script>
    const info_bar = document.querySelector('#info_bar');
    const submit = document.querySelector('#submit');
    let regexp=/^\d{1,3}D\s\d{1,2}H\s\d{1,2}M$|^\d{1,3}D\s\d{1,2}H$|^\d{1,3}D$|^\d{1,2}H\s\d{1,2}M$|^\d{1,2}H$|^\d{1,2}M$/;
    const f_reference = {};
    const fields=[
        'r_name', 
        'r_intro', 
        'r_time', 
        'r_tag', 
        'r_country', 
        'r_area', 
        'r_depart', 
        'r_arrive', 
        'r_img',
    ];



    function checkform (){
        console.log('into checkform')
        $('#timeHelp').addClass('text-muted');
        $('#form1 input').removeClass('checkform');
        $('#form1 select').removeClass('checkform');
        $('small').not('#timeHelp').text('');
        let isPassed=true;
        
        
        for(let v of fields){
            f_reference[v] = document.form1[v].value;
        }

        if(f_reference['r_country']==' '){
            console.log(1)
            document.querySelector('#r_country').classList.add("checkform");
            document.querySelector('#countryHelp').innerHTML = '請選擇路線所屬國家';
            isPassed = false;
        }

        if(f_reference['r_name']==''){
            console.log(2)
            document.querySelector('#r_name').classList.add("checkform");
            document.querySelector('#nameHelp').innerHTML = '請為本路線命名';
            isPassed = false;
        }

        if(f_reference['r_time'].match(regexp)==null|| f_reference['r_time']=='' ){
            console.log('no')
            document.querySelector('#r_time').classList.add("checkform");
            $('#timeHelp').removeClass('text-muted');
            isPassed = false;
        }
        
        
        if(isPassed){
            console.log('isPassed')
            let form = new FormData(document.form1);
            submit.style.display='none';

            fetch('./edit_route_API.php',{
                method: 'POST',
                body:form
            })
            .then(res=>res.json())
            .then(obj=>{
                // info_bar.style.display = 'block';
                if(obj.success){
                    swal.fire("", '路線修改成功', "success");
                    
                }else{
                    swal.fire("", obj.errMsg, "warning");
                }
            })
        };
  

        submit.style.display='block';
        return false;
    };
</script>



<?php 
include __DIR__. '/__html_foot.php';
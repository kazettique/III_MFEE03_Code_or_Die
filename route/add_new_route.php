<?php
include __DIR__ .'/__html_head.php';
include __DIR__ . '/__nav.php';
$page_name='add_new';
?>

<style>
    .checkform{
        border-color:red;
    }
</style>

<!-- --------------------------Main Form HTML Start------------------------------------------------------------------------- -->
    <div class="container mt-5 d-flex flex-column align-items-center">
         <div class="col-lg-12 d-flex flex-column align-items-center">

                <form name="form1" method="post"  enctype="multipart/form-data" class="col-lg-9">
                    <div class="form-group">
                        <label for="r_name">路線名稱</label>
                        <input type="text" class="form-control" name="r_name" id="r_name" aria-describedby="emailHelp" placeholder="路線名稱">
                        <small id="emailHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="r_time">預計時間</label>
                        <input type="text"  name="r_time" id="r_time"class="form-control"  placeholder="預計時間">
                    </div>
                    <div class="form-group">
                        <label class="tagbtn">短途
                            <input type="radio" checked="checked" name="r_tag" value="短途">
                        </label>
                        <label class="tagbtn">長途
                            <input type="radio" name="r_tag" value="長途">
                        </label>
                        <label class="tagbtn">環島
                            <input type="radio" name="r_tag" value="環島">
                        </label>
                        <label class="tagbtn">跨國
                            <input type="radio" name="r_tag" value="跨國">
                        </label>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="r_country">國家</label>
                            <select type="text" name="r_country" id="r_country" class="form-control">
                            </select>  
                        </div>
                        <div class="form-group col-6">
                            <label for="r_area">地區</label>
                            <select type="text" name="r_area" id="r_area" class="form-control">
                            </select>      
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="r_depart">出發地</label>
                        <input type="text" name="r_depart" id="r_depart" class="form-control" placeholder="出發地">
                    </div>
                    <div class="form-group">
                        <label for="r_arrive">目的地</label>
                        <input type="text" name="r_arrive" id="r_arrive" class="form-control" placeholder="目的地">
                    </div>
                    <div class="form-group">
                        <label for="r_intro">簡介</label>
                        <textarea type="text" name="r_intro" id="r_intro" class="form-control" placeholder="簡介"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="r_img">路線封面</label>
                        <input type="file" name="r_img" id="r_img" class="form-control" onchange="preview()">
                    </div>
                    <div>
                        <img id="r_img_img" class="my-2" alt="your image" width="600" height="300" style="display:none"/>
                    </div>
                    <input type="text" name="r_time_added" id="r_time_added" style="display:none">
                </form>
        </div>
                <?php include __DIR__.'/insert_location_breakdown_1.php';?>
                <button type="submit" id="submit" class="btn btn-primary my-4"  onclick="checkform_route()">Submit</button>
                <div id="info_bar" class="alert alert-success" role="alert" style="display: none; margin-top:1rem">
                </div>
            
    </div>
<!-- --------------------------Main Form HTML End-------------------------------------------------------------------------- -->


    <div style="height:10rem"></div>

<!-- --------------------------Preview Script Start-------------------------------------------------------------------------- -->
<script>
    <?php include __DIR__ .'/tw.js';?>

    for(i in database){
        $('#r_country').append('<option value="'+i+'">'+i+'</option>')
    }

    $('#r_country').change(function(){
        $('#r_area').empty();
        var county = ($(this).val());
            for(k in database[county]){
                $('#r_area').append('<option value="'+database[county][k]+'">'+database[county][k]+'</option>');
        }
    })
    
    function preview(){
        rimg_img=document.getElementById('r_img_img');
        document.getElementById('r_img_img').src = window.URL.createObjectURL(r_img.files[0]);
        document.getElementById('r_img_img').style.display = 'inline';
    }
    
    // document.querySelector('#r_time_added').value=new Date().toISOString().slice(0, 19).replace('T', ' ');
    
</script>
<!-- --------------------------Preview Script End-------------------------------------------------------------------------- -->

<!-- --------------------------Main Script Start-------------------------------------------------------------------------- -->
<script>
    const info_bar = document.querySelector('#info_bar');
    const info_bar2 = document.querySelector('#info_bar2');
    const submit = document.querySelector('#submit');
    let rsid = 0;
    let lastSid=0;
    let country='';
    let area='';
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

    
    
    
    
    function checkform_route (){
        let isPassed=true;
        
        for(let v of fields){
            f_reference[v] = document.form1[v].value;
        }

        if(f_reference['r_country']==''){
            document.querySelector('#r_country').classList.add("checkform");
            document.querySelector('#countryHelp').innerHTML = '請選擇路線所屬國家';
            isPassed = false;
        }

        // if(f_reference['r_time']){
        //     document.querySelector('#r_time').classList.add("checkform");
        //     document.querySelector('#countryHelp').innerHTML = '請按照格式XXD-XXh-XXm';
        //     isPassed = false;
        // }


        if(isPassed){
            document.querySelector('#r_time_added').value=new Date().toGMTString();

            let form = new FormData(document.form1);

            submit.style.display='none';

            fetch('./add_new_route_API.php',{
                method: 'POST',
                body:form
            })
            .then(res=>res.json())
            .then(obj=>{
                info_bar.style.display = 'block';
                if(obj.success){
                    // rsid=obj.post.r_sid;
                    info_bar.className = 'alert alert-success';
                    info_bar.innerHTML = '路線新增成功';
                    lastSid=obj.last_sid;
                    country=obj.post.r_country;
                    area=obj.post.r_area;
                }else{
                    info_bar.className = 'alert alert-danger';
                    info_bar.innerHTML = obj.errMsg;
                }})
            .then(
                function(){    
                    <?php include __DIR__.'/insert_location_breakdown_2.php';?>
                        }
            );




            submit.style.display='block';  
        };
        return false;
    }
</script>





<?php 
include __DIR__. '/__html_foot.php';
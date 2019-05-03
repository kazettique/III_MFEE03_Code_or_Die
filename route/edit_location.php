<?php
// require __DIR__.'/__connect.php';
// $page_name='edit';

// $rsid = isset($_GET['r_sid'])? intval($_GET['r_sid']):0;

$sql ="SELECT * FROM `route_location` WHERE r_sid=$rsid";
// var_dump($rsid);
$row2= $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
//var_dump(json_encode($row2));
$str = [];
$str2 = [];
include __DIR__ .'/__html_head.php';

?>


<style>

    .form-short{
        width:100%;
        height: calc(1.5em + 0.75rem + 2px);
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .form-short:disabled{
        background-color: #e9ecef;
        opacity: 1;
    }
    
    .location-group{
        background-color:#f7f7f7;
        position:relative;
    }

    .edit-tool{
        position:absolute;
        top:.5rem;
        right:.5rem
    }

    .l_delete {
        position:absolute;
        top:.5rem;
        right:.5rem;
        background-color: transparent;
        color:red;
    }

    .working{
        background-color:#ffe5e5;
        border:1px solid red;
    }

    #test{
        border:1px solid white;
    }
    button.update-btn{
        display:none;
    }
    .updating{
        color:red;
    }
</style>


<div class="container ">
<div id="info_bar3" class="alert alert-success" role="alert" style="display: none; margin-top:1rem"></div>
    <div style="width:100%">
        
        <div class="my-4" id="main_l">
            <?php
                function mainl() {
                global $row2;
                for($i=0;$i<count($row2);$i++){ 
                    $k=$i+1;
                    global $str, $str2;
                    $str[]=$row2[$i]['l_country'];
                    $str2[]=$row2[$i]['l_area'];?>
                    
                    <form class="form-group card location-group p-3" id="l_id<?=$row2[$i]['l_sid']?>" name="form<?=$row2[$i]['l_sid']?>">
                        <input type="text"  name="l_sid[]" value=<?=$row2[$i]['l_sid']?> style="display:none">
                        <div class="edit-tool">
                            <a class="icon mx-3" href="javascript:update_l('<?=$row2[$i]['l_sid']?>')" id="update<?=$row2[$i]['l_sid']?>"><i class="fas fa-edit"></i></a>
                            <a class="icon mx-3" href="javascript:delete_l(<?=$row2[$i]['l_sid']?>)" ><i class="fas fa-trash-alt"></i></a>
                        </div>
                        <div>
                        <button class="btn btn-success">up</button>
                        <button class="btn btn-success">down</button>
                        </div>
                        <label for="l_name">地點名稱<?=$k?></label>
                        <input type="text" class="form-control <?=$row2[$i]['l_sid']?>" name="l_name[]" id="l_name${count}" value="<?=$row2[$i]['l_name']?>" disabled="true">
                        
                        <div class="row mt-3">
                            <div class="col-sm-6">
                                <label for="l_country">國家</label>
                                <select class="form-short <?=$row2[$i]['l_sid']?> lc" name="l_country[]" id="l_country<?=$row2[$i]['l_sid']?>" disabled="true">
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="l_area">地區</label>
                                <select class="form-short <?=$row2[$i]['l_sid']?> la" name="l_area[]" id="l_area<?=$row2[$i]['l_sid']?>" disabled="true">
                                </select>
                            </div>  
                        </div>

                        <label for="l_intro" class="mt-3">描述</label>
                        <textarea type="text" name="l_intro[]" id="l_intro" class="form-control <?=$row2[$i]['l_sid']?>" disabled="true"><?=$row2[$i]['l_intro']?></textarea>
                        <button type="button" class="btn btn-primary mt-4 update-btn" id="complete<?=$row2[$i]['l_sid']?>" onclick="update_done(this.id)">Complete</button>
                    </form>
            <?php }}; mainl()?>

        </div>
        <button class="btn bgc-green color-white my-5 d-block" type="button" onclick="addNewPlace()">Add Location</button>
        <form id="test" method="post" name="form2">
            
        </form> 
        <button type="submit" class="btn bgc-green color-white mt-5"onclick="return checkform_location()">Submit</button>
    </div>
    <div id="info_bar2" class="alert alert-success" role="alert" style="display: none; margin-top:1rem"></div>
</div>
<div style="height:10rem"></div>
<!-- --------------------------------------------------need to work on cross country start------------------------------ -->
<script>
    <?php include __DIR__ .'/tw.js';?>
    
    lc=document.getElementsByClassName('lc');
    let all = <?=json_encode($str)?>;
    let all2 = <?=json_encode($str2)?>;
    for(let i=0;i<lc.length;i++){
        country=all[i];
        area = all2[i]; 
        for(k in database){
        $('.lc').eq(i).append('<option value="'+k+'">'+k+'</option>')
        };
        for(k in database[country]){
            $('.la').eq(i).append('<option value="'+database[country][k]+'">'+database[country][k]+'</option>');
        }
        lc[i].value = country;
         $('.la').eq(i).val(area);
    }

    $('.lc').change(function(){
        let l_a=$(this).parent().siblings().children().eq(1);
        var county = ($(this).val());
        l_a.empty();
        for(k in database[county]){
            l_a.append('<option value="'+database[county][k]+'">'+database[county][k]+'</option>');
        }
    })

// <!-- --------------------------------------------------need to work on cross country end------------------------------ -->


    const test = document.querySelector('#test');
    const info_bar2 = document.querySelector('#info_bar2');
    const info_bar3 = document.querySelector('#info_bar3');
    let main_html=document.getElementById('main_l');
    let count=0;
    let currentlc='';
    let currentla='';
   
    function addNewPlace(){
        count++;
        test.insertAdjacentHTML('beforeend',
                        `<div class="form-group card location-group p-3" id="l_id${count}">
                            <input type="text"  name="r_sid[]" id="r_sid" value="<?=$rsid?>" style="display:none">
                            
                            <button type="button" class="l_delete btn mx-3" onclick="del(this.id)" id="${count}"><i class="fas fa-trash-alt"></i></button>
                            

                            <label for="l_name">地點名稱</label>
                            <input type="text" class="form-control" name="l_name[]" id="l_name${count}">
                            
                            <div class="row mt-3">
                                <div class="col-sm-6">
                                    <label for="l_country">國家</label>
                                    <select class="form-short lcn" name="l_country[]">
                                    
                                    </select>
                                    
                                </div>
                                <div class="col-sm-6">
                                    <label for="l_area">地區</label>
                                    <select type="text" class="form-short lan" name="l_area[]"></select><br>
                                </div>  
                            </div>

                            <label for="l_intro" class="mt-3">描述</label>
                            <textarea type="text" name="l_intro[]" id="l_intro" class="form-control"></textarea>
                        </div>
                    
                `);

                let lcn=document.getElementsByClassName('lcn');
                for(let i=0;i<lcn.length;i++){
                    for(k in database){
                    $('.lcn').eq(i).append('<option value="'+k+'">'+k+'</option>')
                    };
                    console.log($('.lcn'))
                }

                $('.lcn').change(function(){
                    let l_a=$(this).parent().siblings().children().eq(1);
                    var county = ($(this).val());
                    l_a.empty();
                    for(k in database[county]){
                        l_a.append('<option value="'+database[county][k]+'">'+database[county][k]+'</option>');
                    }
                })

                for(let i=0;i<lcn.length;i++){
                    lcn[i].value =all;
                }
                
    }

    function del(click_id){
        count--;
        // let l_delete = document.querySelector(`l_id${click_id}`)
        let l_delete = document.getElementById('l_id'+click_id)
        l_delete.parentNode.removeChild(l_delete);
    }

    function checkform_location (){
        let form2 = new FormData(document.form2);


        fetch('./insert_location_API.php',{
            method: 'POST',
            body:form2
        })
        .then(res=>res.json())
        .then(obj=>{
            info_bar2.style.display = 'block';
            if(obj.success){               
                info_bar2.className = 'alert alert-success';
                info_bar2.innerHTML = obj.errMsg;
                setTimeout(() => {
                    info_bar3.style.display = 'none';
                    location.reload()
                }, 1000);
                return false;
            }else{
                info_bar2.className = 'alert alert-danger';
                info_bar2.innerHTML = obj.errMsg;
            }
        })
    };

    function delete_l(l_sid){
        if(confirm(`確定要刪除地點嗎？`))
        fetch('delete_location.php?l_sid='+ l_sid)
        .then(res=>res.json())
        .then(obj=>{

            info_bar2.innerHTML = obj['errMsg'];
            if(obj['success']){
                info_bar2.className = 'alert alert-success';
            }else{
                info_bar2.className = 'alert alert-danger';
            }
            info_bar2.style.display = 'block';

            location.reload();
        })
    };

    let update_l = function (update_lsid){
        const lsid=document.getElementsByClassName(update_lsid);
        
        for(i=0;i<lsid.length;i++){
           lsid[i].disabled=false;
        }
       const l_id = document.getElementById(`l_id${update_lsid}`);
       const l_btn= document.getElementById(`complete${update_lsid}`);
       const l_update= document.getElementById(`update${update_lsid}`);
       const l_c= document.getElementById(`l_country${update_lsid}`);
       const l_a= document.getElementById(`l_area${update_lsid}`);
       
       if(currentlc==''){
        currentlc=l_c.value;
        currentla=l_a.value;
       }

        console.log(currentlc)
        console.log(currentla)
       
        l_id.classList.toggle('working');
       l_btn.classList.toggle('update-btn');

       if(l_id.classList.contains('working')){
             l_update.classList.add('updating')
             console.log('yes')
       }else{
            l_update.classList.remove('updating')
            if(currentlc!==''){
                for(i=0;i<lsid.length;i++){
                    lsid[i].disabled=true;
                }
                l_c.value=currentlc;
                let str=''
                for(k in database[currentlc]){
                    str +='<option value="'+database[currentlc][k]+'">'+database[currentlc][k]+'</option>';
                }
                l_a.innerHTML=str;
                l_a.value=currentla;
            }
            console.log('no')
       }

    };

    function update_done(thisid){
        const formname = document.querySelector(`#${thisid}`).parentElement;
        let formX = new FormData(formname);

            fetch('./update_location_API.php',{
                method: 'POST',
                body:formX
            })
            .then(res=>res.json())
            .then(obj=>{
                // info_bar3.style.display = 'block';
                if(obj.success){
                    swal.fire("", '地點修改成功', "success");
                    // info_bar3.className = 'alert alert-success';
                    // info_bar3.innerHTML = '地點修改成功';
                    formname.classList.remove("working")
                    document.querySelector(`#${thisid}`).style.display='none';
                    setTimeout(() => {
                        // info_bar3.style.display = 'none';
                        // main_l();
                        location.reload();
                    }, 2000);
                }else{
                    info_bar3.className = 'alert alert-danger';
                    info_bar3.innerHTML = obj.errMsg;
                }
            })

            // completebtn.style.display='block';
            // return false;
            // console.log(formX)
    }


</script>


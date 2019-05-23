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
// include __DIR__ .'/__html_head.php';

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
</style>


<div class="container ">
<div id="info_bar3" class="alert alert-success" role="alert" style="display: none; margin-top:1rem"></div>
    <div style="width:100%">
        
        <div class="my-4" id="main_l">
            <form name="form_all_l" id="form_all_l"></form>
            <!-- <button type="button" class="btn btn-primary mt-4" id="complete" onclick="update_done()">Complete</button> -->
        </div>
        <button class="btn bgc-green color-white my-5 d-block" type="button" onclick="addNewPlace()">Add Location</button>
        <!-- <form id="test" method="post" name="form2"></form>  -->
        <!-- <button type="submit" class="btn bgc-green color-white mt-5"onclick="return checkform_location()">Submit</button> -->
    </div>
    <div id="info_bar2" class="alert alert-success" role="alert" style="display: none; margin-top:1rem"></div>
</div>
<div style="height:10rem"></div>
<!-- --------------------------------------------------need to work on cross country start------------------------------ -->
<script>
    ajax_after_update();

    const c_start = "<?=$row["r_country"]?>";
    let all = <?=json_encode($str)?>;
    let all2 = <?=json_encode($str2)?>;
    function country_value(all,all2){
        lc=document.getElementsByClassName('lc');
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
    }}
    country_value(all,all2);

    $('.lc').change(function(){
        let l_a=$(this).parent().siblings().children().eq(1);
        var county = ($(this).val());
        l_a.empty();
        for(k in database[county]){
            l_a.append('<option value="'+database[county][k]+'">'+database[county][k]+'</option>');
        }
    })


    const form_all_l = document.querySelector('#form_all_l');
    const info_bar2 = document.querySelector('#info_bar2');
    const info_bar3 = document.querySelector('#info_bar3');
    let main_html=document.getElementById('main_l');
    // let currentlc='';
    // let currentla='';
   
    function addNewPlace(){
        form_all_l.insertAdjacentHTML('beforeend',
                        `<div class="form-group card location-group p-3 r_l_count">
                            <input type="text"  name="r_sid[]" id="r_sid" value="<?=$rsid?>" style="display:none">
                            <input type="text"  name="l_sid[]" value="NULL" style="display:none">
                            
                            <button type="button" class="l_delete btn mx-3" onclick="del(this.id)"><i class="fas fa-trash-alt"></i></button>
                            
                            <div>
                                <button class="btn btn-success orderUpBtn">up</button>
                                <button class="btn btn-success orderDownBtn">down</button>
                            </div>
                            <label for="l_name">地點名稱${form_all_l.children.length+1}</label>
                            <input type="text" class="form-control" name="l_name[]">
                            
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
                            <input class="lOrder" name="l_order[]" value="${form_all_l.children.length}">
                        </div>
                    
                `);
                add_clickevent_order()
                let lcn=form_all_l.lastElementChild.querySelector('.lcn')
                for(k in database){
                lcn.insertAdjacentHTML('beforeend','<option value="'+k+'">'+k+'</option>')
                };
                lcn.value = c_start;

                lan = lcn.parentElement.nextElementSibling.querySelector('.lan');
                for(k in database[c_start]){
                    lan.insertAdjacentHTML('beforeend','<option value="'+database[c_start][k]+'">'+database[c_start][k]+'</option>');
                }

                $('.lcn').change(function(){
                    let l_a=$(this).parent().siblings().children().eq(1);
                    var county = ($(this).val());
                    l_a.empty();
                    for(k in database[county]){
                        l_a.append('<option value="'+database[county][k]+'">'+database[county][k]+'</option>');
                    }
                })

                // for(let i=0;i<lcn.length;i++){
                //     lcn[i].value =all;
                // }
                
    }


    function del(click_id){
        // let l_delete = document.querySelector(`l_id${click_id}`)
        let l_delete = document.getElementById('l_id'+click_id)
        l_delete.parentNode.removeChild(l_delete);
    }

    function checkform_location (){
        if (test.hasChildNodes()){
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
        })} else{
            info_bar2.style.display = 'block';
            info_bar2.className = 'alert alert-danger';
            info_bar2.innerHTML = 'No new location';
        }
    };

    function delete_l(l_sid){
        if(confirm(`確定要刪除地點嗎？`))
        fetch('delete_location.php?l_sid='+ l_sid)
        .then(res=>res.json())
        .then(obj=>{

            info_bar2.innerHTML = obj['errMsg'];
            if(obj['success']){
                info_bar2.className = 'alert alert-success';
                reorder()
            }else{
                info_bar2.className = 'alert alert-danger';
            }
            info_bar2.style.display = 'block';

            // location.reload();
            ajax_after_update();
            reorder()
        })
    };

    function update_done(thisid){
        
        let formX = new FormData(form_all_l);

            fetch('./update_location_API.php',{
                method: 'POST',
                body:formX
            })
            .then(res=>res.json())
            .then(obj=>{
                // info_bar3.style.display = 'block';
                if(obj.success){
                    swal({
                        title: "修改成功",
                        text: "",
                        icon: "success",
                        button: "確定",
                    });
                    
                    setTimeout(() => {
                        // info_bar3.style.display = 'none';
                        ajax_after_update();
                    }, 2000);
                }else{
                    swal({
                        title: obj.errMsg,
                        text: "",
                        icon: "warning",
                        button: "確定",
                    });
                    // info_bar3.className = 'alert alert-danger';
                    // info_bar3.innerHTML = ;
                }
            })

    }

    function ajax_after_update(){
        fetch('./edit_location_display_API.php?r_sid=<?=$rsid?>')
        .then(res=>res.json())
        .then(obj=>{
            obj.sort((a, b) => (a.l_order > b.l_order) ? 1 : -1);
            let str="";
            let arr_c=[];
            let arr_a=[];
            for(i=0;i<obj.length;i++){
                arr_c.push(obj[i]['l_country'])
                arr_a.push(obj[i]['l_area'])
                str += `<div class="form-group card location-group p-3 r_l_count" id="l_id${obj[i]['l_sid']}">
                        <input type="text"  name="r_sid[]" id="r_sid" value="<?=$rsid?>" style="display:none">
                        <input type="text"  name="l_sid[]" value=${obj[i]['l_sid']} style="display:none">
                        <div class="edit-tool">
                            <a class="icon mx-3" href="javascript:delete_l(${obj[i]['l_sid']})" ><i class="fas fa-trash-alt"></i></a>
                        </div>
                        <div>
                        <button class="btn btn-success orderUpBtn" onclick="orderUp()">up</button>
                        <button class="btn btn-success orderDownBtn" onclick="orderDown()">down</button>
                        </div>
                        <label for="l_name">地點名稱${i+1}</label>
                        <input type="text" class="form-control ${obj[i]['l_sid']}" name="l_name[]" value="${obj[i]['l_name']}">
                        
                        <div class="row mt-3">
                            <div class="col-sm-6">
                                <label for="l_country">國家</label>
                                <select class="form-short ${obj[i]['l_sid']} lc" name="l_country[]" id="l_country${obj[i]['l_sid']}">
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="l_area">地區</label>
                                <select class="form-short ${obj[i]['l_sid']} la" name="l_area[]" id="l_area${obj[i]['l_sid']}">
                                </select>
                            </div>  
                        </div>

                        <label for="l_intro" class="mt-3">描述</label>
                        <textarea type="text" name="l_intro[]" id="l_intro" class="form-control ${obj[i]['l_sid']}">${obj[i]['l_intro']}</textarea>
                        <input class="lOrder" name="l_order[]" value="${obj[i]['l_order']}">
                </div>`
            }
            form_all_l.innerHTML=str;
            country_value(arr_c,arr_a)
            reorder ()
            add_clickevent_order()
            reorder()
        })
    }
//  ------------------------------order ----------------------------------------
function add_clickevent_order(){
        let orderDownBtn = document.getElementsByClassName('orderDownBtn');
        let orderUpBtn = document.getElementsByClassName('orderUpBtn');
        for(i=0; i<orderDownBtn.length; i++){
            orderDownBtn[i].addEventListener('click',orderDown)
            orderUpBtn[i].addEventListener('click',orderUp)
        }
}

    add_clickevent_order()

    function orderUp(event){
        event.preventDefault()
        event.stopPropagation()
        let item = event.target.parentNode.parentNode
        if (item.previousElementSibling){
          item.parentNode.insertBefore(
            item,
            item.previousElementSibling
          );
        }
        reorder()
    }


    function orderDown(event){
        event.preventDefault()
        event.stopPropagation()
        let item = event.target.parentNode.parentNode
        if(item.nextElementSibling){
             item.parentNode.insertBefore(item.nextElementSibling, item);
        }
        reorder()
    }
    
    function reorder (){
        let lOrder=document.getElementsByClassName('lOrder')
        for(i=0;i<lOrder.length;i++){
            lOrder[i].value=i
        }
    }
    


</script>


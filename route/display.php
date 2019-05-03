<?php
include __DIR__ .'/__html_head.php';
include  '../sidebar/__nav.php';
$page_name='home';
?>
<style>
    .card-img-con{
        width:100%;
        height:7rem;
        overflow:hidden;
        position:relative;
    }

    .card-img{
        width:100%;
        height:100%;
        object-fit:cover;
        background-color:black;
    }

    .card-img-txt{
        color:white;
        width:100%;
        height:100%;
        object-fit:cover;
        text-align:center;
        font-size:2rem;
        font-weight:900;
        margin-top:5rem
        
    }

    .icon{
        z-index:1000;
        color:red;
    }

    .intro{
    text-overflow:ellipsis;
    overflow : hidden;
    white-space: nowrap;
    }

    .rName {
        text-overflow:ellipsis;
    overflow : hidden;
    white-space: nowrap;
    font-weight:bold;
    }
    .tagbtn input{
        display:none;
    }
    .tagbtn input:checked label {
        background-color:red;
        color:#fff;
    }

    .card-info{
        text-align:left;
    }
</style>

 <div class="row py-3 d-flex flex-column main-content">

            <div class="w-100 d-flex justify-content-between mb-3 align-items-end sub-wrap1">
                <div class="d-flex align-items-end">
                    <div class="d-flex flex-column title-big">
                        <div class="title-img"><div><img src="../resources/images/route-page-title2.svg" alt="Route Management" ></div></div>
                        <h2 class="pageNameRight t-0 mb-3" >路線管理</h2> 
                    </div>
                
                    <form class="searchbar form-inline my-sm-2" name="search_get" onsubmit="return rsearch()" method="get">
                        <input class="form-control mr-sm-2 bgc-gray" name="search" id="search" type="search" placeholder="請輸入關鍵字" aria-label="Search">
                        <button class="btn bgc-green color-white mr-2 mr-sm-4 my-2 search-submit" type="submit">搜索</button>
                        <button type="button" class="btn bgc-white border-1-green advance-search" style="display:none">進階搜尋</button>
                    </form>
                </div>
                <div class="d-flex align-items-center my-md-3 add-new-wrap">
                    <a class="btn bgc-green px-lg-5 color-white font-weight-bold add-new" href="./add_new_route.php">新增路線</a>
                </div>
            </div>


            <div class="w-100 d-flex my-sm-3 setting-wrap position-relative">
                <select name="" id="r_order" class="form-control border-1-green fa order">
                    <option value=0 class="fa">按新增時間 &#xf063;</option>
                    <option value=1 class="fa">按新增時間 &#xf062;</option>
                </select>

                <div class="pagination-wrap d-flex">
                    <p class="text-left mb-0 mr-3">第1頁/共3頁</p>
                    <ul class="pagination justify-content-center mr-5 mb-0">
                    </ul>
                </div>
                <select  id="per_page" class="form-control border-1-red perPage">
                    <option value=10>每頁顯示10條路線</option>
                    <option value=5>每頁顯示5條路線</option>
                    <option value=15>每頁顯示15條路線</option>
                    <option value=20>每頁顯示20條路線</option>
                </select> 
            </div>
            
            <div class="where-you-put-everything">



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
    
    
    <form class="my-4 tagbtns" name="form4" id="form4">
        <label class="tagbtn btn bgc-green color-white transition m-sm-3">
            <input type="checkbox" class="btn btn-outline-success my-2 my-sm-0" name="rtag" value="短途" onclick="searchtag()">短途
        </label>
        <label class="tagbtn btn bgc-green color-white transition m-sm-3">
            <input type="checkbox" class="btn btn-outline-success my-2 my-sm-0" name="rtag" value="長途" onclick="searchtag()">長途
        </label>
        <label class="tagbtn btn bgc-green color-white transition m-sm-3">
            <input type="checkbox" class="btn btn-outline-success my-2 my-sm-0" name="rtag" value="環島" onclick="searchtag()">環島
        </label>
        <label class="tagbtn btn bgc-green color-white transition m-sm-3">
            <input type="checkbox" class="btn btn-outline-success my-2 my-sm-0" name="rtag" value="跨國" onclick="searchtag()">跨國
        </label>
    </form>
    
    <div id="info_bar4" class="alert alert-success" role="alert" style="display: none; margin-top:1rem"></div>


    
    <div class="row" id="block"></div>
    
    <div id="info_bar" class="alert alert-success" role="alert" style="display: none;margin-top:1rem"></div>


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
</script>

<script>
    const block = document.querySelector('#block');
    const pagi = document.querySelector('.pagination');
    let page=1;
    let perPage=10;
    let orderBy=0;
    let country='';
    let area='';
    let tag='';



    function fetch_routes(){
        fetch('./display_API.php?page='+ page+'&perPage='+perPage+'&orderBy='+orderBy)
        .then(res=>res.json())
        .then(
            obj=>{
                let active = (obj['page']===1)? 'disabled':''
                let str=`<li class="page-item list-unstyled"><a class="page-link transition" href="#${1}">First</a></li>
                        <li class="page-item list-unstyled ${active}"><a class="page-link transition" href="#${obj['page']-1}"><i class="fas fa-caret-left"></i></a></li>`;
                
                if(obj['totalPages']<10){
                    for(let i=1;i<=obj['totalPages'];i++){
                    active = (i===obj['page'])? 'active':'';
                    str += `<li class="page-item ${active}"><a class="page-link transition" href="#${i}">${i}</a></li>`
                    };
                }else if(obj['page']<=5){
                    for(let i=1;i<=9;i++){
                    active = (i===obj['page'])? 'active':'';
                    str += `<li class="page-item ${active}"><a class="page-link transition" href="#${i}">${i}</a></li>`
                    };
                    
                }
                else if(obj['page']>=obj['totalPages']-4){
                    
                    for(let i=obj['totalPages']-8;i<=obj['totalPages'];i++){
                    active = (i===obj['page'])? 'active':'';
                    str += `<li class="page-item ${active}"><a class="page-link transition" href="#${i}">${i}</a></li>`
                    };
                }else{
                    
                    for(let i=obj['page']-4;i<=obj['page']+4;i++){
                    active = (i===obj['page'])? 'active':'';
                    str += `<li class="page-item ${active}"><a class="page-link transition" href="#${i}">${i}</a></li>`
                    };
                }
                
                
                active = (obj['page']===obj['totalPages'])? 'disabled':''
                str+=`<li class="page-item list-unstyled"><a class="page-link transition" href="#${obj['page']+1}"><i class="fas fa-caret-right"></i></a></li>
                    <li class="page-item list-unstyled ${active}"><a class="page-link transition" href="#${obj['totalPages']}">Last</a></li>`
                pagi.innerHTML=str;
                
                str = '';
                
                let rimg='';
                let r_on='';
                let d = obj['data'];
                for(let card in d){
                    if(d[card]['r_on']=='1'){
                        r_on='<i class="fas fa-eye"></i>';
                    }else{
                        r_on='<i class="fas fa-eye-slash"></i>';
                    }
                    if(d[card]['r_img']){
                        rimg=`<img class="card-img" src="dirname__/../../../the_wheel_uploads/${d[card]['r_img']}";>`
                    }else{
                        rimg=`<div class="card-img d-flex align-items-center">
                        <div class="card-img-txt"> ${d[card]['r_name']}</div>
                        </div>`;
                    }
                    let inlocaltime = new Date(`${d[card]['r_time_added']}`).toLocaleString()
                    str+=`<div class="card" style="width: 15rem;  margin:1rem .5rem; position:relative;">
                                        <a class="icon" href="javascript:delete_r(${d[card]['r_sid']})" style="position:absolute;top:.5rem;right:.5rem"><i class="fas fa-trash-alt"></i></a>
                                        <a class="icon" href="edit_route.php?r_sid=${d[card]['r_sid']}" style="position:absolute;top:.5rem;left:.5rem"><i class="fas fa-edit"></i></a>
                                        <a class="icon" href="javascript:r_on_switch(${d[card]['r_sid']})" style="position:absolute;top:.5rem;left:7rem" id="ron${d[card]['r_sid']}">${r_on}</a>
                                        <div class="card-img-con" alt="IMG">
                                            ${rimg}
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title rName">${d[card]['r_name']}</h5>
                                            <p class="card-title card-info">
                                            類型: ${d[card]['r_tag']}<br>
                                            國家地區:${d[card]['r_country']} ${d[card]['r_area']}<br>
                                            預計時間: ${d[card]['r_time']}<br>
                                            出發地: ${d[card]['r_depart']}<br>
                                            目的地: ${d[card]['r_arrive']}<br>
                                            </p>
                                            <p class="card-text intro">${d[card]['r_intro']}</p>
                                            <a href="lg_display.php?r_sid=${d[card]['r_sid']}" class="btn bgc-green color-white">查看路線</a>
                                            <p>${inlocaltime}</p>
                                        </div>
                                    </div>`
                    }
                block.innerHTML=str;


                }
            )
    }


    $('#per_page').change(function(){
        perPage=this.value;
        let search = $('#search').val().length;
        let checked=$('.tagbtns input:checked').length;
        let country=$('#r_country').val();
        if(search ==0 && checked ==0 && country ==' ' ){
            fetch_routes()
            console.log(3)
        }else{
            searchtag()
            console.log(4)
        }
    })

    $('#r_order').change(function(){
        orderBy=this.value;
        if($('#search').val()=='' && $('.tagbtns input:checked').length==0 && $('#r_country').val()==' '){
            fetch_routes()
            console.log(1)
        }else{
            searchtag()
            console.log(2)
        }
    })
    
    $('#r_country').change(function(){
        country=this.value;
        area='';
        if($('#search').val()=='' && $('.tagbtns input:checked').length==0 && $('#r_country').val()==''){
            fetch_routes()
            console.log(1)
        }else{
            searchtag()
            console.log(2)
        }
    })

    $('#r_area').change(function(){
        area=this.value;
        if($('#search').val()=='' && $('.tagbtns input:checked').length==0 && $('#r_country').val()==''){
            fetch_routes()
            console.log(1)
        }else{
            searchtag()
            console.log(2)
        }
    })



    
    function my_hashchange(){
        let h = location.hash.slice(1);
        if (isNaN(h)){
            page=1
        }else{
            page=parseInt(h)
        };

        fetch_routes();

    };

    
    
    window.addEventListener('hashchange', my_hashchange);
    my_hashchange();

    function delete_r(r_sid){
        if(confirm(`確定要刪除編號為${r_sid}的路線？`))
        fetch('delete_route.php?r_sid='+ r_sid)
        .then(res=>res.json())
        .then(obj=>{

            info_bar.innerHTML = obj['errMsg'];
            if(obj['success']){
                swal.fire("Good job!", `${obj['errMsg']}`, "success");
                // info_bar.className = 'alert alert-success';
            }else{
                // info_bar.className = 'alert alert-danger';
                swal.fire("Good job!", `${obj['errMsg']}`, "error");
            }
            // info_bar.style.display = 'block';
            swal.fire("Good job!", `${obj['errMsg']}`, "error");

            fetch_routes();
        })
    };

    function r_on_switch (rsid){
        fetch("./switch_API.php?r_sid="+rsid)
        .then(res=>res.json())
        .then(obj=>{
            let ron=document.getElementById(`ron${rsid}`);
            if(obj.success){
                
                if (obj.get.r_on=='1'){
                    ron.innerHTML='<i class="fas fa-eye"></i>';
                    
                }else{
                    ron.innerHTML='<i class="fas fa-eye-slash"></i>';
                }   
            }else(
                console.log(obj.errMsg)
            )
        })
    }

<?php include __DIR__. '/search_script.js';?>

    // $('.advance-search').click(function(){

    // })

</script>

<?php 
include __DIR__. '/__html_foot.php';
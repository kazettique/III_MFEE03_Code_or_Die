<?php
    require __DIR__. '/__connect_db.php';
    $page_name = 'event_list';

?>

<?php include __DIR__. '/__html_head.php';  ?>
<?php include __DIR__.'/../sidebar/__nav.php'; ?>




<style>
.form-control{
    width: 80%;
}
</style>


<div class="row py-3 d-flex flex-column main-content">

<div class="w-100 d-flex justify-content-between mb-3 align-items-end sub-wrap1">
    <div class="d-flex align-items-end">
        <div class="d-flex flex-column title-big">
            <div class="title-img">
                <div><img src="resources/images/activity-page-title.svg" alt="Route Management" ></div>
                
            </div>
            <h2 class="pageNameRight t-0 mb-3" >活動管理</h2> 
        </div>
    
        <!-- <form class="searchbar form-inline my-sm-2 ">
            <input class="form-control mr-sm-2 bgc-gray" type="search" placeholder="請輸入關鍵字" aria-label="Search">
            <button class="btn bgc-green color-white mr-2 mr-sm-4 my-2 search-submit" type="submit">搜索</button>
            <button type="button" class="btn bgc-white border-1-green ">進階搜尋</button>
        </form>
    </div>
    <div class="d-flex align-items-center my-md-3 add-new-wrap">
        <button type="button" class="btn bgc-green  px-lg-5 color-white font-weight-bold add-new">新增路線</button>
    </div>
</div>


<div class="w-100 d-flex my-sm-3 setting-wrap position-relative">
    <select name="" id="" class="form-control border-1-green fa order">
        <option value=0 class="fa-caret-down">按新增時間 &#xf0d7;</option>
        <option value=1 class="fa">按新增時間 &#xf0d8;</option>
    </select>
    <div class="pagination-wrap d-flex">
        <p class="text-left mb-0 mr-3">第1頁/共3頁</p>
        <ul class="pagination justify-content-center mr-5 mb-0">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1"><i class="fas fa-caret-left"></i></a>
            </li>
            <li class="page-item"><a class="page-link" href="#">10</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#"><i class="fas fa-caret-right"></i></a>
            </li>
        </ul>
    </div>
    <select name="" id="" class="form-control border-1-red perPage">
        <option value="">每頁顯示10條路線</option>
        <option value="">每頁顯示5條路線</option>
        <option value="">每頁顯示15條路線</option>
        <option value="">每頁顯示20條路線</option>
    </select>  -->
</div>

<div class="where-you-put-everything">


</div>
</div>




<div class="container">

    <form name="form2" class="mt-1" id="form2" method="post" onsubmit="return search()">
    <!-- <h2 class="pageNameRight t-0 py-3 w-100 my-3" >路線管理</h2> -->
      <div class="form-group col-12 d-flex mx-auto">
        <input type="text" class="form-control m-0" id="e_search" name="e_search"  placeholder="請輸入地點、日期、時間" value="">
        <button type="submit" class="btn bgc-green color-white d-flex " >搜尋</button>
        
      </div>

        <select class="btn pages_present mx-auto  my-3 border-1-red" >
            <option value="5"> 每頁5筆資料</option>
            <option value="10">每頁10筆資料</option>
            <option value="15">每頁15筆資料</option>
        </select>

       <button class="btn bgc-green color-white "> <a href="event_new_insert.php" class="color-white">新增活動</a></button>
       <button class="btn bgc-green color-white"> <a href="event_list2.php" class="color-white">成員列表</a></button>
       <button class="btn bgc-green color-white "> <a href="event_insert2.php" class="color-white">報名活動</a></button>

       
    </form>
  

</div>
   

    <div class="row">
            <table class="table table table-bordered border-3">
            
                <thead class="border-3">
                <tr class="text-center vertical-align: middle; border-3">

                    <!-- <th scope="col">排序
                        <div id="sort">
                           <i class="fas fa-sort-up" style="display:none"></i>
                           <i class="fas fa-sort-down" style="display:block"></i>
                        </div>
                    </th> -->
                    <th scope="col">#</th>
                    <th class="border-3" scope="col">活動名稱</th>
                    <th class="border-3" scope="col">主辦人</th>
                    <th class="border-3" scope="col">出發地</th>
                    <th class="border-3" scope="col">目的地</th>
                    <th class="border-3" scope="col">日期</th>
                    <th class="border-3" scope="col">結束時間</th>
                    <th class="border-3" scope="col">中途停靠點</th>
                    <th class="border-3" scope="col">目前人數</th>
                    <th class="border-3" scope="col">照片</th>
                    <!-- <th scope="col">報名</th> -->
                    <th class="border-3" scope="col"><i class="fas fa-edit"></i></th>
                    <th class="border-3" scope="col"><i class="fas fa-trash-alt"></i></th>
                </tr>
                </thead>
                <tbody id="data_body">
                </tbody>
            </table>
        
    </div>

    <!-- <div class="row">
        <div class="col-lg-12">
            <nav>
                <ul class="pagination pagination-sm d-flex justify-content-center">
                </ul>
            </nav>
        </div>
    </div> -->
    <div class="pagination-wrap d-flex mx-auto">
                    <p class="text-left mb-0 mr-3"></p>
                    <ul class="pagination justify-content-center mr-5 mb-0 mx-auto">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1"><i class="fas fa-caret-left"></i></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">10</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="fas fa-caret-right"></i></a>
                        </li>
                    </ul>
                </div>


   
    <script>

    // var sortway = "DESC";
    // var switcher = 0;
    // let sort = document.querySelector('#sort');
    // sort.onclick = function() {
    //     var tag = sort.querySelectorAll('i');
    //     // console.log(tag);
    //     switcher = switcher == 0 ? 1 : 0;
    //     console.log(switcher);
    //     for (var i = 0; i < tag.length; i++) {
    //         if (switcher == 0) {
    //             tag[0].style.display = 'none';
    //             tag[1].style.display = 'block';
    //             sortway = "DESC";
    //         } else {
    //             tag[1].style.display = 'none';
    //             tag[0].style.display = 'block';
    //             sortway = "ASC";
    //         }
    //     }
    //     console.log(sortway);
    //     myHashChange();
    // }
    // if(location.hash.slice(location.hash.indexOf("sortway") +8,location.hash.indexOf("sortway") +11)=="ASC"){
    //     sortway = "ASC";
    // }

        // let card =document.querySelector('#card_area');

        let pages_present = document.querySelector('.pages_present');

        for (var i = 0; i < pages_present.length; i++) {
        if (pages_present[i].value == location.hash.slice(location.hash.indexOf("perPage") + 8)) {
            console.log("for");
            pages_present[i].selected = true;
            console.log(pages_present[i].selected);
        }
        }
    //宣告變數:下拉式選單裡面的值
        let perPage = pages_present.value;
        var num_pagi = "";
    //宣告變數:當前頁面
        var page_act = "";
   


        function delete_it(e_sid) {
        swal({
                title: "確定要刪除活動嗎?",
                text: "刪除將無法復原",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("已經成功刪除活動!", {
                        icon: "success",
                    }).then((info) => {
                        location.href = 'event_delete.php?e_sid='+e_sid;;
                    });
                } else {
                    swal("未更動資料");
                }
            });
        }


        // function delete_it(e_sid){
        // if(confirm(`確定要刪除編號為 ${e_sid} 的資料嗎?`)){
        //     location.href = 'event_delete.php?e_sid='+e_sid;
        //     }
        // }


        let page = 1;
        let ori_data;
        const ul_pagi = document.querySelector('.pagination');
        const data_body = document.querySelector('#data_body');

        const tr_str = `<tr>
                        <td class="ccc" style="vertical-align: middle"><%= e_sid %></td>
                        <td class="ccc" style="vertical-align: middle"><%= e_name %></td>
                        <td class="ccc" style="vertical-align: middle"><%= e_leader %></td>
                        <td class="ccc" style="vertical-align: middle"><%= e_depart %></td>
                        <td class="ccc" style="vertical-align: middle"><%= e_arrive %></td>
                        <td class="ccc" style="vertical-align: middle"><%= e_date %></td>
                        <td class="ccc" style="vertical-align: middle"><%= e_endTime %></td>
                        <td class="ccc" style="vertical-align: middle"><%= e_via %></td>
                        <td class="ccc" style="vertical-align: middle"><%= e_current %></td>
                        <td class="ccc" style="vertical-align: middle">
                        <a data-fancybox data-caption="<%=e_name%>" href="./uploads/<%= e_pic%>"><img src="./uploads/<%= e_pic%>" style="height: 100px ; max-width:100%;background-size:cover" alt=""></a>
                        </td>
                        <td class="ccc" style="vertical-align: middle">
                        <a href="event_edit.php?e_sid=<%= e_sid %>"><i class="fas fa-edit color-green"></i></a>
                        </td>
                        <td class="ccc" style="vertical-align: middle">
                        <a href="javascript: delete_it(<%= e_sid %>)"><i class="fas fa-trash-alt text-danger"></i></a>
                        </td>
                       
                        
                    </tr>`;
        const tr_func = _.template(tr_str);

        const pagi_str = `<li class="page-item <%= active %>">
                        <a class="page-link border-light" href="#<%= page %>"><%= page %></a>
                        </li>`;
        const pagi_func = _.template(pagi_str);



        const mySelChange = () => {
        perPage = pages_present.value;
        console.log(perPage);
        myHashChange();
        }

        const myHashChange = ()=>{
            let h = location.hash.slice(1);
            page = parseInt(h);
            if(isNaN(page)){
                page = 1;
            }

            fetch('event_list_api.php?page=' + page + '&perPage=' + perPage)
                .then(res=>res.json())
                .then(json=>{
                    ori_data = json;
                    console.log(ori_data);

                   
                    let str = '';
                    for(let v of ori_data.data){
                        str += tr_func(v);
                    }
                    data_body.innerHTML = str;

                    str = '';
                    for(let i=1; i<=ori_data.totalPages; i++){
                        let active = ori_data.page === i ? 'active' : '';

                        str += pagi_func({
                            active: active,
                            page: i
                        });
                    }
                    ul_pagi.innerHTML = str;




                num_pagi = document.querySelectorAll('.page-num');
                page_act = ul_pagi.querySelector('.active');
                num_pagi
                for (var v = 0; v < num_pagi.length; v++) {
                    if (parseInt(page_act.innerText) + 3 < parseInt(num_pagi[v].innerText)) {
                        num_pagi[v].style.display = "none";
                    }
                    if (parseInt(page_act.innerText) - 3 > parseInt(num_pagi[v].innerText)) {
                        num_pagi[v].style.display = "none";
                    }
                }

                });
        };

    function search(){
    let form = new FormData(document.form2);
    console.log(form);

    fetch('event_search_api.php', {
            method: 'POST',
            body: form
        })
        .then(res=>{
            console.log(res);
            return res.json();
        })
        .then(json=>{
            ori_data = json;
            console.log(ori_data);

            let str = '';

            for(let s in ori_data.data){
                str += tr_func(ori_data.data[s]);
            }
            data_body.innerHTML = str;

        });

            return false;
    }

        window.addEventListener('hashchange', myHashChange);
        pages_present.addEventListener('change', mySelChange);
        myHashChange();
        
    </script>

<?php include __DIR__. '/__html_foot.php';  ?>
<?php
require __DIR__ . '/__connect_db.php';
$page_name = 'data_list'
?>

<?php include __DIR__ . '/__html_head.php';  ?>
<?php include __DIR__.'/../sidebar/__nav.php'; ?>
<style>
    .card-img {
        /* height:100%; */
    }

    .card {
        background: #f9f9f9;
        border: none;
    }

    .page-link {
        color: #a7a8bd;
    }

    .page-item.active .page-link {
        z-index: 1;
        color: #fff;
        background-color: #2addc7;
        border-color: #2addc7;
    }

    table tbody img {
        width: 100px !important;
        height: 100px;
    }
</style>

<div class="row py-3 d-flex flex-column main-content">

    <div class="w-100 d-flex justify-content-between mb-3 align-items-end sub-wrap1">
        <div class="d-flex align-items-end">
            <div class="d-flex flex-column title-big">
                <div class="title-img">
                    <div><img src="resources/images/member-page-title.svg" alt="Route Management"></div>
                </div>
                <h2 class="pageNameRight t-0 mb-3">會員管理</h2>
            </div>

            <div class="searchbar form-inline my-sm-2 d-flex justify-content-around">
                <select name="sel_city" id="sel_city" class=" bgc-white border-1-green btn">
                    <option value="">選擇城市</option>
                    <option value="基隆市">基隆市</option>
                    <option value="台北市">臺北市</option>
                    <option value="新北市">新北市</option>
                    <option value="宜蘭縣">宜蘭縣</option>
                    <option value="新竹市">新竹市</option>
                    <option value="新竹縣">新竹縣</option>
                    <option value="桃園市">桃園市</option>
                    <option value="苗栗縣">苗栗縣</option>
                    <option value="臺中市">臺中市</option>
                    <option value="彰化縣">彰化縣</option>
                    <option value="南投縣">南投縣</option>
                    <option value="嘉義市">嘉義市</option>
                    <option value="嘉義縣">嘉義縣</option>
                    <option value="雲林縣">雲林縣</option>
                    <option value="臺南市">臺南市</option>
                    <option value="高雄市">高雄市</option>
                    <option value="屏東縣">屏東縣</option>
                    <option value="臺東縣">臺東縣</option>
                    <option value="花蓮縣">花蓮縣</option>
                    <option value="金門縣">金門縣</option>
                    <option value="連江縣">連江縣</option>
                    <option value="澎湖縣">澎湖縣</option>
                </select>

                <input class="form-control mr-sm-2 ml-2 bgc-gray" id="m_search" name="m_search" type="search" value="" placeholder="請輸入關鍵字" aria-label="Search">
                <button class="btn bgc-green color-white mr-2 mr-sm-4 my-2 search-submit search_btn" type="submit">搜索</button>
                <!-- <button type="button" class="btn bgc-white border-1-green ">進階搜尋</button> -->
            </div>
        </div>
        <div class="d-flex align-items-center my-md-3 add-new-wrap">
            <button type="button" class="btn bgc-green  px-lg-5 color-white font-weight-bold add-new" style="display:none;">新增路線</button>
        </div>
    </div>


    <div class="w-100 d-flex my-sm-3 setting-wrap position-relative">
        <select name="" id="" class="form-control border-1-green fa order">
            <option value=0 class="fa-caret-down">按新增時間 &#xf0d7;</option>
            <option value=1 class="fa">按新增時間 &#xf0d8;</option>
        </select>
        <div class="pagination-wrap d-flex">
            <!-- <p class="text-left mb-0 mr-3">第1頁/共3頁</p> -->
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
        </select>
    </div>

    <div class="where-you-put-everything">
        <div class="container-fluid">


            <div class="row">
                <!-- <div class="col-lg-10 mx-auto"> -->


                    <!-- <div class="col-7 mx-auto d-flex mt-4 justify-content-around">
                        <select name="sel_city" id="sel_city" class="col-2 bgc-white border-1-green btn">
                            <option value="">選擇城市</option>
                            <option value="基隆市">基隆市</option>
                            <option value="台北市">臺北市</option>
                            <option value="新北市">新北市</option>
                            <option value="宜蘭縣">宜蘭縣</option>
                            <option value="新竹市">新竹市</option>
                            <option value="新竹縣">新竹縣</option>
                            <option value="桃園市">桃園市</option>
                            <option value="苗栗縣">苗栗縣</option>
                            <option value="臺中市">臺中市</option>
                            <option value="彰化縣">彰化縣</option>
                            <option value="南投縣">南投縣</option>
                            <option value="嘉義市">嘉義市</option>
                            <option value="嘉義縣">嘉義縣</option>
                            <option value="雲林縣">雲林縣</option>
                            <option value="臺南市">臺南市</option>
                            <option value="高雄市">高雄市</option>
                            <option value="屏東縣">屏東縣</option>
                            <option value="臺東縣">臺東縣</option>
                            <option value="花蓮縣">花蓮縣</option>
                            <option value="金門縣">金門縣</option>
                            <option value="連江縣">連江縣</option>
                            <option value="澎湖縣">澎湖縣</option>
                        </select>
 -->


                        <!-- <input type="text" class="form-control col-8 mx-auto bgc-gray" id="m_search" name="m_search" placeholder="請輸入關鍵字" value=""> -->

                        <!-- <input class="form-control mr-sm-2 bgc-gray" type="search" placeholder="請輸入關鍵字" aria-label="Search"> -->






                        <!-- <button type="submit" class="btn d-flex mx-auto  search_btn bgc-green color-white">搜索</button> -->
                        <!-- <button class="btn bgc-green color-white mr-2 mr-sm-4 my-2 search-submit" type="submit">搜索</button> -->



                    <!-- </div> -->


                    <select class="pages_present mx-auto d-block mt-2 mb-4">

                        <option value="20">每頁20筆資料</option>
                        <option value="40">每頁40筆資料</option>
                        <option value="60">每頁60筆資料</option>

                    </select>

                </div>
            </div>

            <div class="row">
                <div class="col-lg-10 mx-auto">

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">個人圖片</th>

                                <th scope="col">排序
                                    <div id="sort">
                                        <i class="fas fa-sort-up" style="display:none"></i>
                                        <i class="fas fa-sort-down" style="display:block"></i>
                                    </div>
                                </th>
                                <th scope="col">姓名</th>
                                <th scope="col">手機</th>
                                <th scope="col">EMAIL</th>
                                <th scope="col">地址</th>

                                <th scope="col">帳號狀態</th>
                                <th scope="col">修改</th>
                                <th scope="col">評價</th>
                                <th scope="col">刪除帳號</th>
                            </tr>
                        </thead>
                        <tbody id="table_body">
                            <?php


                            ?>

                        </tbody>
                    </table>

                </div>

            </div>

            <div class="row">
                <div class="col-lg-12">
                    <ul class="pagination pagination-sm justify-content-center"><?php













                                                                                ?>


                    </ul>
                </div>
            </div>

        </div>





        <script>
            let page = 1;
            let ul_pagi = document.querySelector('.pagination');

            let sel_city = document.querySelector('#sel_city');


            let searchbar = document.querySelector('#m_search');
            let search_btn = document.querySelector('.search_btn');

            let pages_present = document.querySelector('.pages_present');
            const data_body = document.querySelector('#data_body');
            let tbody = document.querySelector('#table_body');



            var sortway = "DESC"

            var switcher = 0;
            let sort = document.querySelector('#sort');

            sort.onclick = function() {
                var tag = sort.querySelectorAll('i');
                console.log(tag);

                switcher = switcher == 0 ? 1 : 0;
                console.log(switcher);

                for (var i = 0; i < tag.length; i++) {
                    if (switcher == 0) {
                        tag[0].style.display = 'none';
                        tag[1].style.display = 'block';
                        sortway = "DESC";
                    } else {
                        tag[1].style.display = 'none';
                        tag[0].style.display = 'block';
                        sortway = "ASC";
                    }
                }
                console.log(sortway);
                myHashChange();
            }

            if (location.hash.slice(location.hash.indexOf("sortway") + 8, location.hash.indexOf("sortway") + 11) == "ASC") {
                sortway = "ASC";
            }


            const tr_str = `
                     <tr>
                     <td><img src="<%= m_photo ==''?'https://images2.imgbox.com/b0/c3/sQxunS2i_o.png':m_photo %>" class="card-img" alt="..."> </td>

                       

                        <td><%= m_sid %></td>
                        <td><%= m_name %></td>
                        <td><%= m_mobile %></td>
                        <td><%= m_email %></td>
                        <td><%= m_city %> <%= m_town %> <%= m_address %></td>
                      

                        <td><span>帳號狀態:<a href="javascript: switch_it(<%= m_sid %>)" class="text-warning"> <%=m_active =="正常" ?'<i class="fas fa-check"></i>':'<i class="fas fa-ban"></i>停權' %> </a></td>

                        <td>
                            <a href="data_editFOR0408.php?sid=<%= m_sid %>"><i class="fas fa-edit"></i></a>
                        </td>
                      
                        <td><%= m_score %></td>

                        <td><a href="javascript: delete_it(<%= m_sid  %>)" class="text-danger"><i class="fas fa-trash-alt"></i></a></td>

                      
                      
                    </tr>
  `



            const tr_func = _.template(tr_str);
            //underscore語法
            const pagi_str = ` 
                    <li class="btn-light page-num page-item <%= active %>">
                    <a class=" page-link " href="#<%= page %>"> <%= page %> </a>
                    </li>`;

            const pagi_func = _.template(pagi_str);
            //underscore語法




            for (var i = 0; i < pages_present.length; i++) {
                if (pages_present[i].value == location.hash.slice(location.hash.indexOf("perPage") + 8, location.hash.indexOf("perPage") + 10)) {
                    pages_present[i].selected = true;
                    console.log(pages_present[i].selected);
                }
            };

            for (var i = 0; i < sel_city.length; i++) {
                if (sel_city[i].value == decodeURIComponent(location.hash.slice(location.hash.indexOf("city") + 5, location.hash.indexOf("city") + 32))) {
                    sel_city[i].selected = true;
                    console.log(sel_city[i].selected);

                }
            };







            //宣告變數:下拉式選單裡面的值
            let perPage = pages_present.value;

            let city = sel_city.value


            let keyword = searchbar.value;



            if (location.hash.indexOf("keyword") !== -1) {
                searchbar.value = decodeURIComponent(location.hash.slice(location.hash.indexOf("keyword") + 8))
            }



            //宣告變數:拿到所有頁數
            var num_pagi = "";
            //宣告變數:當前頁面
            var page_act = "";


            //變更每頁筆數      
            const mySelChange = () => {
                perPage = pages_present.value;
                console.log(perPage);
                myHashChange();

            }

            function selCity() {
                city = sel_city.value;
                console.log(city);
            }

            const myHashChange = () => {
                city = sel_city.value;

                keyword = searchbar.value;

                let h = location.hash.slice(1);
                page = parseInt(h);

                if (isNaN(page)) {
                    page = 1;
                }

                // ul_pagi.innerHTML+= page;

                fetch('data_list_api2.php?page=' + page + '&perPage=' + perPage + '&city=' + city + '&keyword=' + keyword + '&sortway=' + sortway)
                    .then(res => {
                        console.log(res);
                        return res.json();
                    })
                    .then(json => {
                        ori_data = json;
                        console.log(ori_data);

                        let str = '';

                        for (let s in ori_data.data) {
                            str += tr_func(ori_data.data[s]);
                        }
                        tbody.innerHTML = str;


                        str = '';
                        for (let i = 1; i <= ori_data.totalPages; i++) {
                            let active = ori_data.page === i ? 'active' : '';

                            str += pagi_func({
                                active: active,
                                page: i
                            });

                        }


                        str = `<li class="page-item ${ori_data.page==1 ? 'disabled' : ''}">
                            <a class="page-link" href="#${ori_data.page-1}">&lt;</a>
                        </li>` + str;

                        str = `<li class="page-item ${ori_data.page==1 ? 'disabled' : '' }">
                            <a class="page-link" href="#1"><i class="fas fa-angle-double-left"></i></a>
                        </li>` + str;

                        str += `<li class="page-item ${ori_data.page==ori_data.totalPages ? 'disabled' : ''} ">
                            <a class="page-link" href="#${ori_data.page+1}">&gt;</a>
                            </li>`;

                        str += `<li class="page-item ${ori_data.page==ori_data.totalPages ? 'disabled' : '' }">
                        <a class="page-link" href="#${ori_data.totalPages}"><i class="fas fa-angle-double-right"></i></a>
                        </li>`;
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





            // function search(){
            //   let form = new FormData(document.form1);
            //   console.log(form);

            //   fetch('data_search_api.php', {
            //                 method: 'POST',
            //                 body: form
            //             })
            //             .then(res=>{
            //                 console.log(res);
            //                 return res.json();
            //             })
            //             .then(json=>{
            //                 ori_data = json;
            //                 console.log(ori_data);

            //                 let str = '';

            //                 for(let s in ori_data.data){
            //                     str += tr_func(ori_data.data[s]);
            //                 }
            //                 tbody.innerHTML = str;


            //                 str = '';
            //                 for(let i=1; i<=ori_data.totalPages; i++){
            //                     let active = ori_data.page === i ? 'active' : '';

            //                     str += pagi_func({
            //                         active: active,
            //                         page: i
            //                     });
            //                 }
            //                 str=`<li class="page-item ${ori_data.page}=1 ? 'disabled' : '' ?>">
            //                         <a class="page-link" href="?page=#${ori_data.page-1}">&lt;</a>
            //                     </li>`+str;

            //                 str+=`<li class="page-item ${ori_data.page}=ori_data.totalPages ? 'disabled' : '' ?>">
            //                         <a class="page-link" href="?page=#${ori_data.page+1}">&gt;</a>
            //                         </li>`;
            //                 ul_pagi.innerHTML = str;

            //             });

            //             return false;
            // }





            //   事件監聽
            window.addEventListener('hashchange', myHashChange); //切換hash

            pages_present.addEventListener('change', mySelChange); //下拉式選單

            sel_city.addEventListener('change', selCity);

            search_btn.addEventListener('click', myHashChange);

            myHashChange();

            // for(var i=0;i< pages_present.length;i++){
            //    pages_present[i].selected;
            // }

            function switch_it(sid) {
                location.href = 'data_switch.php?sid=' + sid + '&page=' + page + '&perPage=' + perPage + '&city=' + city + '&sortway=' + sortway + '&keyword=' + keyword;
                myHashChange();
            }

            function score_it(sid) {
                // location.href =;
            }


            function delete_it(sid) {
                swal({
                        title: "確定要刪除該會員資料嗎?",
                        text: "一旦刪除資料將無法復原!!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            swal("已經成功刪除該會員資料!", {
                                icon: "success",

                            }).then((info) => {
                                location.href = 'data_delete.php?sid=' + sid + '&page=' + page + '&perPage=' + perPage + '&city=' + city + '&sortway=' + sortway + '&keyword=' + keyword;
                            });

                        } else {
                            swal("會員資料完整保留");
                        }
                    });
            }
        </script>


        <?php include __DIR__ . '/__html_foot.php';  ?>
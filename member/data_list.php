<?php
require __DIR__ . '/__connect_db.php';
$page_name = 'data_list'
?>

<?php include __DIR__ . '/__html_head.php';  ?>
<?php include __DIR__ . '/__navbar.php';  ?>
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
        background-color: #5d3d21;
        border-color: #007bff;
    }

    table tbody img {
        width: 100px !important;
        height: 100px;
    }
</style>
<div class="container-fluid">


    <div class="row">
        <div class="col-lg-10 mx-auto">


            <div class="col-6 mx-auto">
                <input type="text" class="form-control" id="m_search" name="m_search" placeholder="搜尋" value="">

            </div>

            <button type="submit" class="btn d-flex mx-auto btn-outline-info search_btn">搜尋</button>





            <select class="pages_present mx-auto d-block my-3">

                <option value="5"> 每頁5筆資料</option>
                <option value="10">每頁10筆資料</option>
                <option value="15">每頁15筆資料</option>

            </select>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 mx-auto">

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">修改</th>
                        <th scope="col">#</th>
                        <th scope="col">姓名</th>
                        <th scope="col">手機</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">地址</th>
                        <th scope="col">個人圖片</th>
                        <th scope="col">帳號狀態</th>
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
    let searchbar = document.querySelector('#m_search');
    let search_btn = document.querySelector('.search_btn');
    let pages_present = document.querySelector('.pages_present');
    const data_body = document.querySelector('#data_body');
    let tbody = document.querySelector('#table_body');

    console.log(pages_present.length)


    const tr_str = `
                     <tr>
                        <td>
                            <a href="data_edit.php?sid=<%= m_sid %>"><i class="fas fa-edit"></i></a>
                        </td>

                        <td><%= m_sid %></td>
                        <td><%= m_name %></td>
                        <td><%= m_mobile %></td>
                        <td><%= m_email %></td>
                        <td><%= m_city %> <%= m_town %> <%= m_address %></td>
                        <td><img src="<%= m_photo ==''?'https://images2.imgbox.com/b0/c3/sQxunS2i_o.png':m_photo %>" class="card-img" alt="..."> </td>

                        <td><span>帳號狀態:<a href="javascript: switch_it(<%= m_sid %>)" class="text-warning"> <%=m_active ==0 ?'<i class="fas fa-check"></i>':'<i class="fas fa-ban"></i>' %> </a></td>
                      
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
        if (pages_present[i].value == location.hash.slice(location.hash.indexOf("perPage") + 8)) {
            console.log("for");
            pages_present[i].selected = true;
            console.log(pages_present[i].selected);
        }
    }

    //宣告變數:下拉式選單裡面的值
    let perPage = pages_present.value;


    let keyword = searchbar.value;

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

    const searchNow = () => {
        keyword = searchbar.value;
        // mySelChange();
        myHashChange();

    }

    const myHashChange = () => {
        keyword = searchbar.value;
        let h = location.hash.slice(1);
        page = parseInt(h);

        if (isNaN(page)) {
            page = 1;
        }

       

        // ul_pagi.innerHTML+= page;

        fetch('data_list_api.php?page=' + page + '&perPage=' + perPage + '&keyword=' + keyword)
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

    search_btn.addEventListener('click', myHashChange);

    myHashChange();

    // for(var i=0;i< pages_present.length;i++){
    //    pages_present[i].selected;
    // }

    function switch_it(sid) {
        location.href = 'data_switch.php?sid=' + sid + "&page=" + page + "&perPage=" + perPage;
    }

    function score_it(sid) {
        // location.href =;
    }

    function delete_it(sid) {
        if (confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)) {
            location.href = 'data_delete.php?sid=' + sid + "&page=" + page + "&perPage=" + perPage;
        }
    }
</script>


<?php include __DIR__ . '/__html_foot.php';  ?> 
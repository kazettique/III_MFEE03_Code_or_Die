<?php
// 摘要：資料顯示頁面

$page_name = 'data_list';
?>
<?php include __DIR__ . '/__html_head.php'; ?>
<!-- 暫用navbar(自製) -->
<?php //include __DIR__ . '/__navBar.php'; ?>
<!-- 共用navbar -->
<?php include __DIR__.'/../sidebar/__nav.php'; ?>

    <link rel="stylesheet" href="stylesheet/myStylesheet.css">
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/datatables.min.css"/>
    <div class="container mt-5 pt-3">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div class="col-lg-10 d-flex">
                    <!-- 頁碼顯示&控制列 -->
                    <div class="pagination pagination-sm my-lg-3 pt-1"></div>
                    <div class="my-lg-3 pt-1 ml-lg-3 d-flex">
                        <p class="mx-lg-2 pt-1">跳轉到</p>
                        <input type="number" class="form-control col-3">
                    </div>
                    <!--
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">xxxx</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    -->
                    <!-- 一頁多少筆資料選擇器 -->
                    <select class="form-control col-lg-3 my-lg-3">
                        <option value="5">每頁5筆資料</option>
                        <option value="10">每頁10筆資料</option>
                        <option value="15">每頁15筆資料</option>
                    </select>
                </div>
                <div class="col-lg-2 d-flex justify-content-end">
                    <a href="data_insert.php" class="btn btn-dark mt-3 mb-4">
                        <i class="fas fa-plus mr-2"></i>新增資料
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">課程名稱</th>
                        <th scope="col">教練名稱</th>
                        <th scope="col">課程簡介</th>
                        <th scope="col" class="col-3">照片</th>
                        <th scope="col">目前集資金額</th>
                        <th scope="col">目標集資金額</th>
                        <th scope="col">建立日期</th>
                        <th scope="col">開始日期</th>
                        <th scope="col">截止日期</th>
                        <th scope="col">操作</th>
                    </tr>
                    </thead>
                    <tbody id="data_body"></tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        // page不一定要設定為1
        let page = 1;
        let ori_data;
        const ul_pagi = document.querySelector('.pagination');
        const data_body = document.querySelector('#data_body');

        // template: 顯示的資料欄位之通用格式
        // 使用underscore套件之"<%= %>"標籤
        // "<%= %>"中的變數會抓取資料表的欄位名稱
        // <tr> string:
        const tr_string = `<tr>
                            <th class="c_sid"><%= c_sid %></th>
                            <th class="c_name"><%= c_name %></th>
                            <th class="c_instructor"><%= c_instructor %></th>
                            <th class="c_intro"><%= c_intro %></th>
                            <th class="c_photo">
                                <a href="./upload_img/<%= c_photo %>" data-fancybox="" data-caption="<%= c_photo %>">
                                    <img class="listPhoto" id="uploadPhoto" src="./upload_img/<%= c_photo %>">
                                </a>
                            </th>
                            <th class="c_fundNow"><%= c_fundNow %></th>
                            <th class="c_fundGoal"><%= c_fundGoal %></th>
                            <th class="c_createDate"><%= c_createDate %></th>
                            <th class="c_startDate"><%= c_startDate %></th>
                            <th class="c_endDate"><%= c_endDate %></th>
                            <th>
                                <a href="data_edit.php?sid=<%= c_sid %>">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript: delete_it(<%= c_sid %>)">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </th>
                        </tr>`;

        // 資料列'<tr>'的樣板(template)
        // using underscore.js
        const tr_template = _.template(tr_string);
        // pagination string:
        // const pagi_string = `<li class="page-item <%= active %>">
        //                       <a class="page-link" href="#<%= page %>">
        //                           <%= page %>
        //                       </a>
        //                   </li>`;
        // 頁碼的樣板(template)
        // const pagi_template = _.template(pagi_string);

        function pageRenderHelper(tag_style, page_num, page_symbol) {
            let page_list_content = `<li class="page-item ${tag_style} ">
                                         <a class="page-link" href="?page=#${page_num}">${page_symbol}</a>
                                     </li>`;
            return page_list_content;
        }

        const myHashChange = () => {
            let h = location.hash.slice(1);
            page = parseInt(h);
            if (isNaN(page)) page = 1;

            fetch('data_list_api.php?page=' + page)
                .then(res => {
                    return res.json();
                })
                .then(json => {
                    ori_data = json;
                    // TODO: 變數簡化,先賦值,再處理
                    let html_context = '';
                    let currentPage = ori_data.page;
                    // for ( ... of ... ): gets VALUE from the array.
                    // ori_data.data: 塞資料
                    for (let val of ori_data.data) {
                        html_context += tr_template(val);
                    }
                    data_body.innerHTML = html_context;
                    html_context = '';
                    for (let i = 1; i <= ori_data.totalPages; i++) {

                        let active = page === i ? 'active' : '';
                        html_context += pageRenderHelper(active, i, i);
                        // html_context += pagi_template({
                        //     active: active,
                        //     page: i
                        // });
                    }
                    // 第一頁、上一頁的箭頭符號及樣式
                    let prevPage = currentPage <= 1 ? 'disabled' : '';
                    let nextPage = currentPage >= ori_data.totalPages ? 'disabled' : '';

                    let middle_page_list = html_context;
                    // let pre_page_list = `<li class="page-item ${prevPage} ">
                    //                          <a class="page-link" href="?page=#1">&laquo;</a>
                    //                      </li>
                    //                      <li class="page-item ${prevPage}">
                    //                          <a class="page-link" href="?page=#${currentPage - 1}">&lt;</a>
                    //                      </li>`;
                    let pre_page_list = pageRenderHelper(prevPage, 1, '&laquo') + pageRenderHelper(prevPage, currentPage - 1, '&lt;');
                    // let next_page_list = `<li class="page-item ${nextPage}">
                    //                           <a class="page-link" href="?page=#${currentPage + 1}">&gt;</a>
                    //                       </li>
                    //                       <li id="lastPage" class="page-item ${nextPage}">
                    //                           <a class="page-link" href="?page=#${ori_data.totalPages}"">&raquo;</a>
                    //                       </li>`;
                    let next_page_list = pageRenderHelper(nextPage, currentPage + 1, '&gt;') + pageRenderHelper(nextPage, ori_data.totalPages, '&raquo');

                    let final_page_list = `${pre_page_list}${middle_page_list}${next_page_list}`;
                    ul_pagi.innerHTML = final_page_list;
                });
        };

        window.addEventListener('hashchange', myHashChange);
        myHashChange();

        // 確認刪除訊息
        function delete_it(sid) {
            console.log(sid);
            if (confirm(`確定要刪除編號 #${sid} 的資料嗎?`)) {
                location.href = 'data_delete.php?sid=' + sid;
            }
        }

    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/datatables.min.js"></script>

<?php include __DIR__ . '/__html_foot.php'; ?>
<?php
    require __DIR__. '/__connect_db.php';
    $page_name = 'event_list2';

?>
<?php include __DIR__. '/__html_head.php';  ?>
<?php include __DIR__.'/../_navbar.php'; ?>


<div class="container">
    
<button class="btn bgc-green text-align:right;"> <a href="event_list.php" class="color-white">回到活動列表</a></button>
    <div class="row">
    
        <div class="col-lg-12">

        

            <table class="table table table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">活動SID</th>
                    <th scope="col">姓名</th>
                    <th scope="col">電話</th>
                    <th scope="col"><i class="fas fa-edit"></i></th>
                    <th scope="col"><i class="fas fa-trash-alt"></i></th>
                </tr>
                </thead>
                <tbody id="data_body">
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <nav>
                <ul class="pagination pagination-sm d-flex justify-content-center">
                </ul>
            </nav>
        </div>
    </div>

</div>
    <script>

    function delete_it(s_sid) {
        swal({
                title: "確定要刪除報名資料嗎?",
                text: "刪除將無法復原",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("已經成功刪除報名資料!", {
                        icon: "success",
                    }).then((info) => {
                        location.href = 'event_delete2.php?s_sid='+s_sid;;
                    });
                } else {
                    swal("未更動資料");
                }
            });
        }
        // function delete_it(s_sid){
        // if(confirm(`確定要刪除編號為 ${s_sid} 的資料嗎?`)){
        //     location.href = 'event_delete2.php?s_sid='+s_sid;
        //     }
        // }
        let page = 1;
        let ori_data;
        const ul_pagi = document.querySelector('.pagination');
        const data_body = document.querySelector('#data_body');

        const tr_str = `<tr>
                        <td><%= s_sid %></td>
                        <td><%= e_sid %></td>
                        <td><%= s_name %></td>
                        <td><%= s_phone %></td>
                        <td>
                        <a href="event_edit2.php?s_sid=<%= s_sid %>"><i class="fas fa-edit color-green"></i></a>
                        </td>
                        <td>
                        <a href="javascript: delete_it(<%= s_sid %>)"><i class="fas fa-trash-alt text-danger"></i></a>
                        </td>
                        
                    </tr>`;
        const tr_func = _.template(tr_str);

        const pagi_str = `<li class="page-item <%= active %>">
                        <a class="page-link text-white bg-dark border-light" href="#<%= page %>"><%= page %></a>
                        </li>`;
        const pagi_func = _.template(pagi_str);


        const myHashChange = ()=>{
            let h = location.hash.slice(1);
            page = parseInt(h);
            if(isNaN(page)){
                page = 1;
            }

            fetch('event_list2_api.php?page=' + page)
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

                });
        };

        window.addEventListener('hashchange', myHashChange);
        myHashChange();
    </script>
<?php include __DIR__. '/__html_foot.php';  ?>
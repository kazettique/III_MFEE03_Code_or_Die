<?php
    require __DIR__.'./p__connect.php';
   
?>

<?php include __DIR__."/p__html_head.php"; ?>

<?php include __DIR__.'/../sidebar/__nav.php'; ?>

            <div class="row py-3 d-flex flex-column main-content">

<div class="w-100 d-flex justify-content-between mb-3 align-items-end sub-wrap1">
    <div class="d-flex align-items-end">
        <div class="d-flex flex-column title-big">
            <div class="title-img"><div><img src="resources/images/product-page-title.svg" alt="Route Management" ></div></div>
            <h2 class="pageNameRight t-0 mb-3" >商品管理</h2> 
        </div>
    
        <form class="searchbar form-inline my-sm-2 ">
            <input class="form-control mr-sm-2 bgc-gray" type="search" placeholder="請輸入關鍵字" aria-label="Search" name="search" id="search">
            <button class="btn bgc-green color-white mr-2 mr-sm-4 my-2 search-submit search_btn" type="submit">搜索</button>
            <label for="type" class="p-1" style="font-weight: 900;color:#000">部件分類</label>
                <select id="sel_genre2" name="sel_genre2" class="form-control bgc-white border-1-green">
                                        <option selected value="">全部搜尋</option>
                                        <option value="全車">全車</option>
                                        <option value="車架">車架</option>
                                        <option value="握把.龍頭">握把.龍頭</option>
                                        <option value="坐墊.坐管">坐墊.坐管</option>
                                        <option value="齒盤/曲柄">齒盤/曲柄</option>
                                        <option value="煞車零件">煞車零件</option>
                                        <option value="鍊條">鍊條</option>
                                        <option value="輪胎">輪胎</option>
                                        <option value="踏板">踏板</option>
                </select>
        </form>
    </div>
    <div class="d-flex align-items-center my-md-3 add-new-wrap">
        <button type="button" class="btn bgc-green  px-lg-5 color-white font-weight-bold add-new"><a class="nav-link color-white " href="p__insert2.php" style="padding:0;">新增商品</a></button>
    </div>
</div>


<div class="w-100 d-flex my-sm-3 setting-wrap position-relative">
    <!-- <select name="" id="" class="form-control border-1-green fa order">
        <option value=0 class="fa-caret-down">按新增時間 &#xf0d7;</option>
        <option value=1 class="fa">按新增時間 &#xf0d8;</option>
    </select> -->
    <div></div>
    <div class="pagination-wrap d-flex">
        <!-- <p class="text-left mb-0 mr-3">第1頁/共3頁</p> -->
        <ul class="pagination justify-content-center mr-5 mb-0">
            <!-- <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1"><i class="fas fa-caret-left"></i></a>
            </li>
            <li class="page-item"><a class="page-link" href="#">10</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#"><i class="fas fa-caret-right"></i></a>
            </li> -->
        </ul>
    </div>
    <select name="" id="" class="form-control border-1-red perPage pages_present">
        <option value="5">每頁顯示5條路線</option>
        <option value="10">每頁顯示10條路線</option>
        <option value="15">每頁顯示15條路線</option>
        <option value="20">每頁顯示20條路線</option>
    </select> 
</div>






    <div class="row">
        <div class="col-md-12 col-sm-12">
            <table class="table  table-bordered">
                <thead>
                <tr class="text-center     vertical-align: middle;">
               
                    <th scope="col">#</th>
                    <th scope="col">商品照片</th>
                    <th scope="col">商品名稱</th>
                    <th scope="col">數量</th>
                    <th scope="col">說明</th>
                    <th scope="col">價格</th>
                    <th scope="col">商品類別</th>
                    <th scope="col">商品部件</th>
                    <th scope="col">品牌</th>
                    <th scope="col">顏色</th>
                    <th scope="col">尺寸</th>
                    <!-- 180公分=18吋 -->

                    <td>
                            <i class="fas fa-edit"></i>/
                            <i class="fas fa-minus-circle"></i>
                        </td>
                      
                      
                </tr>
                </thead>
                <tbody id= "data_body" class="aaa">
              
            </table>
        
      
  
   


<script>
    let sel_genre2 = document.querySelector('#sel_genre2')
    let search_btn = document.querySelector('.search_btn');
    let searchbar = document.querySelector('#search');
    let genre2 = document.querySelector("#genre2");
    let pages_present = document.querySelector('.pages_present');
    let perPage = pages_present.value;
    var num_pagi = "";
    var page_act = "";
    let    sel_genre =sel_genre2.value
    let    keyword = searchbar.value;
    // let tbody = document.querySelector('#data_body')
    console.log(sel_genre2);
    


    function delete_it(sid) {
        swal({
                title: "確定要刪除該商品嗎?",
                text: "一旦刪除將無法復原!!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("已經成功刪除該商品!", {
                        icon: "success",
                    }).then((info) => {
                        location.href = 'p_delete.php?p_sid=' + sid;
                    });
                } else {
                    swal("商品完整保留");
                }
            });
    }





   function edit_it(sid){
        location.href = 'p__edit.php?p_sid='+sid;
   } 
let page = 1;
const ul_pagi = document.querySelector('.pagination');
const data_body = document.querySelector('#data_body');

const tr_str = `<tr>
                        <td class="des" style="vertical-align: middle;"><%= p_sid %></td>
                        <td class="des" ><a data-fancybox data-caption="<%=p_name%>" href="./uploads/<%= p_photo%>"><img src="./uploads/<%= p_photo%>" style="height: 100px ; max-width:100%;background-size:cover" alt=""></a></td>
                        <td class="des" style="vertical-align: middle";><%= p_name %><a href="p_read.php?sid=<%= p_sid  %>" class="text-info"> <i  class="fas fa-info-circle"></i></a></td>
                        <td class="des" style="vertical-align: middle;"><%= quantity %></td>
                        <td class="des" style="vertical-align: middle;"><%= p_description %></td>
                        <td class="des" style="vertical-align: middle;"><%= p_price %></td>
                        <td class="des" style="vertical-align: middle;"><%= p_genre %></td>
                        <td class="des" style="vertical-align: middle;"><%= p_genre2 %></td>
                        <td class="des" style="vertical-align: middle;"><%= p_brand %></td>
                        <td class="des" style="vertical-align: middle;"><%= p_color %></td>
                        <td class="des" style="vertical-align: middle;"><%= p_size %></td>
                        <td class="des" style="vertical-align: middle;">
                        <a href="javascript:edit_it(<%= p_sid %>)"><i class="fas fa-edit"></i></a>/
                        <a href="javascript:delete_it(<%= p_sid %>)">
                        <i class="fas fa-minus-circle"></i></a>
                        </td>
                       
                    </tr>`;
const tr_func = _.template(tr_str);


const pagi_str = ` <li class="btn-light page-num page-item <%= active %>">
                    <a class=" page-link " href="#<%= page %>"> <%= page %> </a>
                    </li>`;
                    const pagi_func = _.template(pagi_str);

   



 const mySelChange = () => {
        perPage = pages_present.value;
        console.log(perPage);
        myHashChange();
    }
    $("#search_btn").click(function(){
        let sel_genre = sel_genre2.value;
        myHashChange()
    })
    function selGenre2() {
       let sel_genre = sel_genre2.value;
       let search_btn = document.querySelector('.search_btn');
        console.log(sel_genre);
        //  search_btn.addEventListener('click',  myHashChange);
         myHashChange()
       
         
    }


const myHashChange = ()=>{
    let searchbar = document.querySelector('#search');
    let sel_genre2 = document.querySelector('#sel_genre2')   
    let sel_genre = sel_genre2.value;
    sel_genre2 = sel_genre2.value
    keyword = searchbar.value;
    let h = location.hash.slice(1);
 

    
  
 

    
        page = parseInt(h);
        if (isNaN(page)) {
            page = 1;
        }
         ul_pagi.innerHTML+= page;
        fetch('p__search2.php?page=' + page + '&perPage=' + perPage + '&sel_genre2=' + sel_genre2 + '&keyword=' + keyword)
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
                data_body.innerHTML = str;
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
               
                str += `<li class="page-item ${ori_data.page==ori_data.totalPages ? 'disabled' : ''} ">
                            <a class="page-link" href="#${ori_data.page+1}">&gt;</a>
                            </li>`;
                ul_pagi.innerHTML = str;
                num_pagi = document.querySelectorAll('.page-num');
                page_act = ul_pagi.querySelector('.active');
                num_pagi
                // for (var v = 0; v < num_pagi.length; v++) {
                //     if (parseInt(page_act.innerText) + 3 < parseInt(num_pagi[v].innerText)) {
                //         num_pagi[v].style.display = "none";
                //     }
                //     if (parseInt(page_act.innerText) - 3 > parseInt(num_pagi[v].innerText)) {
                //         num_pagi[v].style.display = "none";
                //     }
                // }
                
            });
    };








    window.addEventListener('hashchange',myHashChange);
    pages_present.addEventListener('change', mySelChange); 
    search_btn.addEventListener('click', myHashChange);
     sel_genre2.addEventListener('change', selGenre2);
myHashChange();
</script>
<?php include __DIR__."/p__html_foot.php" ;?>
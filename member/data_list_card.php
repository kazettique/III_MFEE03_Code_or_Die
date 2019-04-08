<?php
require __DIR__.'/__connect_db.php';
$page_name='data_list'
?>

<?php include __DIR__. '/__html_head.php';  ?>
<?php include __DIR__. '/__navbar.php';  ?>
<style>
    

    .card-img{
      height:100%;
    }

    .card {
      background:#f9f9f9;
      border:none;
    }

    .page-link{
      color:#a7a8bd;
    }

    .page-item.active .page-link {
    z-index: 1;
    color: #fff;
    background-color:#5d3d21;
    border-color: #007bff;
}
</style>
<div class="container">


  <div class="row">
    <div class="col-lg-12">

    <form name="form1" class="mt-5" id="form1" method="post" onsubmit="return search()">
      <div class="form-group col-6 mx-auto">
            <input type="text" class="form-control" id="m_search" name="m_search"  placeholder="搜尋" value="">
            
      </div>
      
            <button type="submit" class="btn d-flex mx-auto btn-outline-info" >搜尋</button>
  </form>

            
           

            <select class="pages_present mx-auto d-block my-3" >
                
                <option value="5" > 每頁5筆資料</option>
                <option value="10" >每頁10筆資料</option>
                <option value="15" >每頁15筆資料</option>
            
            </select>
        
    </div>
  </div>

  <div class="row">
        <div class="col-lg-12" id="card_area">

        
<?php /*   <div class="card mb-3" style="max-width: 540px;">
   
    <div class="row no-gutters">
      <div class="col-md-4">
       <img src="..." class="card-img" alt="..."> 
      </div>
      <div class="col-md-8">
        <div id="card-body">
        <h5 class="card-title"> </h5>
          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> 
          
        </div>
      </div>
    </div>
    
  </div>
*/ ?>
        

    </div>



  </div>

  <div class="row">
    <div class="col-lg-12">
        <ul class="pagination pagination-sm justify-content-center"><?php /*
               
               <li class="page-item <?= $page<=1? 'disabled' :'' ?>">
                   <a class="page-link" href="?page=<?= $page-1 ?>">&lt;</a>
               </li>
               <?php for($i=1; $i<=$total_pages; $i++): ?>
               <li class="page-item <?= $i==$page ? 'active' : '' ?>">
                   <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
               </li>
               <?php endfor ?>
               <li class="page-item <?= $page>=$total_pages ? 'disabled' : '' ?>">
                   <a class="page-link" href="?page=<?= $page+1?>">&gt;</a>
               </li>
               
           */?>

           
           </ul>
    </div>
  </div>

</div>





<script>
  let page=1;
  let ul_pagi=document.querySelector('.pagination');
  
  let pages_present=document.querySelector('.pages_present');
  const data_body = document.querySelector('#data_body');
  let card =document.querySelector('#card_area');

  console.log(pages_present.length)


  const tr_str = `<div class="card mb-4 mx-auto" style="max-width: 60%;">
  <div class="row no-gutters">
      <div class="col-md-4">
       <img src="<%= m_photo ==''?'https://images2.imgbox.com/b0/c3/sQxunS2i_o.png':m_photo %>" class="card-img" alt="..."> 
      </div>
      <div class="col-md-8">
        <div id="card-body">
        <h5 class="card-title text-center pt-3"> <%= m_sid  %><%= m_name %>   <a href="data_read.php?sid=<%= m_sid  %>" class="text-info"> <i  class="fas fa-info-circle"></i></a></h5>
        <h6 class="pl-5">生日:<%= m_birthday %></h6>

          <p class="card-text pl-5">
          
          <%= m_city %> <%= m_town %><br>
          <%= m_address %><br>
          <%= m_email %><br>
          <%= m_mobile %>
           
          </p>

          <p class="card-text d-flex justify-content-around  pb-2"> 
          <a href="data_edit.php?sid=<%= m_sid  %>" class="text-success"><i class="fas fa-edit"></i></a>
          
          <a href="javascript: delete_it(<%= m_sid  %>)" class="text-danger"><i class="fas fa-trash-alt"></i></a>
          <span>帳號狀態:<a href="javascript: switch_it(<%= m_sid  %>)" class="text-warning"> <%=m_active ==0 ?'<i class="fas fa-check"></i>':'<i class="fas fa-ban"></i>' %> </a></span>
          </p> 
          
        </div>
      </div>
    </div>
    </div>`
                        
                     

  const tr_func = _.template(tr_str);
  //underscore語法
  const pagi_str =` 
                    <li class="btn-light page-num page-item <%= active %>">
                    <a class=" page-link " href="#<%= page %>"> <%= page %> </a>
                    </li>`;

  const pagi_func = _.template(pagi_str);
  //underscore語法

  
  
  
  for(var i=0;i< pages_present.length;i++){
        if(pages_present[i].value==location.hash.slice(location.hash.indexOf("perPage")+8)){
          console.log("for");
          pages_present[i].selected=true;
          console.log(pages_present[i].selected);
        }
      }

      let  perPage=pages_present.value;

    var num_pagi="";
    var page_act="";

  const mySelChange=()=>{
        perPage = pages_present.value;
        console.log(perPage);
        myHashChange();
    }
    
  const myHashChange=()=>{
    let h=location.hash.slice(1);
    page=parseInt(h);
    
    if(isNaN(page)){
                page = 1;
            }
    ul_pagi.innerHTML+= page;

            fetch('data_list_api.php?page=' + page+'&perPage='+perPage)
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
                    card.innerHTML = str;


                    str = '';
                    for(let i=1; i<=ori_data.totalPages; i++){
                        let active = ori_data.page === i ? 'active' : '';

                        str += pagi_func({
                            active: active,
                            page: i
                        });

                    }
                    str=`<li class="page-item ${ori_data.page}=1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=#${ori_data.page-1}">&lt;</a>
                        </li>`+str;

                    str+=`<li class="page-item ${ori_data.page}=ori_data.totalPages ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=#${ori_data.page+1}">&gt;</a>
                            </li>`;
                    ul_pagi.innerHTML = str;

                    num_pagi=document.querySelectorAll('.page-num');
                    page_act=ul_pagi.querySelector('.active');

                    num_pagi

                    for(var v=0;v<num_pagi.length;v++){
                      if(parseInt(page_act.innerText)+3<parseInt(num_pagi[v].innerText)){
                        num_pagi[v].style.display="none";
                      }

                      if(parseInt(page_act.innerText)-3>parseInt(num_pagi[v].innerText)){
                        num_pagi[v].style.display="none";

                     
                    }
                  }

                  

                    parseInt(page_act.innerText)
                });
        };





    function search(){
      let form = new FormData(document.form1);
      console.log(form);

      fetch('data_search_api.php', {
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
                    card.innerHTML = str;


                    str = '';
                    for(let i=1; i<=ori_data.totalPages; i++){
                        let active = ori_data.page === i ? 'active' : '';

                        str += pagi_func({
                            active: active,
                            page: i
                        });
                    }
                    str=`<li class="page-item ${ori_data.page}=1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=#${ori_data.page-1}">&lt;</a>
                        </li>`+str;

                    str+=`<li class="page-item ${ori_data.page}=ori_data.totalPages ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=#${ori_data.page+1}">&gt;</a>
                            </li>`;
                    ul_pagi.innerHTML = str;

                });

                return false;
    }


    
  

//   事件監聽
  window.addEventListener('hashchange', myHashChange);  //切換hash

  pages_present.addEventListener('change', mySelChange); //下拉式選單

  myHashChange();

  // for(var i=0;i< pages_present.length;i++){
  //    pages_present[i].selected;
  // }

  function  switch_it(sid){
        location.href ='data_switch.php?sid=' + sid+"&page="+page+"&perPage="+perPage;
  }

  function delete_it(sid){
            if(confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)){
                location.href = 'data_delete.php?sid=' + sid+"&page="+page+"&perPage="+ perPage;
            }
        }
      

</script>


<?php include __DIR__. '/__html_foot.php';  ?>
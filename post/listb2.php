<?php include __DIR__."./header_html.php"; ?>
<link rel="stylesheet" href="./article.css" />
<div class="container" style="margin: 0 auto">
<?php include __DIR__."./nav_html.php"; ?>

  <div class="searchbar">
  <form>
  <label for="search">搜尋文章標題</label>
  <input type="text" id="search" name="search">
  <button >search</button>
  <label for="select">搜尋文章分類</label>
  <select name="type" id="type">
          <option value="none" >ALL</option>
          <option value="test">test</option>
          <option value="test1">test1</option>
          <option value="newbike">新車上市</option>
          <option value="news">車友新聞</option>
  </select>
  </form>
  </div>
<div class="dashboard">
  <div id="left" class="control"></div>  
  <div id="mid">
    <div id="info">
      
    </div>
  </div>
  <div id="right" class="control"></div>    
</div>
  <div class="pages">
  
  </div>

  </div>

<script>
    let select = document.querySelector("#type");
    let info = document.querySelector("#info");
    let pagination = document.querySelector(".pagination");
    let search = document.querySelector("#search");
    let searbtn = document.querySelector("button");
    let left = document.querySelector("#left");
    let right = document.querySelector("#right");
    const renderDOM = () => {
      let form = document.querySelector("form");
      if(search.value === ""){
          search.value === "none";
      }
      let formData = new FormData(form);
      let page = parseInt(location.hash.slice(1));
      if(!page) page = 1;
      if(isNaN(page)) page = 1;
        fetch(`test_list_api.php?page=${page}`, {
            method: "post",
            body: formData
        })
        .then(res => res.json())
        .then(obj => {
            if (obj["data"].length != 0) {
                renderHtml(obj["data"]);
                // renderBtn(obj["totalPages"], obj["page"], obj["perPage"], obj["totalRows"]);
                renderSide(obj["page"],obj["totalRows"], obj["perPage"], obj["totalPages"])
               
            }else{
              info.innerHTML =`<div id="no-data">
        NO DATA
    </div>`;
              left.innerHTML ="";
              right.innerHTML ="";
              
            }

        })
   
    }
    const renderSide = (page, length, perPage, totalPage) => {
      let html ="";
      html += `<a class="" href="#${(page - 1 < 1 ? 1 : page - 1)}" ${page == 1? 'style="display: none"' : ""} aria-label="Previous">
      <span aria-hidden="true"><i class="fas fa-angle-left"></i></span>
      </a>`
      html +=`<a class="" href="#1" ${page == 1? 'style="display: none"' : ""} aria-label="Previous">
      <span aria-hidden="true"><i class="fas fa-angle-double-left"></i></span>
      </a>`
      left.innerHTML = html;
      html = "";
      html += `<a class="" href="#${totalPage}" ${page == totalPage? 'style="display: none"' : ""} aria-label="Previous">
      <span aria-hidden="true"><i class="fas fa-angle-double-right"></i></span>
      </a>` 
      html += `<a class="" href="#${(page + 1 > Math.ceil(length / perPage) ? Math.ceil(length / perPage) : page + 1)}" ${page == totalPage? 'style="display: none"' : ""} aria-label="Previous">
      <span aria-hidden="true"><i class="fas fa-angle-right"></i></span>
      </a>` 
      right.innerHTML = html;

    }
    const renderHtml = (data) => {
      let html = ""
      data.map(obj => {
        return html += `<div class="card" style="width: 10rem;">
  <div class="card-img">      
  <img src="./upload/${obj["imgname"]}" alt="no img">
  </div>
  <div class="card-body" style="height: 50px; overflow: hidden; text-overflow: ellipsis; white-space: no-wrap;">
    <p class="card-text" style="overflow: hidden; text-overflow: ellipsis; white-space: no-wrap;">${obj["title"]}</p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">${obj["type"]}</li>
    <li class="list-group-item">${obj["date"] ? obj["date"] : "No date"}  </li>
  </ul>
  <div class="card-edit">
  <a href="editimg.php?sid=${obj["sid"]}" data-toggle="tooltip" title="編輯圖片"><i class="fas fa-images"></i></a>
  <a href="editor2.php?sid=${obj["sid"]}" data-toggle="tooltip" title="編輯文章內容"><i class="fas fa-edit"></i></a>
  <a href="__delete.php?sid=${obj["sid"]} data-toggle="tooltip" title="刪除文章"" class="delete"><i class="fas fa-trash-alt"></i></a>
  </div>
</div>` ;
      })
      info.innerHTML = html;
    }
    const renderBtn = (totalPage, page, perPage, length) => {
      console.log(totalPage, page, perPage, length);
      let html = ""
      if(length > 5){
      html += ` <li class="page-item">
                      <a class="" href="#${(page - 1 < 1 ? 1 : page - 1)}" aria-label="Previous">
                        <span aria-hidden="true">&lt</span>
                      </a>
                    </li>`
      }
          for(let i = page; i <= totalPage; i++){
          html += `<li class="page-item"><a class="" href="#${i}">${i}</a></li>`
          }
      
      // }else{
      //     for(let i = page; i <= page + 2; i++){
      //     html += `<li class="page-item"><a class="" href="#${i}">${i}</a></li>`
      //     }
      //     html += "................";
      //     for(let i = totalPage - 2; i <= totalPage; i++){
      //     html += `<li class="page-item"><a class="" href="#${i}">${i}</a></li>`
      //     }
      // }
      if(length > 5){
      html += ` <li class="page-item">
                      <a class="" href="#${(page + 1 > Math.ceil(length / perPage) ? Math.ceil(length / perPage) : page + 1)}" aria-label="Previous">
                        <span aria-hidden="true">&gt</span>
                      </a>
                    </li>`
      }
      pagination.innerHTML = html;
    }
    if(search.value === "" && select.value === "none") renderDOM();
    window.addEventListener("hashchange", renderDOM);
    select.addEventListener("change", (event) => {
        location.hash = 1;
        event.preventDefault();
        event.stopPropagation();
      renderDOM()});
    searbtn.addEventListener("click", (event) => {
        location.hash = 1;
        event.preventDefault();
        event.stopPropagation();
      renderDOM()});
    
 
    
    
    

</script>





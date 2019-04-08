<?php include __DIR__."./header_html.php"; ?>
<?php include __DIR__."./nav_html.php"; ?>
<div class="container">
<table class="table">
<label for="search">搜尋文章標題</label>
<input type="text" id="search">
<label for="select">搜尋文章分類</label>
<select name="type" id="type">
        <option value="none" >-----</option>
        <option value="test">test</option>
        <option value="test1">test1</option>
</select>
  <thead>
    <tr>
      <th scope="col">image</th>
      <th scope="col">edit image</th>
      <th scope="col">title</th>
      <th scope="col">type</th>
      <th scope="col">date</th>
      <th scope="col">edit</th>
      <th scope="col">delete</th>
    </tr>
  </thead>
  <tbody id="info">
  </tbody>
</table>
<ul class="pagination">
  </ul>

</div>
<script>
    let select = document.querySelector("#type")
    let info = document.querySelector("#info")
    let pagination = document.querySelector(".pagination")
    let search = document.querySelector("#search");

    const getLocalData = () => {
    fetch("__list.php").then(res => res.json()).then(json => {
      localStorage.setItem("data", JSON.stringify(json))
      renderDOM();
    })
    
    };
    
    const renderDOM = () => {
      console.log("rendered")
      let oriData = JSON.parse(localStorage.getItem("data"));
      let perPage = 5;
      let page = parseInt(location.hash.slice(1));
      if(!page) page = 1;
      if(isNaN(page)) page = 1;
      if(select.value !== "none") {
        data = oriData.filter(obj => obj["type"] === select.value);
      }else{
        data = oriData;
      }
      if(search.value !== "") data = data.filter(obj => obj["title"].includes(search.value));
      let length = data.length;
      let totalPage = Math.ceil(data.length / perPage);
      data = data.slice((page -1) * 5, (page - 1) * 5 + 5);
      renderHtml(data);
      renderBtn(totalPage, page, perPage, length);
      let deleteBtns = document.querySelectorAll(".delete");
       deleteBtns.forEach(deleteBtn => deleteBtn.addEventListener("click", getLocalData));
    }
    const renderHtml = (data) => {
      let html = ""
      data.map(obj => {
        return html += `<tr><td><img src="./upload/${obj["imgname"]}"></td><td><a href="editimg.php?sid=${obj["sid"]}">edit</a></td><td>${obj["title"]}</td><td>${obj["type"]}</td><td>${obj["date"]}</td><td><a href="editor2.php?sid=${obj["sid"]}">edit</a></td><td><a href="__delete.php?sid=${obj["sid"]}" class="delete">delete</a></td></tr>` ;
      })
      info.innerHTML = html;
    }
    const renderBtn = (totalPage, page, perPage, length) => {
      
      let html = ""
      html += ` <li class="page-item">
                      <a class="page-link" href="#${(page - 1 < 1 ? 1 : page - 1)}" aria-label="Previous">
                        <span aria-hidden="true">&lt</span>
                      </a>
                    </li>`
      if(totalPage){
          for(let i = 1; i <= totalPage; i++){
          html += `<li class="page-item"><a class="page-link" href="#${i}">${i}</a></li>`
          }
      }
      // }else{
      //     for(let i = page; i <= page + 2; i++){
      //     html += `<li class="page-item"><a class="page-link" href="#${i}">${i}</a></li>`
      //     }
      //     html += "................";
      //     for(let i = totalPage - 2; i <= totalPage; i++){
      //     html += `<li class="page-item"><a class="page-link" href="#${i}">${i}</a></li>`
      //     }
      // }
      html += ` <li class="page-item">
                      <a class="page-link" href="#${(page + 1 > Math.ceil(length / perPage) ? Math.ceil(length / perPage) : page + 1)}" aria-label="Previous">
                        <span aria-hidden="true">&gt</span>
                      </a>
                    </li>`
      pagination.innerHTML = html;
    }

    window.addEventListener("DOMContentLoaded", getLocalData);
    window.addEventListener("hashchange", renderDOM);
    select.addEventListener("change", () => {
      location.hash = 1;
      renderDOM()});
    search.addEventListener("input", () => {
      location.hash = 1;
      renderDOM()});
 
    
    
    

</script>





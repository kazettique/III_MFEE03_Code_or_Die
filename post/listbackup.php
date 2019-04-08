<?php include __DIR__."./header_html.php"; ?>
<?php include __DIR__."./nav_html.php"; ?>
<div class="container">
<table class="table">
<form name="form1">
<select name="type" id="type">
        <option value="none" >-----</option>
        <option value="test">test</option>
        <option value="test1">test1</option>
</select>
</form>
  <thead>
    <tr>
      <th scope="col">image</th>
      <th scope="col">edit image</th>
      <th scope="col">title</th>
      <th scope="col">type</th>
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

    let onHashChange = function (){
      let h = location.hash.slice(1);
      let page = parseInt(h);
      let perPage = 5;
      let html = ""
      if(isNaN(page)) page = 1;
      if(!location.hash) page = 1;
      
      if(select.value === "none"){
      fetch("__list.php").then(response => response.json()).then(json => {
          let data = json;
          console.log(data);
          if(select.value !== "none"){
            data = json.filter(obj => obj["type"] == selected.value)
          }
          html += ` <li class="page-item">
                      <a class="page-link" href="#${(page - 1 <= 0 ? page : page - 1)}" aria-label="Previous">
                        <span aria-hidden="true">&lt</span>
                      </a>
                    </li>`
          for(let i = 1; i <= Math.ceil(data.length / perPage); i++){
            html += `<li class="page-item"><a class="page-link" href="#${i}">${i}</a></li>`
          }
          html += ` <li class="page-item">
                      <a class="page-link" href="#${(page + 1 > Math.ceil(data.length / perPage) ? Math.ceil(data.length / perPage) : page + 1)}" aria-label="Previous">
                        <span aria-hidden="true">&gt</span>
                      </a>
                    </li>`
          pagination.innerHTML = html;
          html = "";
          if(page >= data.length / perPage) page = Math.ceil(data.length / perPage);
          let dataPage = data.slice((page - 1) * 5, (page - 1) * 5 + perPage);
          console.log(dataPage);
          dataPage.map(obj => {
                  html += `<tr><td><img src="./upload/${obj["imgname"]}"></td><td><a href="editimg.php?sid=${obj["sid"]}">edit</a></td><td>${obj["title"]}</td><td>${obj["type"]}</td><td><a href="editor2.php?sid=${obj["sid"]}">edit</a></td><td><a href="__delete.php?sid=${obj["sid"]}">delete</a></td></tr>` ;
              })
          info.innerHTML = html;
          
              })
      }else{
        fetch("__list.php").then(response => response.json()).then(json => {
          let data = json
          data = json.filter(obj => obj["type"] == select.value)
          html += ` <li class="page-item">
                      <a class="page-link" href="#${(page - 1 <= 0 ? page : page - 1)}" aria-label="Previous">
                        <span aria-hidden="true">&lt</span>
                      </a>
                    </li>`
          for(let i = 1; i <= Math.ceil(data.length / perPage); i++){
            html += `<li class="page-item"><a class="page-link" href="#${i}">${i}</a></li>`
          }
          html += ` <li class="page-item">
                      <a class="page-link" href="#${(page + 1 > Math.ceil(data.length / perPage) ? Math.ceil(data.length / perPage) : page + 1)}" aria-label="Previous">
                        <span aria-hidden="true">&gt</span>
                      </a>
                    </li>`
          pagination.innerHTML = html;
          html = "";
          if(page >= data.length / perPage) page = Math.ceil(data.length / perPage);
          let dataPage = data.slice((page - 1) * 5, (page - 1) * 5 + perPage);
          console.log(dataPage);
          dataPage.map(obj => {
                  html += `<tr><td><img src="./upload/${obj["imgname"]}"></td><td><a href="editimg.php?sid=${obj["sid"]}">edit</a></td><td>${obj["title"]}</td><td>${obj["type"]}</td><td><a href="editor2.php?sid=${obj["sid"]}">edit</a></td><td><a href="__delete.php?sid=${obj["sid"]}">delete</a></td></tr>` ;
              })
          info.innerHTML = html;
          
              })
      }

    }
    select.addEventListener("change", onHashChange);



    window.addEventListener("hashchange", onHashChange);
    onHashChange();
</script>





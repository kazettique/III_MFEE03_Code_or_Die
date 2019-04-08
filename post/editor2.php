<?php
    require __DIR__."./__connect_db.php";
    $sid = isset($_GET["sid"])? intval($_GET["sid"]) : 0;
    $result = [
        "data" => [],
    ];

    $sql = sprintf("SELECT * FROM `test` WHERE `sid` = $sid");
    $stmt = $pdo->query($sql);
    $result["data"] = $stmt->fetch(PDO::FETCH_ASSOC);
    $data = htmlentities($result["data"]["text"]);
    $filename = $result["data"]["imgname"];
    $type = $result["data"]["type"] ? $result["data"]["type"] : null;
    $title = $result["data"]["title"]? $result["data"]["title"] : null;
    $page_name = "editor";

?>
<?php include __DIR__."./header_html.php"; ?>
<?php include __DIR__.'/../_navbar.php'; ?>
    <div class="container">
   
    <form
        name="form"
        method="post"
        action="./__edit.php"
        onsubmit = ""
        enctype= multipart/form-data
      > 
      <input type="text" name="date" id="date" style="display: none">
        <div id="edittype" style="display: none" ><?= $type ?></div>
        <input type="text" name="sid" value=<?= $sid ?> style="display: none">
        <input type="text" name="title" id="title" value="<?= $title ?>">
        <label for="">文章分類</label>
        <select name="type">
        <option value="none">-----</option>
        <option value="test">test</option>
        <option value="test1">test1</option>
        </select>
        <textarea
          name="content"
          id="editor"
          cols="30"
          rows="10"
          placeholder="Please type in something~"
        ></textarea>
        <button type="submit" id="submit" class="btn btn-primary">
          Submit
        </button>
        <p id="titleHint">Please enter a title</p>    
        <p id="typeHint" style="display: none">Please select a type</p>    
        <p id="editorHint" style="display: none">Please enter a some content</p>       
      </form>
    </div>
    <div id="edit" style="display: none"><?= $data ?></div>
    <div id="info"></div>
    <script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>
    <script src="../ckfinder/ckfinder.js"></script>
    <script>
      let upload = document.querySelector("#upload");
      let title = document.querySelector("#title");
      let submit = document.querySelector("#submit");
      let select = document.querySelector("select");
        let edit = document.querySelector("#edit");
        ClassicEditor.create(document.querySelector("#editor"), {ckfinder: {
                 uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
             },
             toolbar: [ 'ckfinder', 'imageUpload', '|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo' ]
         })
        .then(newEditor => {
            editor = newEditor;
            editor.setData(`${edit.textContent}`)
            editor.model.document.on( "change", () => {
            if(select.value !== "none" && title.value !== "" && editor.getData() !== ""){
            submit.disabled = false;
            }else{
             submit.disabled = true;
            }
            if(editor.getData() !== ""){
               let editorHint = document.querySelector("#editorHint");
               editorHint.style.display = "none";
           }else{
          editorHint.style.display = "block";
            }
          });
        })
        .catch(error => {
            console.error(error);
        });
            
    if(!select.value || !title.value){
      submit.setAttribute("disabled", true);
    }
    title.addEventListener("input", (event) =>{
      console.log("title")
      if(title.value !== ""){
        let titleHint = document.querySelector("#titleHint");
        titleHint.style.display = "none";
      }else{
        titleHint.style.display = "block";
      }
      if(select.value !== "none" && title.value !== "" && editor.getData() !== ""){
        submit.disabled = false;
      }else{
        submit.disabled = true;
      }
      
    })  
      
    select.addEventListener("change", (event) =>{
      if(select.value !== "none"){
        let typeHint = document.querySelector("#typeHint");
        typeHint.style.display = "none";
      }else{
        typeHint.style.display = "block";
      }
      if(select.value !== "none" && title.value !== "" && editor.getData() !== ""){
        submit.disabled = false;
      }else{
        submit.disabled = true;
      }
      
    })
    let options = document.querySelectorAll("option")
    let edittype = document.querySelector("#edittype").textContent
    options.forEach(option => {
      if(option.value === edittype) option.setAttribute("selected", "selected");
       
      })
      submit.addEventListener("click", () => {
      let date = new Date();
      let year = date.getFullYear();
      console.log(year);
      let month = date.getMonth() + 1;
      let day = date.getDate();
      submitDate.value = `${year}/${month}/${day}`;
    })    
       

    </script>
  </body>
</html>

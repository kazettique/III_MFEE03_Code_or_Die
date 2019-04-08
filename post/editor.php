<?php $page_name = "editor"; ?>
<?php include __DIR__."./header_html.php"; ?>
<?php include __DIR__.'/../_navbar.php'; ?>
    <div class="container">
      <img id="photo">
      <form
        name="form"
        method="post"
        action="./__insert.php"
        onsubmit =""
        enctype= multipart/form-data
      > 
        <input type="text" name="date" id="date" style="display: none">
        <input type="file" accept="image/*" name="uploaded" id="upload">
        <input type="text" name="title" id="title">
        <label for="">文章分類</label>
        <select name="type">
        <option value="none" >-----</option>
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
        <p id="fileHint">Please select a file</p>        
        <p id="titleHint">Please enter a title</p>        
        <p id="typeHint">Please select a type</p>        
        <p id="editorHint">Please enter a some content</p>        
      </form>
    </div>
    <div id="info"></div>
    <script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>
    <script src="../ckfinder/ckfinder.js"></script>
    <script>
      let upload = document.querySelector("#upload");
      let title = document.querySelector("#title");
      let photo = document.querySelector("#photo");
      let submitDate = document.querySelector("#date");
      upload.addEventListener("change", () => {
        console.log("123");
        photo.src = URL.createObjectURL(event.target.files[0]);
      })
      let submit = document.querySelector("#submit");
      let select = document.querySelector("select");
    ClassicEditor.create(document.querySelector("#editor"), {ckfinder: {
                 uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
             },
             toolbar: [ 'ckfinder', 'imageUpload', '|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo' ]
         } )
      .then(newEditor => {
    editor = newEditor;
    editor.model.document.on( "change", () => {
        if(upload.value !== "" && select.value !== "none" && title.value !== "" && editor.getData() !== ""){
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
      } );
        
    })
    .catch(error => {
    console.error(error);
    });
    
    
    if(!upload.value || !select.value || !title.value){
      submit.setAttribute("disabled", true);
    }
    upload.addEventListener("change", (event) =>{
      if(upload.value !== ""){
        let fileHint = document.querySelector("#fileHint");
        fileHint.style.display = "none";
      }else{
        fileHint.style.display = "block";
      }
      if(upload.value !== "" && select.value !== "none" && title.value !== "" && editor.getData() !== ""){
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
      if(upload.value !== "" && select.value !== "none" && title.value !== "" && editor.getData() !== ""){
        submit.disabled = false;
      }else{
        submit.disabled = true;
      }
      
    })
    title.addEventListener("input", (event) =>{
      if(title.value !== ""){
        let titleHint = document.querySelector("#titleHint");
        titleHint.style.display = "none";
      }else{
        titleHint.style.display = "block";
      }
      if(upload.value !== "" && select.value !== "none" && title.value !== "" && editor.getData() !== ""){
        submit.disabled = false;
      }else{
        submit.disabled = true;
      }
      
    })

    submit.addEventListener("click", () => {
      let date = new Date();
      let year = date.getFullYear();
      console.log(year);
      let month = date.getMonth() + 1;
      let day = date.getDate();
      submitDate.value = `${year}/${month}/${day}`;
    })
    fetch("__insert.php")
    .then(response => response)
    .then(json => console.log(json))
   
   
    </script>
  </body>
</html>

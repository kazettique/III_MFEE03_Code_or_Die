<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>    
</head>
<style>
    .sidebar{
        width:20%;
        position:absolute;
        left:0;
        height: 100vh;
    }
    .content{
        width:80%;
        position:absolute;
        right:0;
        height: 100vh;
    }
    #side-bar{
        height:100%;
        position: absolute;
        left:0;
        top: 0;
        display: flex;
        flex-direction: column;
        padding-left: 2%;
     }
     #side-bar li{
        flex: 1 1 auto;
        display:flex;
        justify-content: center;
        align-items: center;
        
     }
</style>
<body>
<div class="sidebar">
<ul class="list-group" id="side-bar">
  <li class="list-group-item" id="list">Cras justo odio</li>
  <li class="list-group-item" id="editor">Dapibus ac facilisis in</li>
  <li class="list-group-item">Morbi leo risus</li>
  <li class="list-group-item">Porta ac consectetur ac</li>
  <li class="list-group-item">Vestibulum at eros</li>
  <li class="list-group-item">Vestibulum at eros</li>
</ul>
</div>
<div id="content-holder">

</div>
     <script>
        let sideBar = document.querySelector("#side-bar")
        sideBar.addEventListener("click",(e) => {
            console.log(e.target)
            $('#content-holder').load(`./${e.target.id}.php`);
        })
        // let link1 = document.querySelector("#link1");
        // let link2 = document.querySelector("#link2");
        // link1.addEventListener("click", () => {$('#content-holder').load('./list.php');} )
        // link2.addEventListener("click", () => {$('#content-holder').load('./editor.php');}  )

       
     </script>
</body>
</html>
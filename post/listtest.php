
<?php include __DIR__ . "./header_html.php"; ?>

<?php include __DIR__ . "/../sidebar/__nav.php"; ?>


<link rel="stylesheet" href="./list.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<style>
    * {
        box-sizing: border-box;
        text-align: left;
    }

    /* width */
    ::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        box-shadow: inset 0 0 1px grey;
        border-radius: 5px;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #2ADDC7;
        border-radius: 5px;
    }

    .wrapper {
        width: 100%;
        height: 100vh;
        overflow: hidden;
        background-color: rgba(0,0,0,0.5);
    }

    #content {
        background: white;
        position: relative;
        width: 75%;
        height: 100vh;
        /* background-color: rgba(0,0,0,0.5); */
    }

    #content #news-content {
        padding: 1%;
        width: 65%;
        /* background: red; */
        height: 100vh;
    }

    #content #news-content #article-info {
        height: 10%;
        padding: 1%;
        /* background: lightblue; */
    }

    #content #news-content #article-body {
        background: white;
        height: 80%;
        padding: 2%;
        border: 1px solid #eee;
        overflow: auto;
    }

    #content #news-content #control {
        height: 10%;
        /* background: black; */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #content #comments {
        width: 35%;
        padding: 1%;
        /* background: blue; */
        height: 100vh;
    }

    #comments-head {
        padding: 2%;
        height: 10%;
    }

    #comments-body {
        padding: 2%;
        background: white;
        height: 90%;
        border: 1px solid #eee;
        overflow: auto;
    }

    #content #comments #comments-body .list-group-item {
        margin: 0;
        min-height: 80px;
        border: 1px solid 
        #eee;
        overflow-wrap: break-word;
        padding-bottom: 20px;
    }
    #content #comments #comments-body .collection-item {
        border:1px solid #eee;
        
    }
    #content #comments #comments-body .collection-item.active {
        border:1px solid #eee;
        cursor: pointer;
    }

    #sidebar {
        /* background: yellow; */
        width: 25%;
        padding: 1%;
        border-right: 1px solid #eee;
    }
    #sidebar-control{
        height: 5%;
        
    }

    #searchbar {
        height: 27%;
        display: flex;
        flex-direction: column;
       
    }

    #article-data {
        height: 60%;
        overflow: auto;
        border: 2px solid #eee;
    }

    .dataheader {
        list-style: none;
        display: flex;
        margin: 0;
        padding: 0;
        justify-content: space-between;
    }

    #article-data .article-datas {
        margin: 3px 0;
    }

    #article-data .article-datas.active {
        border: 2px solid red;
    }

    .list-group-item {
        position: relative;
    }

    .checkbtn {
        position: absolute;
        right: 10px;
    }

    .disablebtn {
        position: absolute;
        right: 10px;
    }

    #pagination {
        width: 100%;
        /* margin-top: 20px; */
        height: 8%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1rem;

    }
    #pagination > div {
        height: 100%;
        
    }
    #pagination .arrow > *{
        /* width: 15%; */
        color: #2addc7;
        font-size: 3rem;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #pagination #page-mid {
        width: 50%;
    }

    #pagination #page-mid{
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #pagination #page-mid #pagiMid li.active {
        background-color: #2addc7;
    }
    #pagination #page-mid #pagiMid li:hover {
        background-color: #2addc7;
    }

    .backdropEdit {
        width: 100%;
        height: 100vh;
        background: rgba(0, 0, 0, 0.8);
        position: absolute;
        display: flex;
        justify-content: center;
        top: -100vh;
        z-index:300;
    }

    .backdropPost {
        width: 100%;
        height: 100vh;
        background: rgba(0, 0, 0, 0.8);
        position: absolute;
        display: flex;
        justify-content: center;
        top: -100vh;
        z-index: 300;
        
    }

    .forEdit {
        width: 80%;
        height: 100vh;
        background: white;
        padding: 2%;
        margin-top: 0;
        opacity: 1;
    }

    .ck-editor__editable {
        height: 60vh;
        overflow: auto;
    }

    .noshow {
        background: black;
    }

    #ModalBack {
        width: 100%;
        height: 100vh;
        background: rgba(0, 0, 0, 0);
        position: absolute;
        display: flex;
        justify-content: center;
        align-items: center;
        top: -100vh;
        z-index: 500;
    }

    #Modal {
        width: 400px;
        height: 400px;
        border-radius: 10px;
        padding: 2%;
        z-index: 1000;
        background: white;
    }

    #Modal #Modal-hint {
        height: 80%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #Modal #Modal-btn {
        height: 20%;
        display: inline-block;
    }
    .collection-item{
        text-align: center;
    }
    .collection {
       border-radius: 10px;
    }
</style>
<div class="wrapper d-flex">
    <div id="sidebar">
        <div id="sidebar-control" class="d-flex" style="justify-content: space-evenly;">
            <button class="btn waves-effect waves-light" id="postbtn">發新文章</button>
            <button class="btn waves-effect waves-light" id="back-to-top">回到頂端</button>
            <button class="btn waves-effect waves-light" id="reports">查看簡報</button>

        </div>
        <div id="searchbar">
            <form>
                <div class="input-field col s12">

                    <input type="text" id="search" name="search" placeholder="搜尋文章標題">
                    <button class="btn waves-effect waves-light" id="searchbtn">search</button>
                </div>
                <div class="input-field col s8">
                    <select name="type" id="type" style="display: block">
                        <option value="none">ALL</option>
                        <option value="車友新聞">車友新聞</option>
                        <option value="國際賽事">國際賽事</option>
                        <option value="新車上市">新車上市</option>
                        <option value="相關裝備">相關裝備</option>
                    </select>
                </div>
            </form>
        </div>


        <div id="article-data">

        </div>
        <div id="pagination">
            <div id="page-left" class="arrow" style="color: #2addc7;"></div>
            <div id="page-mid" class="">
                <ul class="pagination" id="pagiMid">
                </ul>
            </div>
            <div id="page-right" class="arrow" style="color: #2addc7;"></div>
        </div>

    </div>

    <div id="content" class="d-flex">
        <div class="backdropPost">
            <div class="forEdit">

                <form name="form" method="post" action="./__insert.php" onsubmit="" enctype=multipart/form-data> 
                    <div>
                        <div class="form-group">
                            <label for="title">文章標題</label>
                            <input type="text" name="title" class="form-control" id="postTitle" placeholder="Enter title">
                        </div>
                        <input type="text" name="sid" id="postSid" value="" style="display: none">
                        <input type="text" name="date" id="postDate" style="display: none">
                        <input type="text" name="author" id="postAuthor" style="display: none" value="<?= $adminName ?>">
                        <label for="type">文章分類</label>
                        <select name="type" id="postType" style="display: block">
                        <option value="車友新聞">車友新聞</option>
                        <option value="國際賽事">國際賽事</option>
                        <option value="新車上市">新車上市</option>
                        <option value="相關裝備">相關裝備</option>
                    </div>
                    <div class=".ck-editor__editable" style="height: 50vh;">
                        <textarea name="content" id="editorPost" cols="30" rows="10" placeholder="POST"></textarea>
                    </div>
                    <div>
                    <button type="submit" id="postSubmit" class="btn btn-primary">
                        Submit
                    </button>
                    <button type="" id="postClose" class="btn btn-primary">
                        Close
                    </button>
                    </div>
                </form>
            </div>    
        </div>
        <div class="backdropEdit">
            <div class="forEdit" >

                <form name="form" method="post" action="./__edit.php" onsubmit="" enctype=multipart/form-data target="dummyframe">
                    <div>
                        <div class="form-group">
                            <label for="title">文章標題</label>
                            <input type="text" name="title" class="form-control" id="editTitle" placeholder="Enter title">
                        
                            <input type="text" name="sid" id="editSid" value="" style="display: none">
                            <input type="text" name="hash" id="editHash" value="" style="display: none">
                        </div>
                        
                       
                        <label for="type">文章分類</label>
                        <select name="type" id="editType" style="display: block">
                        <option value="車友新聞">車友新聞</option>
                        <option value="國際賽事">國際賽事</option>
                        <option value="新車上市">新車上市</option>
                        <option value="相關裝備">相關裝備</option>
                    </div>    
                    
                        <div class=".ck-editor__editable" style="height: 50vh;">
                            <textarea name="content" id="editor" cols="30" rows="10" placeholder="Please type in something~"></textarea>
                        </div>
                    
                     <div>
                        <button type="submit" id="editSubmit" class="btn btn-primary">
                            Submit
                        </button>
                        <button type="" id="editClose" class="btn btn-primary">
                            Close
                        </button>
                    </div>
                </form>
                
               
            </div>
        </div>
        
        <div id="news-content">
            <div id="article-info">

            </div>
            <div id="article-body">

            </div>
            <div id="control">

            </div>
        </div>
        <div id="comments">
            <div id="comments-head"> </div>
            <div id="comments-body">
                <ul class="list-group list-group-flush" id="comments-list">

                </ul>
            </div>
            </div>
        </div>
        
    </div>

<div id="ModalBack">
    <div id="Modal">
        <div id="Modal-hint">

        </div>
        <div id="Modal-btn">
            <button class="btn waves-effect waves-light btn-small" id="Modal-yes">YES</button>
            <button class="btn waves-effect waves-light btn-small" id="Modal-no">NO</button>
        </div>
    </div>
</div>
<iframe width="0" height="0" name="dummyframe" id="dummyframe" style="display: none"></iframe>



<script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>

<script src="../ckfinder/ckfinder.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>


<script>
    var newEditor;
    ClassicEditor.create(document.querySelector("#editor"), {
            ckfinder: {
                uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
            },
            toolbar: ['ckfinder', 'imageUpload', '|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo']
        })
        .then(editor => {
            newEditor = editor;
        })
    ClassicEditor.create(document.querySelector("#editorPost"), {
            ckfinder: {
                uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
            },
            toolbar: ['ckfinder', 'imageUpload', '|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo']
        })
        .then(editor => {
            editor = editor;
        })




    let select = document.querySelector("#type");
    let info = document.querySelector("#article-data");
    let pagination = document.querySelector("#pagination");
    let search = document.querySelector("#search");
    let searbtn = document.querySelector("#searchbtn");
    let left = document.querySelector("#page-left");
    let right = document.querySelector("#page-right");
    let midPage = document.querySelector("#pagiMid")
    let control = document.querySelector("#control")
    let editType = document.querySelector("#editType");
    let postbtn = document.querySelector("#postbtn");
    let postSubmit = document.querySelector("#postSubmit");
    let postClose = document.querySelector("#postClose");
    let backdrop = document.querySelector(".backdropEdit");
    let backdropPost = document.querySelector(".backdropPost");
    let backToTop = document.querySelector("#back-to-top");
    let modalBack = document.querySelector("#ModalBack");
    let modalInfo = document.querySelector("#Modal-hint");
    let modalBtn = document.querySelector("#Modal-btn");
    let editedArticleId = null;

    let comments = [];

    const renderDOM = () => {
        let form = document.querySelector("form");
        if (search.value === "") {
            search.value === "none";
        }
        let formData = new FormData(form);
        let page = parseInt(location.hash.slice(1));
        if (!page) page = 1;
        if (isNaN(page)) page = 1;
        fetch(`test_list_api.php?page=${page}`, {
                method: "post",
                body: formData
            })
            .then(res => res.json())
            .then(obj => {
                if (obj["data"].length != 0) {
                    console.log(obj["data"]);
                    renderHtml(obj["data"]);
                    renderBtn(obj["totalPages"], obj["page"], obj["perPage"], obj["totalRows"]);
                    renderSide(obj["page"], obj["totalRows"], obj["perPage"], obj["totalPages"])


                } else {
                    info.innerHTML = `<div id="no-data">NO DATA</div>`;
                    left.innerHTML = "";
                    right.innerHTML = "";
                    midPage.innerHTML = "";
                }

                
            })

    }
    const renderTop = () => {
        fetch("./test_list_api2.php").then(res => res.json()).then(json => {
            console.log(json);
            let html = ""
            for (let key of Object.keys(json)) {
                if (key === "totalviews") break;
                html += `<ul class="collection">
                        <li class="collection-item active">文章分類:${key}</li>
                        <li class="collection-item">文章數量:${json[key]["count"]}</li>
                        <li class="collection-item">文章閱覽人數:${json[key]["views"]}</li>
                        </ul>`
          
            }
            html += `<ul class="collection">
                        <li class="collection-item active"><h5 style="text-align: center">總閱覽人數:${json["totalviews"]}</h5></li>
                        </ul>`
            $("#article-body").html(html);
            html =`<ul class="collection" style="border-radius: 10px;">
                        <li class="collection-item" style="font-weight: bold; text-align: center; background: #eee;"><h5 style="text-align: center; ">相關統計</h5></li>
                        </ul>`
            $("#article-info").html(html);
            html = `<ul class="collection" style="border-radius: 10px;">
                        <li class="collection-item" style="font-weight: bold;background: #eee;"><h5 style="text-align: center">熱門文章</h5></li>
                        </ul>`   
            $("#comments-head").html(html);         
            console.log(json["top10"])
            html = `<ul class="collection">`;
            json["top10"].map(data => {
               html += `<li class="collection-item active tophead">文章標題: <span>${data["title"]}</span></li><li class="collection-item">閱覽數: ${data["views"]}人</li>`
            })
            html += `</ul>`
            $("#comments-body ul").html(html);    
            let heads = document.querySelectorAll(".tophead");
            heads.forEach(head => {
                head.addEventListener("click", function(){
                    console.log($(this).find("span").text());
                    $("#search").val($(this).find("span").text());
                })
            })     
        })

        $("#article-info").html("");
        $("#comments-head").html("");
        $("#comments-body ul").html("");
        $("#control").html("");
    }
    renderTop();
    const renderSide = (page, length, perPage, totalPage) => {
        let html = "";

        html += `<a class="" href="#1" ${page == 1? 'style="display: none"' : ""}>
        <span aria-hidden="true"><i class="fas fa-angle-double-left"></i></span>
      </a>`
        left.innerHTML = html;
        html = "";
        html += `<a class="" href="#${totalPage}" ${page == totalPage? 'style="display: none"' : ""} aria-label="Previous">
      <span aria-hidden="true"><i class="fas fa-angle-double-right"></i></span>
      </a>`

        right.innerHTML = html;

    }

    const renderHtml = (data) => {
        let html = ""
        data.map(obj => {
            return html += `<div class="article-datas" style="width: 100%; border: 1px solid transparent; transition: 0.5s">
                <div class="card-header" style="background: #eee" >
                    <ul class="dataheader">
                        <li>分類:${obj["type"]}</li>
                        <li>發表時間:${obj["date"]}</li>
                    </ul>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" >標題:${obj["title"]}<button id="${obj["sid"]}" type="button" class="checkbtn btn waves-effect waves-light btn-small">查看內容</button></li>
                    <li class="list-group-item" style="position: relative" >文章狀態:${obj["disable"] == 0 ? "上架" : "下架"}<button class="disablebtn btn waves-effect waves-light btn-small" data-disable="${obj["disable"]}" data-sid="${obj["sid"]}">${obj["disable"] == 0? "文章下架" : "文章上架"}</button></li>
                </ul>
            </div>`;
        });
        info.innerHTML = html;
        let checkbtns = document.querySelectorAll(".checkbtn");
        checkbtns.forEach(btn => btn.addEventListener("click", renderArticleBody));
        let disablebtns = document.querySelectorAll(".disablebtn");
        disablebtns.forEach(btn => btn.addEventListener("click", toggleDisable));
    }

    let toggleDisable = (event) => {
        let eventName = "toggleDisable";
        let eventInfo = "確認要變更上/下架狀態?"
        let disable;
        event.preventDefault();
        event.stopPropagation();
        console.log(typeof event.target.getAttribute("data-disable"));

        (function confirmModal(eventName, eventInfo, eventTarget, disable) {
            console.log(eventTarget);
            let modalBack = document.querySelector("#ModalBack");
            modalBack.style.transform = "translateY(100vh)";
            let modalInfo = document.querySelector("#Modal-hint");
            let modalNo = document.querySelector("#Modal-no")
            let modalYes = document.querySelector("#Modal-yes")
            modalInfo.textContent = eventInfo;
            modalBtn.style.display = "block";
            modalNo.addEventListener("click", () => {
                event.preventDefault();
                event.stopPropagation();
                modalInfo.textContent = "未變更!";
                setTimeout(() => {
                    modalBack.style.transform = "translateY(-100vh)";
                }, 1000);
                return;
            })
            modalYes.addEventListener("click", () => {
                event.preventDefault();
                event.stopPropagation();
                modalInfo.textContent = "變更成功!";
                setTimeout(() => {
                    modalBack.style.transform = "translateY(-100vh)";
                }, 1000);
                if (eventTarget.getAttribute("data-disable") == 0) {
                    disable = "1";
                } else {
                    disable = "0";
                }
                fetch("__toggle_disable.php", {
                    method: "post",
                    headers: new Headers({
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }),
                    body: `sid=${eventTarget.getAttribute("data-sid")}&disable=${disable}`
                }).then(res => res.json()).then(json => {
                    console.log(json)
                    renderDOM()
                });;
                return;
            })

        })(eventName, eventInfo, event.target, disable);

        // if (event.target.getAttribute("data-disable") === "0") {
        //     disable = "1";
        // } else {
        //     disable = "0";
        // }
        // fetch("__toggle_disable.php", {
        //     method: "post",
        //     headers: new Headers({
        //         'Content-Type': 'application/x-www-form-urlencoded'
        //     }),
        //     body: `sid=${event.target.getAttribute("data-sid")}&disable=${disable}`
        // }).then(res => res.json()).then(json => console.log(json));
        // renderDOM();

    }


    let backToTopHandler = () => {

        location.hash = 1;
        search.value = "";
        select.value = "none";
        renderDOM();
    }



    let editArticle = () => {
        let editSubmit = document.querySelector("#editSubmit");
        let editClose = document.querySelector("#editClose");
        let articleBody = document.querySelector("#article-body")
        newEditor.setData(`${articleBody.innerHTML}`);
        backdrop.style.transform = "translateY(100vh)";
        editSubmit.addEventListener("click", (event) => {
            event.stopPropagation();
            modalBack.style.transform = "translateY(100vh)";
            modalInfo.innerHTML = "<p>編輯完成!</p>"
            modalBtn.style.display = "none";
            modalInfo.style.fontSize = "1rem";
            // modalInfo.style.color = "red"
            setTimeout(() => {
                backdrop.style.transform = "translateY(-100vh)";
                modalBack.style.transform = "translateY(-100vh)";

            }, 1000)
            setTimeout(() => {
                renderDOM();
                renderArticleBody(editedArticleId);
                modalInfo.style = "";
            }, 1500)

        })
        editClose.addEventListener("click", (event) => {
            event.preventDefault();
            event.stopPropagation();
            backdrop.style.transform = "translateY(-100vh)";
        })

    }

    function renderArticleBody(event) {
        editedArticleId = event;
        event = event == null ? editedArticleId : event;
        $(this).parent().parent().parent().siblings().css("border", "2px solid transparent");
        $(this).parent().parent().parent().css("border", "2px solid #e14040");
        if (backdropPost.style.webkitTransform == "translateY(100vh)") {
            backdropPost.style.transform = "translateY(-100vh)"
        }

        fetch("__get_article.php", {
            method: "post",
            headers: new Headers({
                'Content-Type': 'application/x-www-form-urlencoded',
                'location': 'listtest.php',
            }),
            body: `sid=${event.target.id}`
        }).then(res => res.json()).then(json => {
            let articleInfo = document.querySelector("#article-info");
            articleInfo.innerHTML = `<ul class="collection">
                                    <li class="collection-item" style="background: #eee;">閱覽人數: ${json["views"] == null? "0" : json["views"]}人</li>
                                    <li class="collection-item" style="background: #eee;">作者: ${json["author"]}</li>
                                    </ul>`
            let articleBody = document.querySelector("#article-body");
            articleBody.innerHTML = json["text"];
            control.innerHTML = '<button id="editbtn" type="button" class="btn btn-primary">編輯文章</button>';
            let editbtn = document.querySelector("#editbtn");
            editbtn.addEventListener("click", editArticle);
            let editTitle = document.querySelector("#editTitle");
            // console.log(json["title"]);
            editTitle.value = json["title"];
            let editSid = document.querySelector("#editSid");
            editSid.value = json["sid"];
            editType.childNodes.forEach(node => {
                if (node["value"] == json["type"]) {
                    node.setAttribute("selected", "true");
                }
                let editHash = document.querySelector("#editHash");
                editHash.value = parseInt(location.hash.slice(1));
                // console.log(editHash.value);
            })
            //render comment
            console.log("123")
            let commentBody = document.querySelector("#comments-body");
            console.log(json["comment"]);
            console.log(JSON.parse(json["comment"]));
            comments = JSON.parse(json["comment"]);
            console.log(JSON.stringify(comments));
            let commentsList = document.querySelector("#comments-list");
            let html = ""
            if (comments != null) {
                comments.map(comment => {
                    return html += `<li class="list-group-item ${comment["disable"] == 0? "" : "noshow"}" style="position: relative; transition: 0.5s; ${comment["disable"] == 0? "" : "color: red"}">${comment["text"]}<button id="${json["sid"]}c" class="commentdisablebtn btn waves-effect waves-light" data-disable="${comment["disable"]}" data-id="${comment["id"]}" data-toggle="modal" data-target="#exampleModal" style="position: absolute; right: 10px">${comment["disable"] == 0? "不顯示留言" : "顯示留言"}</button></li>
                <li class="list-group-item" style="position: relative">${comment["reply"]}<button class="commentreplybtn btn waves-effect waves-light" data-id="${comment["id"]}"  style="position: absolute; right: 10px">${comment["reply"].length == 0? "回覆留言" : "修改回覆"}</button></li>
                <div class="input-field" style="height: 0; overflow: hidden; transition: 0.5s; "><input type="text" value="${comment["reply"]}"><button id="${json["sid"]}r" class="replysubmit btn waves-effect waves-light" data-id="${comment["id"]}">確認</button></div>
                `;

                })
            } else {

                html = "目前沒有留言"
            }
            commentsList.innerHTML = html;
            let commentsHead = document.querySelector("#comments-head");
            commentsHead.innerHTML = `<ul class="collection" style="background: #26A69A">
                                    <li class="collection-item" style="background: #eee;">文章留言</li>
                                    </ul>`;
            let disableCommentBtns = document.querySelectorAll(".commentdisablebtn");
            disableCommentBtns.forEach(btn => {
                btn.addEventListener("click", toggleComment);
            })
            let replyCommentBtns = document.querySelectorAll(".commentreplybtn");
            replyCommentBtns.forEach(btn => {
                btn.addEventListener("click", replyComment);
            })
            let replySubmitBtns = document.querySelectorAll(".replysubmit");
            replySubmitBtns.forEach(btn => {
                btn.addEventListener("click", submitReply);
            })

        });
    }

    function replyComment(event) {
        event.stopPropagation();
        let input = $(this).parent().next();
        if (input.css("height") == "0px") {
            $(this).parent().next().css({
                "height": "100px",
                "overflow": "auto"
                
            })
        } else {
            $(this).parent().next().css({
                "height": "0px",
                "overflow": "hidden"
            })
        }

    }

    function submitReply(event) {
        event.stopPropagation();
        event.preventDefault();
        // console.log($(this).prev().val());
        // console.log(comments);
        // console.log(this.getAttribute("data-id"));
        comments.forEach(comment => {
            if (comment["id"] == this.getAttribute("data-id")) {
                comment["reply"] = $(this).prev().val();
            }
        })

        let id = parseInt(this.id);
        fetch("__reply_comment_api.php", {
            method: "post",
            headers: new Headers({
                'Content-Type': 'application/x-www-form-urlencoded'
            }),
            body: `sid=${id}&comment=${JSON.stringify(comments)}`
        }).then(res => res.json()).then(json => {
            console.log(json)
            renderArticleBody(editedArticleId);
        });

    }


    const toggleComment = (event) => {
        event.stopPropagation();
        event.preventDefault();
        id = parseInt(event.target.id);
        console.log(comments);
        let editedComments = comments.map(comment => {
            if (comment["id"] == event.target.getAttribute("data-id")) {
                if (comment["disable"] == 0) {
                    comment["disable"] = 1;
                } else {
                    comment["disable"] = 0;
                }
            }

            return comment;

        })
        console.log(editedComments);
        let commentData = JSON.stringify(editedComments);
        fetch("__toggle_comment.php", {
            method: "post",
            headers: new Headers({
                'Content-Type': 'application/x-www-form-urlencoded'
            }),
            body: `sid=${id}&comment=${commentData}`
        }).then(res => res.text()).then(text => {
            renderArticleBody(editedArticleId)
        });
    }


    const renderBtn = (totalPage, page, perPage, length) => {
        console.log(totalPage, page, perPage, length);
        let html = ""
        if (totalPage > 5) {
            if (page > 1) {
                html += `<li class="${i == page? "active" : "waves-effect"}"><a class="" href="#${(totalPage - page < 4 ? (totalPage - 5) : page - 1)}">${(totalPage - page < 4 ? (totalPage - 5) : page - 1)}</a></li>`
            }
            for (var i = (totalPage - page < 4 ? (totalPage - 4) : page); i <= (totalPage - page < 4 ? (totalPage) : page + 4); i++) {
                html += `<li class="${i == page? "active" : "waves-effect"}"><a class="" href="#${i}">${i}</a></li>`
            }
            if (page == 1) {
                html += `<li class="${i == page? "active" : "waves-effect"}"><a class="" href="#6">6</a></li>`
            }
        } else {
            for (let i = 1; i <= totalPage; i++) {
                html += `<li class="${i == page? "active" : "waves-effect"}"><a class="" href="#${i}">${i}</a></li>`
            }
        }
        //if (totalPage == 0) html = "";

        midPage.innerHTML = html;
    }

    let confirmModal = (eventName, eventInfo) => {
        let modalBack = document.querySelector("#ModalBack");
        modalBack.style.transform = "translateY(100vh)";
        let modalInfo = document.querySelector("#Modal-hint");
        let modalNo = document.querySelector("#Modal-no")
        let modalYes = document.querySelector("#Modal-yes")
        modalInfo.textContent = eventInfo;
        modalNo.addEventListener("click", () => {
            modalInfo.textContent = "未變更!";
            setTimeout(() => {
                modalBack.style.transform = "translateY(-100vh)";
            }, 1000);
            return false;
        })
        modalYes.addEventListener("click", () => {
            modalInfo.textContent = "變更成功!";
            setTimeout(() => {
                modalBack.style.transform = "translateY(-100vh)";
            }, 1000);
            return true;
        })

    }

    if (search.value === "" && select.value === "none") renderDOM();

    window.addEventListener("hashchange", renderDOM);

    select.addEventListener("change", (event) => {
        location.hash = 1;
        event.preventDefault();
        event.stopPropagation();
        renderDOM()
    });
    searbtn.addEventListener("click", (event) => {
        location.hash = 1;
        event.preventDefault();
        event.stopPropagation();
        renderDOM();
    });

    backToTop.addEventListener("click", backToTopHandler);

    postbtn.addEventListener("click", (event) => {
        event.stopPropagation();
        backdropPost.style.transform = "translateY(100vh)";
    })
    postClose.addEventListener("click", (event) => {
        event.preventDefault();
        event.stopPropagation();
        backdropPost.style.transform = "translateY(-100vh)";
    })
    postSubmit.addEventListener("click", (event) => {
        event.stopPropagation();
            modalBack.style.transform = "translateY(100vh)";
            modalInfo.innerHTML = "<p>發文完成!</p>"
            modalBtn.style.display = "none";
            modalInfo.style.fontSize = "1rem";
            // modalInfo.style.color = "red"
            setTimeout(() => {
                backdrop.style.transform = "translateY(-100vh)";
                modalBack.style.transform = "translateY(-100vh)";

            }, 1000)
            setTimeout(() => {
                renderDOM();
                modalInfo.style = "";
            }, 1500)

    })
       
   

    postSubmit.addEventListener("click", () => {
        let date = new Date();
        let year = date.getFullYear();
        console.log(year);
        let month = date.getMonth() + 1;
        let day = date.getDate();
        let submitDate = document.querySelector("#postDate")
        submitDate.value = `${year}/${month}/${day}`;
    })
    $("#reports").click(function(){
        renderTop();
    })
</script>
</body> 
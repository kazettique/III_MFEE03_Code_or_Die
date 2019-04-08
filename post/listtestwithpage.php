<?php include __DIR__ . "./header_html.php"; ?>
<?php include __DIR__ . '/../_navbar.php'; ?>
<link rel="stylesheet" href="./list.css">

<div class="wrapper d-flex">
    <div id="sidebar">
        <div id="sidebar-control" class="d-flex" style="justify-content: space-evenly; margin-bottom: 10px;">
            <button id="postbtn">發新文章</button>
            <button id="back-to-top">回到頂端</button>
        </div>
        <div id="searchbar">
            <form>
                <label for="search">搜尋文章標題</label>
                <input type="text" id="search" name="search">
                <button id="searchbtn">search</button>
                <label for="select">搜尋文章分類</label>
                <select name="type" id="type">
                    <option value="none">ALL</option>
                    <option value="test">test</option>
                    <option value="test1">test1</option>
                    <option value="newbike">新車上市</option>
                    <option value="news">車友新聞</option>
                </select>
            </form>
        </div>


        <div id="article-data">

        </div>
        <div id="pagination">
            <div id="page-left" class="arrow"></div>
            <div id="page-right" class="arrow"></div>
        </div>

    </div>

    <div id="content" class="d-flex">
        <div id="news-content">
            <div id="article-info">
                <div id="fake-page"></div>
            </div>
            <div id="article-body">

            </div>
            <div id="control">

            </div>
        </div>
        <div id="comments">
            <div id="comments-head">文章留言</div>
            <div id="comments-body">
                <ul class="list-group list-group-flush" id="comments-list">

                </ul>
            </div>
        </div>
    </div>

</div>

<div class="backdropEdit">
    <div class="forEdit">

        <form name="form" method="post" action="./__edit.php" onsubmit="" enctype=multipart/form-data> <div>
            <div class="form-group">
                <label for="title">文章標題</label>
                <input type="text" name="title" class="form-control" id="editTitle" placeholder="Enter title">
            </div>
            <input type="text" name="sid" id="editSid" value="" style="display: none">
            <input type="text" name="hash" id="editHash" value="" style="display: none">
            <label for="type">文章分類</label>
            <select name="type" id="editType">
                <option value="none">-----</option>
                <option value="test">test</option>
                <option value="test1">test1</option>
    </div>
    <div id="editTextArea" class=".ck-editor__editable" style="height: 300px;">
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

<div class="backdropPost">
    <div class="forEdit">

        <form name="form" method="post" action="./__insert.php" onsubmit="" enctype=multipart/form-data> <div>
            <div class="form-group">
                <label for="title">文章標題</label>
                <input type="text" name="title" class="form-control" id="postTitle" placeholder="Enter title">
            </div>
            <input type="text" name="sid" id="postSid" value="" style="display: none">
            <label for="type">文章分類</label>
            <select name="type" id="postType">
                <option value="none">-----</option>
                <option value="test">test</option>
                <option value="test1">test1</option>
                <option value="test2">test2</option>
                <option value="test3">test3</option>
    </div>
    <div class=".ck-editor__editable" style="height: 300px;">
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

</div>


<script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>
<script src="../ckfinder/ckfinder.js"></script>
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
    let control = document.querySelector("#control")
    let editType = document.querySelector("#editType");
    let postbtn = document.querySelector("#postbtn");
    let postSubmit = document.querySelector("#postSubmit");
    let postClose = document.querySelector("#postClose");
    let backdrop = document.querySelector(".backdropEdit");
    let backdropPost = document.querySelector(".backdropPost");
    let backToTop = document.querySelector("#back-to-top");

    let fakePage = document.querySelector("#fake-page")
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
                    renderHtml(obj["data"]);
                    // renderBtn(obj["totalPages"], obj["page"], obj["perPage"], obj["totalRows"]);
                    renderSide(obj["page"], obj["totalRows"], obj["perPage"], obj["totalPages"])
                    renderBtn(obj["totalPages"], obj["page"], obj["perPage"], obj["totalRows"])
                } else {
                    info.innerHTML = `<div id="no-data">NO DATA</div>`;
                    left.innerHTML = "";
                    right.innerHTML = "";
                    renderBtn(obj["totalPages"], obj["page"], obj["perPage"], obj["totalRows"])
                }


            })

    }


    const renderSide = (page, length, perPage, totalPage) => {
        let html = "";
        html += `<a class="" href="#${(page - 1 < 1 ? 1 : page - 1)}" ${page == 1? 'style="display: none"' : ""} aria-label="Previous">
      <span aria-hidden="true"><i class="fas fa-angle-left"></i></span>
      </a>`
        html += `<a class="" href="#1" ${page == 1? 'style="display: none"' : ""} aria-label="Previous">
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
            return html += `<div class="article-datas" style="width: 100%;">
                <div class="card-header">
                    <ul class="dataheader">
                        <li>分類:${obj["type"]}</li>
                        <li>發表時間:${obj["date"]}</li>
                    </ul>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" >標題:${obj["title"]}<button id="${obj["sid"]}" type="button" class="checkbtn btn-primary">查看內容</button></li>
                    <li class="list-group-item" style="position: relative" >文章狀態:${obj["disable"] == 0 ? "上架" : "下架"}<button class="disablebtn btn-primary" data-disable="${obj["disable"]}" data-sid="${obj["sid"]}">${obj["disable"] == 0? "文章下架" : "文章上架"}</button></li>
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
        let disable;
        event.preventDefault();
        event.stopPropagation();
        console.log(typeof event.target.getAttribute("data-disable"));
        if (event.target.getAttribute("data-disable") === "0") {
            disable = "1";
        } else {
            disable = "0";
        }
        fetch("__toggle_disable.php", {
            method: "post",
            headers: new Headers({
                'Content-Type': 'application/x-www-form-urlencoded'
            }),
            body: `sid=${event.target.getAttribute("data-sid")}&disable=${disable}`
        }).then(res => res.json()).then(json => console.log(json));
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
            event.preventDefault();
            event.stopPropagation();
            backdrop.style.transform = "translateY(-100vh)";
        })
        editClose.addEventListener("click", (event) => {
            event.preventDefault();
            event.stopPropagation();
            backdrop.style.transform = "translateY(-100vh)";
        })

    }

    const renderArticleBody = (event) => {

        fetch("__get_article.php", {
            method: "post",
            headers: new Headers({
                'Content-Type': 'application/x-www-form-urlencoded',
            }),
            body: `sid=${event.target.id}`
        }).then(res => res.json()).then(json => {
            let articleInfo = document.querySelector("#article-info");
            articleInfo.innerHTML = `<span>閱覽人數: ${json["views"]}人</span>`
            let articleBody = document.querySelector("#article-body");
            articleBody.innerHTML = json["text"];
            control.innerHTML = '<button id="editbtn" type="button" class="btn btn-primary">編輯文章</button>';
            let editbtn = document.querySelector("#editbtn");
            editbtn.addEventListener("click", editArticle);
            let editTitle = document.querySelector("#editTitle");
            console.log(json["title"]);
            editTitle.value = json["title"];
            let editSid = document.querySelector("#editSid");
            editSid.value = json["sid"];
            editType.childNodes.forEach(node => {
                if (node["value"] == json["type"]) {
                    node.setAttribute("selected", "true");
                }
                let editHash = document.querySelector("#editHash");
                editHash.value = parseInt(location.hash.slice(1));
                console.log(editHash.value);
            })
            let commentBody = document.querySelector("#comments-body");
            console.log(JSON.parse(json["comment"]));
            let comments = JSON.parse(json["comment"]);
            let commentsList = document.querySelector("#comments-list");
            let html = ""
            comments.map(comment => {
                return html += `<li class="list-group-item">${comment["text"]}</li>`;
            })
            commentsList.innerHTML = html;
        });
    }



    const renderBtn = (totalPage, page, perPage, length) => {
        console.log(totalPage, page, perPage, length);
        let html = ""
        if (totalPage > 5) {
            if (page > 1) {
                html += `<li class="page-item"><a class="" href="#${(totalPage - page < 4 ? (totalPage - 5) : page - 1)}">${(totalPage - page < 4 ? (totalPage - 5) : page - 1)}</a></li>`
            }
            for (let i = (totalPage - page < 4 ? (totalPage - 4) : page); i <= (totalPage - page < 4 ? (totalPage) : page + 4); i++) {
                html += `<li class="page-item"><a class="" href="#${i}">${i}</a></li>`
            }
            if (page == 1) {
                html += `<li class="page-item"><a class="" href="#6">6</a></li>`
            }
        } else {
            for (let i = 1; i <= totalPage; i++) {
                html += `<li class="page-item"><a class="" href="#${i}">${i}</a></li>`
            }
        }
        fakePage.innerHTML = html;
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
        console.log("click")
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
        backdropPost.style.transform = "translateY(-100vh)";
    })
</script>
</body> 
<?php include "../login/cred.php"; ?>
<link rel="stylesheet" href="../resources/bootstrap_customised/css/bootstrap.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP|Noto+Sans+KR|Noto+Sans+TC" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="../resources/css/utilities.css">
<link rel="stylesheet" href="../resources/css/backend_main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
<style>
    body {
        background: url("./back.png") center center no-repeat;
    }
</style>
<div id="wrap" class="d-flex justify-content-between">
    <div class="p-0 sidebar-wrap transition">
        <div class="sidebar-menu transition">
            <div class="bar bar1 transition"></div>
            <div class="bar bar2 transition"></div>
            <div class="bar bar3 transition"></div>
        </div>
        <div class="card border-0 sidebar">
            <div class="sidebar-logo d-flex justify-content-center ">
                <img src="../resources/images/route-page-title2.svg" class="img-fluid"></img>
            </div>
            <div class="d-flex flex-column align-items-center position-relative mt-5 mb-3">
                <p class="bgc-green badge position-absolute profile-tag fs-1 color-white t-0">普通管理員</p>
                <a href="" class="bgc-testing profile-pic my-2"><img src="../resources/images/螢幕快照 2018-09-11 下午6.58.14.png" alt=""></a>
                <p class="my-1 font-weight-bold fs-1-3 d-flex align-items-center">
                    <span class="pl-2"><?= $adminName ?></span>
                    <a href="" class="ml-2 fs-1"><i class="fas fa-edit"></i></a>
                </p>
            </div>
            <div class="links">
                <a href="" class="d-flex align-items-center transition"><i class="material-icons">home</i></svg>概況</a>
                <a href="/III_MFEE03_Code_or_Die/member/data_list2FOR0408.php" class="d-flex align-items-center transition"><i class="material-icons">group</i></svg>會員管理</a>
                <a href="/III_MFEE03_Code_or_Die/course/data_list.php" class="d-flex align-items-center transition"><i class="material-icons">school</i>課程管理</a>
                <a href="/III_MFEE03_Code_or_Die/program-test/event_list.php" class="d-flex align-items-center transition"><i class="material-icons">today</i>活動管理</a>
                <a href="/III_MFEE03_Code_or_Die/route/display.php" class="d-flex align-items-center transition"><i class="material-icons">place</i>路線管理</a>
                <a href="/III_MFEE03_Code_or_Die/prouduct/p_data_list2.php" class="d-flex align-items-center transition"><i class="material-icons">playlist_add</i>商品管理</a>
                <a href="/III_MFEE03_Code_or_Die/post/listtest.php" class="d-flex align-items-center transition"><i class="material-icons">edit</i>文章管理</a>
            </div>
            <a class="log-out d-flex align-items-center transition" id="logout">
                <i class="material-icons mr-2 pt-1 fs-1-3">power_settings_new</i>
                <span>登出</span>
            </a>

        </div>
        <div class="h-100 sidebar-arrows">
            <div id="sright" class="p-4 sidebar-right fs-1-5"><i class="fas fa-caret-right bounce"></i></div>
            <div class="p-4 sidebar-left fs-1-5 display-none"><i class="fas fa-caret-left"></i></div>
        </div>

    </div>

    <script src="../resources/js/underscore.js"></script>
    <script src="../resources/js/jquery-3.3.1.js"></script>
    <script src="../resources/bootstrap_customised/js/bootstrap.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
    <script>
        // (function(){
        //     $('.sidebar').toggleClass('off')
        //     $('.sidebar-left').removeClass('display-none');
        //     $('.sidebar-right').addClass('display-none')})();  
        // $("a").click(function(){
        //     $('.sidebar').toggleClass('off')
        //     $('.sidebar-right').removeClass('display-none');
        //     $('.sidebar-left').addClass('display-none');
        // })  
        (function() {
            $("#sright").css({
                "color": "red",
                "font-size": "4rem"
            });
            setTimeout(() => {
                $("#sright").css({
                    "color": "black",
                    "font-size": "3rem"
                })
            }, 2000);
        })();
        $(".fa-caret-right").addClass('animated');
        $('.sidebar-right').click(function() {
            $('.sidebar').toggleClass('off')
            $('.sidebar-left').removeClass('display-none');
            $(this).addClass('display-none');
        });
        $('.sidebar-left').click(function() {
            $('.sidebar').toggleClass('off')
            $('.sidebar-right').removeClass('display-none');
            $(this).addClass('display-none');
        })
        $('.sidebar-menu').click(function() {
            event.stopPropagation();
            $(this).toggleClass('active')
            $('.sidebar').toggleClass('offv')
            $('.sidebar-wrap').toggleClass('offv')
        })
        $("#logout").click(function() {
            Swal.fire({
                title: '確認要登出?',
                text: "",
                type: '',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '登出'
            }).then((result) => {
                if (result.value) {
                    Swal.fire(
                        '登出成功',
                        '請按確認鍵繼續',
                        'success'
                    ).then((result) => {
                        if (result.value) {
                            fetch("../login/__logout_api.php").then(res => {
                                location.reload()
                            })
                        }
                    });

                }
            })
        })
    </script>
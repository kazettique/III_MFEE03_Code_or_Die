<?php
require __DIR__. '/p__connect.php';
$page_name = '_insert2';

?>
<?php include __DIR__."/p__html_head.php" ;?>
<!-- siedbar 不消失 -->
<div id="wrap" class="d-flex justify-content-between">
        <div class="p-0 sidebar-wrap transition">
            <div class="sidebar-menu transition">
                <div class="bar bar1 transition"></div>
                <div class="bar bar2 transition"></div>
                <div class="bar bar3 transition"></div>
            </div>
            <div class="card border-0 sidebar off">
                <div class="sidebar-logo d-flex justify-content-center ">
                    <img src="./resources/images/route-page-title.svg" class="img-fluid">
                </div>
                <div class="d-flex flex-column align-items-center position-relative mt-5 mb-3">
                    <p class="bgc-green badge position-absolute profile-tag fs-1 color-white t-0">普通管理員</p>
                    <a href="" class="bgc-testing profile-pic my-2"><img src="resources/images/螢幕快照 2018-09-11 下午6.58.14.png" alt=""></a>
                    <p class="my-1 font-weight-bold fs-1-3 d-flex align-items-center">
                        <span class="pl-2">Admin</span>
                        <a href="" class="ml-2 fs-1"><i class="fas fa-edit"></i></a>
                    </p>
                </div>
                <div class="links">
                    <a href="" class="d-flex align-items-center transition"><i class="material-icons">group</i></svg>概況</a>
                    <a href="" class="d-flex align-items-center transition"><i class="material-icons">group</i></svg>會員管理</a>
                    <a href="" class="d-flex align-items-center transition"><i class="material-icons">school</i>課程管理</a>
                    <a href="" class="d-flex align-items-center transition"><i class="material-icons">today</i>活動管理</a>
                    <a href="" class="d-flex align-items-center transition"><i class="material-icons">place</i>路線管理</a>
                    <a href="p_data_list2.php" class="d-flex align-items-center transition"><i class="material-icons">playlist_add</i>商品管理</a>
                    <a href="" class="d-flex align-items-center transition"><i class="material-icons">edit</i>文章管理</a>
                </div>
                <a class="log-out d-flex align-items-center transition">
                    <i class="material-icons mr-2 pt-1 fs-1-3">power_settings_new</i>
                    <span>登出</span>
                </a>

            </div>
            <!-- <div class="h-100 sidebar-arrows">
                <div class="p-4 sidebar-right fs-1-5"><i class="fas fa-caret-right"></i></div>
                <div class="p-4 sidebar-left fs-1-5 display-none"><i class="fas fa-caret-left"></i></div>
            </div> -->

        </div>


        
           
        </div>
    </div>
<!-- 不消失 -->

<div class="container-fulid">

    <div class="row" style="width: 40%;">
        <div class="col-lg-10" style="margin:0">

        <div id="info_bar" class="alert alert-success" role="alert" style="display: none">
            </div>

            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">新增資料</h5>
                    <!-- <form action="doAction.php" method="post" enctype="multipart/form-data">
                                <!-- 限制上傳檔案的最大值 -->
                                <!-- <input type="hidden" name="MAX_FILE_SIZE" value="2097152"> -->

                                <!-- accept 限制上傳檔案類型。多檔案上傳 name 的屬性值須定義為 array -->
                                
                                <!-- <input type="file" name="myFile[]" accept="image/jpeg,image/jpg,image/gif,image/png" style="display: block;margin-bottom: 5px;">
                                <input type="file" name="myFile[]" accept="image/jpeg,image/jpg,image/gif,image/png" style="display: block;margin-bottom: 5px;"> -->

                                <!-- 使用 html 5 實現單一上傳框可多選檔案方式，須新增 multiple 元素 -->
                                <!-- <input type="file" name="myFile[]" id="" accept="image/jpeg,image/jpg,image/gif,image/png" multiple> -->

                                <!-- <input type="submit" value="上傳檔案">
                            </form> -->

                            <img src="" alt="" id="photo" width="100%" >
                    <form id="form1" name="form1" method="post"   onsubmit="return checkForm();" enctype="multipart/form-data">
                        
                        
                        
                        
                        <input type="hidden" name="checkme" value="check123"> 
                        <div class="form-group">
                            <label for="photo">商品照片</label>
                            <input type="file" class="form-control-file" id="p_photo" name="p_photo" placeholder="" accept="image/*">
                            <small id="photoHelp" class="form-text text-muted"></small>
                        </div>


                



                        <div class="form-group">
                            <label for="p_name">商品名稱</label>
                            <input type="text" class="form-control" id="p_name" name="p_name" placeholder=""
                                   value="">
                            <small id="nameHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="quantity">數量</label>
                            <input type="text" class="form-control" id="quantity" name="quantity" placeholder=""
                                   value="">
                            <small id="quantityHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="p_description">說明</label>
                            <textarea class="form-control" id="p_description" name="p_description" cols="30" rows="3"></textarea>
                            <small id="descriptionHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="p_price">價格</label>
                            <input type="text" class="form-control" id="p_price" name="p_price" placeholder=""
                                   value="">
                            <small id="priceHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="genre">商品類別</label>
                            <!-- <input type="text" class="form-control" id="genre" name="genre" placeholder=""
                                   value=""> -->
                                   <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="p_genre">商品類別</label>
                                    </div>
                                    <select class="custom-select" id="p_genre" name="p_genre">
                                        <option selected>Choose...</option>
                                        <option value="公路車">公路車</option>
                                        <option value="單速車">單速車</option>
                                        <option value="特技車">特技車</option>
                                    </select>
                                    </div>
                            <small id="genreHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                        <label for="genre2">商品部件</label>
                        <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="p_genre2">商品部件</label>
                                    </div>
                                    <select class="custom-select" id="p_genre2" name="p_genre2">
                                        <option selected>Choose...</option>
                                        <option value="全車">全車</option>
                                        <option value="車架">車架</option>
                                        <option value="握把.龍頭">握把.龍頭</option>
                                        <option value="坐墊.坐管">坐墊.坐管</option>
                                        <option value="齒盤/曲柄">齒盤/曲柄</option>
                                        <option value="煞車零件">煞車零件</option>
                                        <option value="鍊條">鍊條</option>
                                        <option value="輪胎">輪胎</option>
                                        <option value="踏板">踏板</option>
                                    </select>
                                    </div>
                            <small id="genreHelp" class="form-text text-muted"></small>
                        </div>
                        
                                <!-- 原本商品部件 -->
                    
                        <!-- <div class="form-group">
                            <label for="genre2">商品物件</label>
                            <input type="text" class="form-control" id="genre2" name="p_genre2" placeholder=""
                                   value="">
                            <small id="genre2Help" class="form-text text-muted"></small>
                        </div> -->
                        <div class="form-group">
                            <label for="p_brand">品牌</label>
                            <input type="text" class="form-control" id="p_brand" name="p_brand" placeholder=""
                                   value="">                           
                                    <small id="brandHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="p_color">顏色</label>
                            <input type="text" class="form-control" id="p_color" name="p_color" placeholder=""
                                   value="">     
                            <small id="colorHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="p_size">尺寸</label>
                            <input type="text" class="form-control" id="p_size" name="p_size" placeholder=""
                                   value="">     
                            <small id="sizeHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="d-flex justify-content-around">
                        <button id="submit_btn" type="submit" class="btn btn-primary ">Submit</button>
                        <a href="javascript:history.back()" class="btn btn-primary">返回列表</a>
                        </div>
                    </form>




                    

                </div>
            </div>
        </div>
    </div>




</div>
    <script>

        const photo = document.querySelector('#photo');
        const p_photo = document.querySelector('#p_photo');
        p_photo.addEventListener('change',()=>
       {photo.src= URL.createObjectURL(event.target.files[0]);

       })




        const info_bar = document.querySelector('#info_bar');
        const submit_btn = document.querySelector('#submit_btn');
        
        const fields = [
            'p_photo',
            'p_name',
            'quantity',
            'p_description',
            'p_price',
            'p_genre',
            'p_genre2',
            'p_brand',
            'p_color',
            'p_size',
        ];

        // 拿到每個欄位的參照
        const fs = {};
        
        for(let v of fields){
            fs[v] = document.form1[v];
        }
        console.log(fs);
        console.log('fs.name:', fs.p_name);
        

        const checkForm = ()=>{
            
            let isPassed = true;
            info_bar.style.display = 'none';
           
        
            // 拿到每個欄位的值
            const fsv = {};
                
            for(let v of fields){
                fsv[v] = fs[v].value;
            }
            console.log(fsv);
            



            if (isPassed) {
            let form = new FormData(document.form1);
            console.log(form);
            submit_btn.disabled = true;
            fetch('p__insert2_api.php', {
                    method: 'POST',
                    body: form
                })
                .then(response => response.json())
                .then(obj => {
                    console.log(obj);
                   
                    if (obj.success) {
                       
                        swal({
                            title: "新增商品成功",
                            text: "",
                            icon: "success",
                            button: "確定!",
                        });
                    } else {
                        swal("商品尚未新增");
                        
                    }
                });
        }





            return  false;
        };
        
    </script>
<?php include __DIR__."/p__edit_html_foot.php" ;?>

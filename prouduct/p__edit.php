<?php
require __DIR__. '/p__connect.php';
$page_name = '_edit';

$sid = isset($_GET['p_sid']) ? intval($_GET['p_sid']) : 0;
$sql = "SELECT * FROM `prouduct` WHERE `p_sid`=$sid";
$stmt = $pdo->query($sql);

 
$row = $stmt->fetch(PDO::FETCH_ASSOC);

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

 
      <div class="card " >
  
  <div class="card-body ">
    <h5 class="card-title">修改資料</h5> 
    <img src="./uploads/<?= $row['p_photo']?> " alt="" id="photo" width="100%" >  


    <form id="form1" name="form1" method="post"   onsubmit="return checkForm();" enctype="multipart/form-data">
          <input type="hidden" name="checkme" value="check123">
          <input type="hidden" name="p_sid" value="<?= $row['p_sid']?>" value="<?= $row['p_photo']?>" value="<?= $row['p_name']?>" value="<?= $row['quantity']?>" value="<?= $row['p_description']?>" value="<?= $row['p_price']?>" value="<?= $row['p_genre']?>" value="<?= $row['p_genre2']?>" value="<?= $row['p_brand']?>" value="<?= $row['p_size']?>">
          
          
          <div class="form-group">
            <label for="p_photo">商品照片/未上傳則不會修改</label>
            <input type="file" class="form-control-file" id="p_photo" name="p_photo" placeholder="" accept="image/*">
            <small id="photoHelp" class="form-text text-muted"></small>
          </div>

        <div class="form-group">
          <label for="p_name"></label>商品名稱</label>
          <input type="text" class="form-control" id="p_name" name="p_name"placeholder="" value="<?= $row['p_name']?>">
          <small id="p_nameHelp" class="form-text text-muted"></small>
        </div>

        <div class="form-group">
          <label for="quantity"></label>數量</label>
          <input type="text" class="form-control" id="quantity" name="quantity"placeholder="" value="<?= $row['quantity']?>">
          <small id="quantityHelp" class="form-text text-muted"></small>
        </div>

        <div class="form-group">
          <label for="p_description"></label>說明</label>
          <textarea class="form-control" id="p_description" name="p_description" value="<?= $row['p_description']?>" cols="30" rows="3"><?= $row['p_description']?></textarea>
          <small id="p_descriptionHelp" class="form-text text-muted"></small>
        </div>

        <div class="form-group">
          <label for="p_price"></label>價格</label>
          <input type="text" class="form-control" id="p_price" name="p_price" placeholder="" value="<?= $row['p_price']?>">
          <small id="addressHelp" class="form-text text-muted"></small>
        </div>

        <div class="form-group">
          <label for="p_genre">商品類別</label>
              <!-- <input type="text" class="form-control" id="genre" name="genre" placeholder=""
                    value=""> -->
        <div class="input-group mb-3">
        <div class="input-group-prepend">
            <label class="input-group-text" for="p_genre">商品類別</label>
            </div>

            <select class="custom-select" id="p_genre" name="p_genre">
            <option selected><?= $row['p_genre']?></option>
            <option value="公路車">公路車</option>
            <option value="單速車">單速車</option>
            <option value="特技車">特技車</option>
            </select>
              </div>
                  <small id="p_genreHelp" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                  <label for="genre">商品部件</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="p_genre">商品部件</label>
                        </div>
                      <select class="custom-select" id="p_genre2" name="p_genre2">
                              <option selected><?= $row['p_genre2']?></option>
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
            <div class="form-group">
            <label for="p_brand">品牌</label>
            <input type="text" class="form-control" id="p_brand" name="p_brand" placeholder=""
                  value="<?= $row['p_brand']?>">                           
            <small id="p_brandHelp" class="form-text text-muted"></small>
              </div>

            <div class="form-group">
            <label for="p_color">顏色</label>
            <input type="text" class="form-control" id="p_color" name="p_color" placeholder=""
                  value="<?= $row['p_color']?>">     
            <small id="p_colorHelp" class="form-text text-muted"></small>
                </div>

            <div class="form-group">
            <label for="p_size">尺寸</label>
            <input type="text" class="form-control" id="p_size" name="p_size" placeholder=""
                  value="<?= $row['p_size']?>">     
            <small id="p_sizeHelp" class="form-text text-muted"></small>
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
  const pPhoto = document.querySelector('#p_photo');
  pPhoto.addEventListener("change", ()=> {
  photo.src= URL.createObjectURL(event.target.files[0]);
  });
      
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

    const fs = {};
    for (let v of fields) {
        fs[v] = document.form1[v];
    }
    console.log(fs);
    console.log('fs.name:', fs.p_name);


    const checkForm = () => {
        let isPassed = true;
        info_bar.style.display = 'none';

        // 拿到每個欄位的值
        const fsv = {};
        for (let v of fields) {
            fsv[v] = fs[v].value;
        }
        console.log(fsv);

        
           
        if (isPassed) {
            let form = new FormData(document.form1);

            submit_btn.style.display = 'none';

            fetch('p__edit_api.php', {
                    method: 'POST',
                    body: form
                })
                .then(response => response.json())
                .then(obj => {
              
                    // info_bar.style.display = 'block';

                    swal({
                title: "確定要修改該商品資訊嗎?",
                text: "",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("已經成功修改該商品資料!", {
                        icon: "success",
                    }).then((info) => {
                      location.href = 'p_data_list2.php?=' + sid
                    });
                } else {
                    swal("商品資料完整保留");
                }
            });
  
                });






               

     }
   
   
   return false;


    };
        
</script>
  
  <?php include __DIR__."/p__edit_html_foot.php" ;?>

<?php

require __DIR__. '/p__connect.php';
$page_name = 'data_read';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$sql = "SELECT * FROM prouduct WHERE p_sid=$sid";

$stmt = $pdo->query($sql);

// if($stmt->rowCount()==0){
//     header('Location: p_data_list2.php');
//     exit;
// }
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

 
      <div class="card" >
  
  <div class="card-body">
    <h5 class="card-title">商品資訊</h5> 
    <img src="./uploads/<?= $row['p_photo']?> " alt="" id="photo" width="100%" >    
    <form name="form1" method="post" onsubmit=''  onsubmit="return checkForm();" enctype="multipart/form-data">
    <input type="hidden" name="checkme" value="check123">
    <input type="hidden" name="p_sid" value="<?= $row['p_sid']?>" value="<?= $row['p_photo']?>" value="<?= $row['p_name']?>" value="<?= $row['quantity']?>" value="<?= $row['p_description']?>" value="<?= $row['p_price']?>" value="<?= $row['p_genre']?>" value="<?= $row['p_genre2']?>" value="<?= $row['p_brand']?>" value="<?= $row['p_size']?>">
    <div class="form-group">
       <label for="photo">商品照片</label>
       
       <small id="photoHelp" class="form-text text-muted"></small>
    </div>

  <div class="form-group">
    <label for="p_name"></label>商品名稱</label>
    <input type="text" class="form-control-plaintext" id="p_name" name="p_name"placeholder="" value="<?= $row['p_name']?>" readonly="readonly">
    <small id="p_nameHelp" class="form-text text-muted"></small>
  </div>

  <div class="form-group">
    <label for="quantity"></label>數量</label>
    <input type="text" class="form-control-plaintext" id="quantity" name="quantity"placeholder="" value="<?= $row['quantity']?>" readonly="readonly">
    <small id="quantityHelp" class="form-text text-muted"></small>
  </div>

  <div class="form-group">
    <label for="p_description"></label>說明</label>
    <textarea class="form-control-plaintext" id="p_description" name="p_description" value="<?= $row['p_description']?>" cols="30" rows="3" readonly="readonly"><?= $row['p_description']?></textarea>
    <small id="p_descriptionHelp" class="form-text text-muted"></small>
  </div>

  <div class="form-group">
    <label for="p_price"></label>價格</label>
    <input type="text" class="form-control-plaintext" id="p_price" name="p_price" placeholder="" value="<?= $row['p_price']?> "readonly="readonly">
    <small id="addressHelp" class="form-text text-muted"></small>
  </div>

  <div class="form-group">
     <label for="genre">商品類別</label>
  <div class="input-group mb-3">
      <input type="text" class="form-control-plaintext" id="p_price" name="p_price" placeholder="" value="<?= $row['p_genre']?>" readonly="readonly>
      <small id="p_genreHelp" class="form-text text-muted"></small>
        </div>
          </div>
      
  <div class="form-group">
     <label for="genre">商品部件
     </label>
  <div class="input-group mb-3">
      <input type="text" class="form-control-plaintext" id="p_price" name="p_price" placeholder="" value="<?= $row['p_genre2']?>" readonly="readonly>
      <small id="p_genreHelp" class="form-text text-muted"></small>
        </div>
          </div>        
      <div class="form-group">
      <label for="p_brand">品牌</label>
      <input type="text" class="form-control-plaintext" id="p_brand" name="p_brand" placeholder=""
            value="<?= $row['p_brand']?>" readonly="readonly>                           
      <small id="p_brandHelp" class="form-text text-muted"></small>
         </div>

      <div class="form-group">
      <label for="p_color">顏色</label>
      <input type="text" class="form-control-plaintext" id="p_color" name="p_color" placeholder=""
             value="<?= $row['p_color']?>" readonly="readonly>     
      <small id="p_colorHelp" class="form-text text-muted"></small>
          </div>

      <div class="form-group">
      <label for="p_size">尺寸</label>
      <input type="text" class="form-control-plaintext" id="p_size" name="p_size" placeholder=""
            value="<?= $row['p_size']?>" readonly="readonly>     
      <small id="p_sizeHelp" class="form-text text-muted"></small>
         </div>

    
    <button style="padding:0;border:none" ><a href="javascript:history.back()" class="btn btn-primary"  >返回列表</a></button>
    
</form>
   
      



</div>
<script>

      
const info_bar = document.querySelector('#info_bar');
const submit_btn = document.querySelector('#submit_btn');
const form1 = document.querySelector('#form1');
    const fields = [
      'photo',
      'name',
      'quantity',
      'description',
      'price',
      'genre',
      'genre2',
      'brand',
      'color',
      'size',
    ];

const fs = {};
for(let v of fields){
fs[v] = document.form1[v];
}
const photo = document.querySelector('#photo');
const pPhoto = document.querySelector('#p_photo');
// pPhoto.addEventListener("change", ()=> {
// photo.src= URL.createObjectURL(event.target.files[0]);

// });

const checkForm = ()=>{
    let isPassed = true;
    // info_bar.style.display = 'none';

    // 拿到每個欄位的值
    const fsv = {};
    for(let v of fields){
        fsv[v] = fs[v].value;
    }
};

</script>
<?php include __DIR__."/p__html_foot.php" ;?>
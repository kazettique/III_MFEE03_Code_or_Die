<?php
require __DIR__. '/__connect_db.php';
$page_name = 'event_new_insert';

?>
<?php include __DIR__. '/__html_head.php';  ?>
<?php include __DIR__.'/../sidebar/__nav.php'; ?>
    <style>
        .form-group small {
            color: red !important;
        }
    </style>


<div class="container">

    <div class="row">
        <div class="col-lg-6">

                <div id="info_bar" class="alert alert-success" role="alert" style="display: none">
                </div>

            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">新增活動
                    </h5>

                        
                    <form id="form1" name="form1" method="post" action="event_new_insert_api.php" onsubmit="return checkForm()" enctype="multipart/form-data">
                        <input type="hidden" name="checkme" value="check123"> 


                        <div class="form-group">
                            <label for="e_name">活動名稱</label>
                            <input type="text" class="form-control" id="e_name" name="e_name" placeholder=""
                                   value="">
                            <small id="e_nameHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="e_leader">發起人</label>
                            <input type="text" class="form-control" id="e_leader" name="e_leader" placeholder=""
                                   value="">
                            <small id="e_leaderHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="e_depart">出發地</label>
                            <input type="text" class="form-control" id="e_depart" name="e_depart" placeholder=""
                                   value="">
                            <small id="e_departHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="e_arrive">目的地</label>
                            <input type="text" class="form-control" id="e_arrive" name="e_arrive" placeholder=""
                                   value="">
                            <small id="e_arriveHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="e_date">時間</label>
                            <input type="text" class="form-control" id="e_date" name="e_date" placeholder=""
                                   value="">
                            <small id="e_dateHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="e_endTime">結束時間</label>
                            <input type="text" class="form-control" id="e_endTime" name="e_endTime" placeholder=""
                                   value="">
                            <small id="e_endTimeHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="e_via">中途停靠站</label>
                            <input type="text" class="form-control" id="e_via" name="e_via" placeholder=""
                                   value="">
                            <small id="e_viaHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="e_current">人數</label>
                            <input type="text" class="form-control" id="e_current" name="e_current" placeholder=""
                                   value="">
                            <small id="e_currentHelp" class="form-text text-muted"></small>
                        </div>

                        <img src="" alt="" id="pic" width="100%" >
                        <div class="form-group">
                            <label for="e_pic">照片</label>
                            <input type="file" class="form-control-file" id="e_pic" name="e_pic" placeholder="" accept="image/*">
                            <small id="e_picHelp" class="form-text text-muted"></small>
                        </div>


                        <button id="submit_btn" type="submit" class="btn bgc-green color-white">送出</button>
                    </form>

                    
                </div>
                <button class="btn bgc-green text-align:right;"> <a href="event_list.php" class="color-white">回到上一頁</a></button>
            </div>
        </div>
    </div>




</div>
    <script>

        const pic = document.querySelector('#pic');
        const e_pic = document.querySelector('#e_pic');

        e_pic.addEventListener('change',()=>{
            pic.src= URL.createObjectURL(event.target.files[0]);
        })

        const info_bar = document.querySelector('#info_bar');
        const submit_btn = document.querySelector('#submit_btn');
        const form1 = document.querySelector('#form1');
        const fields = [
            'e_name',
            'e_leader',
            'e_depart',
            'e_arrive',
            'e_date',
            'e_endTime',
            'e_via',
            'e_current',
            'e_pic'
        ];

        // 拿到每個欄位的參照
        const fs = {};
        
        for(let v of fields){
            fs[v] = document.form1[v];
        }

        
        const checkForm = ()=>{
            
            let isPassed = true;
            info_bar.style.display = 'none';
           
        
            // 拿到每個欄位的值
            const fsv = {};
                
            for(let v of fields){
                fsv[v] = fs[v].value;
            }
            console.log(fsv);
            
                if(isPassed){
                    let form = new FormData(document.form1);

                    // submit_btn.style.display = 'none';
                    submit_btn.disabled = true;
                    
                    fetch('event_new_insert_api.php',{
                        method:'post',
                        body:form
                        // console.log(obj);
                    })
                        .then(response=>response.json())
                        .then(obj=>{
                            console.log(obj);
                            
                            info_bar.style.display = 'block';

                            if(obj.success){
                                info_bar.className = 'alert alert-success';
                                info_bar.innerHTML = '資料新增成功';
                                swal({
                                    title: "新增活動成功",
                                    text: "已新增活動",
                                    icon: "success",
                                    button: "確定",
                                });
                                
                            }else{
                                info_bar.className = 'alert alert-danger';
                                info_bar.innerHTML = obj.errorMsg;
                            }
                            // submit_btn.style.display = 'block';
                        });
                }


            // return isPassed;
            return false;
        };

    </script>
<?php include __DIR__."/__html_foot.php" ;?>
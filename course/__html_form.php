<div class="container pt-lg-5 mb-5">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <!-- 如果有錯誤或成功訊息則顯示 -->
            <div id="info_bar" class="alert alert-success mt-4" role="alert" style="display: none"></div>
            <div class="card bg-light mt-4">
                <div class="card-body">
                    <!-- 表單的標題 -->
                    <h2 class="card-title text-center">新增集資活動
                    </h2>
                    <!-- 呼叫checkForm涵式檢查所填的表單内容 -->
                    <form action="" id="course_form" name="course_form" method="post" onsubmit="return checkForm();"
                          enctype="multipart/form-data">
                        <!-- 可以拿掉 -->
                        <input type="hidden" name="checkme" value="check123">
                        <div class="form-group mt-lg-4">
                            <div id="insertFormUpper" class="row">
                                <div class="col-lg-6">
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="">課程名稱</span>
                                        </div>
                                        <input type="text" id="c_name" class="form-control" name="c_name" placeholder=""
                                               value=""
                                               required>
                                        <small id="c_nameHelp" class="form-text text-muted"></small>
                                    </div>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="">目標金額</span>
                                        </div>
                                        <input id="c_fundGoal" type="text" class="form-control" name="c_fundGoal"
                                               placeholder="NT$"
                                               value="" required>
                                        <div class="input-group-append"></div>
                                        <small id="c_fundGoalHelp" class="form-text text-muted"></small>
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="">開始日期</span>
                                        </div>
                                        <!-- TODO 日期判斷式：不能選取今天以前的日期 -->
                                        <input type="text" id="c_startDate" class="form-control datepicker-here"
                                               data-language='zh'
                                               name="c_startDate" maxlength="10" data-position="right top"
                                               value="" onkeyup="InfoDisplay(this.id,'c_startDateHelp', checkDate);" required>
                                    </div>
                                        <small id="c_startDateHelp" class="form-text text-info d-block mb-4"></small>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="">截止日期</span>
                                        </div>
                                        <!-- TODO 日期判斷式：不能選取今天以前的日期 -->
                                        <input type="text" id="c_endDate" class="form-control datepicker-here"
                                               data-language='zh' name="c_endDate" maxlength="10" data-position="right top"
                                               value="" onkeyup="InfoDisplay(this.id, 'c_endDateHelp', checkDate);"
                                               placeholder="YYYY-MM-DD" required>
                                    </div>
                                        <small id="c_endDateHelp" class="form-text text-info d-block mb-4"></small>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="">課程教練</span>
                                        </div>
                                        <input type="text" class="form-control" name="c_instructor"
                                               id="c_instructor"
                                               placeholder=""
                                               value="" required>
                                        <small id="c_instructorHelp" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row col-lg-12 d-flex">
                                        <div id="upload_photo_wrap" class="mb-0 mx-auto">
                                            <img id="upload_photo" name="upload_photo" src="./images/portrait.svg" class="img-fluid">
                                        </div>
                                        <small id="c_photoHelp" class="form-text text-muted"></small>
                                    </div>
                                    <div class="row col-lg-12 d-flex justify-content-center mb-3">
                                        <label class="btn btn-dark col-lg-10" for="c_photo">
                                            <input type="file" id="c_photo" name="c_photo" style="display:none"
                                                   value=""
                                                   onchange="document.getElementById('upload_photo').src = window.URL.createObjectURL(this.files[0])">
                                            瀏覽
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row container mb-3 mx-auto px-0">
                                <div class="alert alert-secondary col-lg-12 text-center" role="alert">
                                    課程簡介
                                </div>
                            </div>
                            <div class="row container mb-3 mx-auto px-0">
                                <textarea id="c_intro" class="form-control" name="c_intro"></textarea>
                                <small id="c_introHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="row container mb-3 mx-auto justify-content-center">
                                <button type="submit" id="submit_btn" class="btn btn-success col-lg-5 m-lg-2">送出資料
                                </button>
                                <a href="javascript: history.back()" class="btn btn-dark col-lg-5 m-lg-2">返回列表</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Import Plug-ins -->
<!---------------------------------------------------------------------------------------------------------------->
<!-- Air Datepicker Stylesheet-->
<link href="./plugins/datepicker/datepicker.min.css" rel="stylesheet" type="text/css">
<!-- Air Datepicker Script -->
<script src="./plugins/datepicker/datepicker.min.js"></script>
<!-- Air Datepicker: Include English Language Pack-->
<!--<script src="./plugins/datepicker/datepicker.en.js"></script>-->
<!-- 注意：<input>裡面的'data-language'屬性要改成'zh' -->
<!-- Air Datepicker: Include Traditional Chinese Language Pack-->
<script src="./plugins/datepicker/datepicker.zh.js"></script>
<!-- REF: http://t1m0n.name/air-datepicker/docs/ -->
<!---------------------------------------------------------------------------------------------------------------->
<!-- CKEditor -->
<script src="./plugins/ckeditor/ckeditor.js"></script>
<!---------------------------------------------------------------------------------------------------------------->
<!-- Public Functions -->
<script src="scripts/utility.js"></script>
<!---------------------------------------------------------------------------------------------------------------->
<!-- Notify.js Script -->
<script src="plugins/notify-js/notify.min.js"></script>
<!---------------------------------------------------------------------------------------------------------------->
<!-- Preload form script -->
<!-- 導入表格腳本 -->
<script src="./scripts/formScriptPreload.js"></script>
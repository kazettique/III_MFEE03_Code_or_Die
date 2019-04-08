const info_bar4=document.getElementById('info_bar4');
const search=document.getElementById('search');
const search_display=document.getElementById('search_display');
let spage=1;

function searchtag() {
    $('.tagbtns input').parent().removeClass('bgc-red').addClass('bgc-green');
    $('.tagbtns input:checked').parent().removeClass('bgc-green').addClass('bgc-red');
    if (($('.tagbtns input:checked').length !== 0 || (search.value !== null || search.value !== '') || $('#r_country').val() !== 0)){
        tag = '';
        for (i = 0; i < $('.tagbtns input:checked').length; i++) {
            tag += $('.tagbtns input:checked').eq(i).val() + ' '
        };
        tag = tag.slice(0, -1);
        // console.log(tag)
        // info_bar4.style.display = 'block';
        fetch_search()
    }else{
        fetch_routes();
        info_bar4.style.display = 'none';
    }
}

function fetch_search(){
    fetch('./search_API.php?search=' + search.value +'&tag='+tag +'&country='+country +'&area='+area + '&page=' + spage + '&perPage=' + perPage + '&orderBy=' + orderBy)
        .then(res => res.json())
        .then(obj => {
            
            if (obj.success) {
                let dnum = obj['totalRoutes'];
                // info_bar4.className = 'alert alert-success';
                // info_bar4.innerHTML = '已找到' + dnum + '條路線';
                swal.fire("Good job!", '已找到' + dnum + '條路線', "success");

                let active = (obj['page'] === 1) ? 'disabled' : ''
                let str = `<li class="page-item list-unstyled ${active}"><a class="page-link" href="javascript:my_pagehange2(${obj['page'] - 1})"><i class="fas fa-caret-left"></i></a></li>`;


                if (obj['totalPages'] < 10){
                    for (let i = 1; i <= obj['totalPages']; i++) {
                        active = (i === obj['page']) ? 'active' : '';
                        str += `<li class="page-item ${active}"><a class="page-link" href="javascript:my_pagehange2(${i})">${i}</a></li>`
                    };
                } else if (obj['page'] <= 5){
                    for (let i = 1; i <= 9; i++) {
                        active = (i === obj['page']) ? 'active' : '';
                        str += `<li class="page-item ${active}"><a class="page-link" href="javascript:my_pagehange2(${i})">${i}</a></li>`
                    };
                } else if (obj['page'] >= obj['totalPages'] - 4){
                    for (let i = obj['totalPages'] - 8; i <= obj['totalPages']; i++) {
                        active = (i === obj['page']) ? 'active' : '';
                        str += `<li class="page-item ${active}"><a class="page-link" href="javascript:my_pagehange2(${i})">${i}</a></li>`
                    };
                }else{
                    for (let i = obj['page'] - 4; i <= obj['page'] + 4; i++) {
                        active = (i === obj['page']) ? 'active' : '';
                        str += `<li class="page-item ${active}"><a class="page-link" href="javascript:my_pagehange2(${i})">${i}</a></li>`
                    };
                }
                
                active = (obj['page'] === obj['totalPages']) ? 'disabled' : ''
                str += `<li class="page-item list-unstyled ${active}"><a class="page-link" href="javascript:my_pagehange2(${obj['page'] + 1})"><i class="fas fa-caret-right"></i></a></li>`
                pagi.innerHTML = str;

                str = '';
                let d = obj['data'];
                for (let card in d) {
                    if (d[card]['r_on'] == '1') {
                        r_on = '<i class="fas fa-eye"></i>';
                    } else {
                        r_on = '<i class="fas fa-eye-slash"></i>';
                    }
                    str += `<div class="card" style="width: 15rem;  margin:1rem .5rem; position:relative;">
                                        <a class="icon" href="javascript:delete_r(${d[card]['r_sid']})" style="position:absolute;top:.5rem;right:.5rem"><i class="fas fa-trash-alt"></i></a>
                                        <a class="icon" href="edit_route.php?r_sid=${d[card]['r_sid']}" style="position:absolute;top:.5rem;left:.5rem"><i class="fas fa-edit"></i></a>
                                        <a class="icon" href="javascript:r_on_switch(${d[card]['r_sid']})" style="position:absolute;top:.5rem;left:7rem" id="ron${d[card]['r_sid']}">${r_on}</a>
                                        <div class="card-img-con" alt="IMG">
                                        <img class="card-img" src="../the_wheel_uploads/${d[card]['r_img']}";>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title rName">${d[card]['r_name']}</h5>
                                            <p class="card-title card-info">
                                            類型: ${d[card]['r_tag']}<br>
                                            國家地區:${d[card]['r_country']} ${d[card]['r_area']}<br>
                                            預計時間: ${d[card]['r_time']}<br>
                                            出發地: ${d[card]['r_depart']}<br>
                                            目的地: ${d[card]['r_arrive']}<br>
                                            </p>
                                            <p class="card-text intro">${d[card]['r_intro']}</p>
                                            <a href="lg_display.php?r_sid=${d[card]['r_sid']}" class="btn btn-primary">查看路線</a>
                                            <p>${d[card]['r_time_added']}</p>
                                        </div>
                                    </div>`
                }
                block.innerHTML = str;
                // setTimeout(() => {
                //     info_bar4.style.display = 'none';
                // }, 1500);

            }else {
                if (obj.errCode == 11111) {
                    fetch_routes();
                }
                swal.fire("", obj.errMsg, "warning");
                // info_bar4.className = 'alert alert-danger';
                // info_bar4.innerHTML = obj.errMsg;
            }
        })
}

function rsearch(){
    console.log('research');
    if (search.value == null || search.value == '' && $('.tagbtns input:checked').length == 0 && $('#r_country').val==''){
        // info_bar4.style.display = 'block';
        // info_bar4.className = 'alert alert-danger';
        // info_bar4.innerHTML = '未輸入關鍵字';
        swal.fire("", '未輸入關鍵字', "warning");
        return false;
    };
    // info_bar4.style.display = 'block';
    fetch_search();

return false;
};

function my_pagehange2(i) {
    
    if (isNaN(i)) {
        spage = i;
    } else {
        spage = parseInt(i)
    };

    var promise1 = new Promise(function(resolve,reject){fetch_search();resolve()});
    promise1.then(function () { info_bar4.style.display = 'none';})

};
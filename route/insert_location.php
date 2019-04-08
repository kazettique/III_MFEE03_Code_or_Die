

<style>
    .location-group{
        background-color:#ccc;
        position:relative;
    }

    .l_delete{
        position:absolute;
        top:.3rem;
        right:.5rem;
    }
</style>

<div class="container">
<button class="btn btn-primary" onclick="javascript:addNewPlace()">Add Route</button></div>
<div class="container ">
    <form method="post" name="form2" onsubmit="return checkform_location()" id="form2" style="width:100%">
        
        <div  id="test"></div>
        <button type="sibmit" class="btn btn-primary">Submit</button>
    </form>
    <div id="info_bar2" class="alert alert-success" role="alert" style="display: none; margin-top:1rem"></div>
</div>

<script>
    const test = document.querySelector('#test')
    let count=0
   


    function addNewPlace(){
    count++;
    test.insertAdjacentHTML('beforeend',`
                        <div class="form-group location-group p-3" id="l_id${count}">
                            <input type="text"  name="r_sid[]" id="r_sid" value="${lastSid}" style="display:none">
                            <input type="text"  name="l_country[]" id="l_country" value="${country}" style="display:none">
                            <input type="text"  name="l_area[]" id="l_area" value="${area}" style="display:none">
                            <button type="button" class="btn-danger l_delete" onclick="javascript:del(this.id)" id="${count}"><i class="fas fa-trash-alt"></i></button>
                            <label for="r_name">地點名稱${count}</label>
                            <input type="text" class="form-control" name="l_name[]" id="l_name${count}" placeholder="地點名稱">
                            <label for="r_intro">描述</label>
                            <textarea type="text" name="l_intro[]" id="l_intro" class="form-control" placeholder="描述"></textarea>
                        </div>
                    
                `);
    }
    function del(click_id){
        count--;
        // let l_delete = document.querySelector(`l_id${click_id}`)
        let l_delete = document.getElementById('l_id'+click_id)
        l_delete.parentNode.removeChild(l_delete);
    }


    const info_bar2 = document.querySelector('#info_bar2');

    function checkform_location (){
        let form2 = new FormData(document.form2);

        submit.style.display='none';

        fetch('./insert_location_API.php',{
            method: 'POST',
            body:form2
        })
        .then(res=>res.json())
        .then(obj=>{
            // info_bar2.style.display = 'block';
            if(obj.success){
                swal.fire("Good job!", obj.errMsg, "success");
                // info_bar2.className = 'alert alert-success';
                // info_bar2.innerHTML = obj.errMsg;
            }else{
                swal.fire("Good job!", obj.errMsg, "error");
                // info_bar2.className = 'alert alert-danger';
                // info_bar2.innerHTML = obj.errMsg;
            }
        })

        submit.style.display='block';
        return false;
    };
</script>


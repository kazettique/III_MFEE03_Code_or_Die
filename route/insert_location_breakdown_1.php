<style>
    .location-group{
        position:relative;
    }

    .l_delete{
        position:absolute;
        top:.3rem;
        right:.5rem;
    }

    .form-short{
    width:100%;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
</style>


    <button class="btn btn-primary" onclick="addNewPlace()">Add Location</button>

    <form method="post" name="form2" id="form2" style="width:100%">
        <div id="test"></div>

    </form>
    
    <div id="info_bar2" class="alert alert-success" role="alert" style="display: none; margin-top:1rem"></div>


<script>
    const test = document.querySelector('#test')
    let count=0
   


    function addNewPlace(){
        count++;
        let country=document.querySelector('#r_country');
        let area=document.querySelector('#r_area');
        test.insertAdjacentHTML('beforeend',`
                            <div class="form-group location-group p-3 my-3" id="l_id${count}">
                                <input type="text"  name="r_sid[]" class="lr_sid" value="" style="display:none">
                                <input type="text"  name="l_order[]" class="l_order" style="display:none">
                                <button type="button" class="btn-danger l_delete" onclick="javascript:del(this.id)" id="${count}"><i class="fas fa-trash-alt"></i></button>
                                <label for="r_name">地點名稱${count}</label>
                                <input type="text" class="form-control" name="l_name[]" id="l_name${count}" placeholder="地點名稱">
                                <div class="row mt-3">

                                    <div class="form-group col-sm-6">
                                        <label for="l_country">國家</label>
                                        <select class="form-short lcn l_country" name="l_country[]" id="l_country${count}">
                                        </select>  
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label for="l_area">地區</label>
                                        <select type="text" class="form-short l_area" name="l_area[]" id="l_area${count}">
                                        </select>      
                                    </div>

                                </div>
                                <label for="r_intro">描述</label>
                                <textarea type="text" name="l_intro[]" id="l_intro" class="form-control" placeholder="描述"></textarea>
                            </div>
                        
                    `);
            

            for(i in database){
                $(`#l_country${count}`).append('<option value="'+i+'">'+i+'</option>')

            }
            document.querySelector(`#l_country${count}`).value=country.value;
            
            var county = country.value;
                    for(k in database[county]){
                        $(`#l_area${count}`).append('<option value="'+database[county][k]+'">'+database[county][k]+'</option>');
                }

            $(`#l_country${count}`).change(function(){
                $(`#l_area${count}`).empty();
                var county = ($(this).val());
                    for(k in database[county]){
                        $(`#l_area${count}`).append('<option value="'+database[county][k]+'">'+database[county][k]+'</option>');
                }
            })
            
            document.querySelector(`#l_area${count}`).value=area.value;
    }
    function del(click_id){
        count--;
        // let l_delete = document.querySelector(`l_id${click_id}`)
        let l_delete = document.getElementById('l_id'+click_id)
        l_delete.parentNode.removeChild(l_delete);
    }




</script>


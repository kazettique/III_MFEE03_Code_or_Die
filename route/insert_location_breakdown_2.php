    const lrsid=document.getElementsByClassName('lr_sid');
    const lcountry=document.getElementsByClassName('l_country');
    const larea=document.getElementsByClassName('l_area');
    
    for(i=0;i<lrsid.length;i++){
        lrsid[i].value=lastSid;
    };

    for(i=0;i<lrsid.length;i++){
        lcountry[i].value=country;
    };

    for(i=0;i<lrsid.length;i++){
        larea[i].value=area;
    };


        let form2 = new FormData(document.form2);

        submit.style.display='none';

        fetch('./insert_location_API.php',{
            method: 'POST',
            body:form2
        })
        .then(res=>res.json())
        .then(obj=>{
            info_bar2.style.display = 'block';
            if(obj.success){ 
                info_bar2.className = 'alert alert-success';
                info_bar2.innerHTML = obj.errMsg;
            }else{
                info_bar2.className = 'alert alert-danger';
                info_bar2.innerHTML = obj.errMsg;
            }
        })

        submit.style.display='block';




function clearFormControlActive(){
    const formControls = document.querySelectorAll('.form-control');
    formControls.forEach((item)=>{
       if(item.hasAttribute('disabled')){
        item.setAttribute('value','');
        item.removeAttribute('disabled');
       }
    });
}

function clearFormControlEmptyActive(){
    clearFormControlActive();
    const formControls = document.querySelectorAll('.form-control');
    formControls.forEach((item)=>{
        item.value="";
     });
}


function clearFormControlActiveDifferentId(ids){
    const formControls = document.querySelectorAll('.form-control');
    formControls.forEach((item)=>{
       if(item.hasAttribute('disabled') && !ids.includes(item.id)){
            item.removeAttribute('disabled');
       }
    });
}

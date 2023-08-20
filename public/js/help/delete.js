((doc)=>{
    const btnDeletes = doc.querySelectorAll('.btn-del');
    const formDelete = doc.querySelector("#form-del");

    btnDeletes.forEach(item => {
        item.addEventListener('click',(e)=>{
            if(formDelete && item.hasAttribute('url')){
                formDelete.action = item.getAttribute('url');
            }
        });
    })

})(document);

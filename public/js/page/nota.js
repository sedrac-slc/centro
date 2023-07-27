(function (win, doc) {
    "use strict";
    const formNota = doc.querySelector('#form-nota');
    const btnNotaAdd = doc.querySelector("#btn-add-nota");
    const modalNotaTitle = doc.querySelector('#modalNotaTitle');
    const spanOperaction = doc.querySelector("#span-operaction");

    const btnUpNota = doc.querySelectorAll('.btn-nota-tr');
    const btnDelnota = doc.querySelectorAll('.btn-nota-del');

    function modalOperaction(item, action=false){
        formNota.action = item.getAttribute('url');
        doc.querySelector("[name='_method']").setAttribute('value',item.getAttribute('method'));
        let row = item.parentElement.parentElement;
        let column = row.children;
        let notaDatas = [
            {name:"nome_aluno", value: column[0].innerHTML, readonly: true},
            {name:"nota_primeira", value: column[1].innerHTML, readonly: false},
            {name:"nota_segunda", value: column[2].innerHTML, readonly: false},
            {name:"nota_terceira", value: column[3].innerHTML, readonly: false},
        ];
        notaDatas.forEach(obj =>{
            let inptObj = doc.querySelector(`[name='${obj.name}']`);
            obj.readonly ? inptObj.setAttribute('disabled','') : inptObj.removeAttribute('disabled');
            action ? inptObj.setAttribute('disabled','') : inptObj.removeAttribute('disabled');
        });
    }

    btnNotaAdd.addEventListener("click", (e) => {
        modalNotaTitle.innerHTML = "Adicionar";
        spanOperaction.innerHTML = "cadastrar";
        formNota.action = btnNotaAdd.getAttribute('url');
        doc.querySelector("[name='_method']").setAttribute('value','POST');
        clearFormControlActive();
    });

    btnUpNota.forEach(item =>{
        item.addEventListener('click', (e)=>{
            modalNotaTitle.innerHTML = "Actualização";
            spanOperaction.innerHTML = "editar";
            modalOperaction(item);
        })
    });

    btnDelnota.forEach(item =>{
        item.addEventListener('click', (e)=>{
            modalNotaTitle.innerHTML = "Apagar";
            spanOperaction.innerHTML = "eliminar";
            modalOperaction(item, true);
        })
    });

})(window, document);

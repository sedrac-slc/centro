(function (win, doc) {
    "use strict";
    const formCurso = doc.querySelector('#form-curso');
    const btnCursoAdd = doc.querySelector("#btn-add-curso");
    const modalCursoTitle = doc.querySelector('#modalCursoTitle');
    const spanOperaction = doc.querySelector("#span-operaction");

    const btnUpCurso = doc.querySelectorAll('.btn-curso-tr');
    const btnDelCurso = doc.querySelectorAll('.btn-curso-del');

    function modalOperaction(item, action=false){
        formCurso.action = item.getAttribute('url');
        doc.querySelector("[name='_method']").setAttribute('value',item.getAttribute('method'));
        let row = item.parentElement.parentElement;
        let column = row.children;
        let cursoDatas = [
            {name:"nome", value: column[0].innerHTML, readonly: true, textarea: false},
            {name:"descricao", value: column[1].innerHTML, readonly: false, textarea: true},
            {name:"data_inicio", value: column[2].innerHTML, readonly: false, textarea: false},
            {name:"data_termino", value: column[3].innerHTML, readonly: false, textarea: false},
            {name:"hora_entrada", value: column[4].innerHTML, readonly: false, textarea: false},
            {name:"hora_termino", value: column[5].innerHTML, readonly: false, textarea: false},
            {name:"sala", value: column[6].innerHTML, readonly: false, textarea: false},
        ];
        cursoDatas.forEach(obj =>{
            let inptObj = doc.querySelector(`[name='${obj.name}']`);
            obj.textarea ? inptObj.innerHTML= obj.value.trim() : inptObj.setAttribute("value", obj.value.trim());
            obj.readonly ? inptObj.setAttribute('disabled','') : inptObj.removeAttribute('disabled');
            action ? inptObj.setAttribute('disabled','') : inptObj.removeAttribute('disabled');
        });
    }

    btnCursoAdd.addEventListener("click", (e) => {
        modalCursoTitle.innerHTML = "Adicionar";
        spanOperaction.innerHTML = "cadastrar";
        formCurso.action = btnCursoAdd.getAttribute('url');
        doc.querySelector("[name='_method']").setAttribute('value','POST');
        clearFormControlActive();
    });

    btnUpCurso.forEach(item =>{
        item.addEventListener('click', (e)=>{
            modalCursoTitle.innerHTML = "Actualização";
            spanOperaction.innerHTML = "editar";
            modalOperaction(item);
        })
    });

    btnDelCurso.forEach(item =>{
        item.addEventListener('click', (e)=>{
            modalCursoTitle.innerHTML = "Apagar";
            spanOperaction.innerHTML = "eliminar";
            modalOperaction(item, true);
        })
    });

})(window, document);

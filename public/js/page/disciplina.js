(function (win, doc) {
    "use strict";
    const formDisciplina = doc.querySelector('#form-disciplina');
    const btnDisciplinaAdd = doc.querySelector("#btn-add-disciplina");
    const modalDisciplinaTitle = doc.querySelector('#modalDisciplinaTitle');
    const spanOperaction = doc.querySelector("#span-operaction");

    const btnUpdisciplina = doc.querySelectorAll('.btn-disciplina-tr');
    const btnDeldisciplina = doc.querySelectorAll('.btn-disciplina-del');

    function modalOperaction(item, action=false){
        formDisciplina.action = item.getAttribute('url');
        doc.querySelector("[name='_method']").setAttribute('value',item.getAttribute('method'));
        let row = item.parentElement.parentElement;
        let column = row.children;
        let disciplinaDatas = [
            {name:"nome", value: column[0].innerHTML, readonly: true, textarea: false},
            {name:"descricao", value: column[1].innerHTML, readonly: false, textarea: true},
        ];
        disciplinaDatas.forEach(obj =>{
            let inptObj = doc.querySelector(`[name='${obj.name}']`);
            obj.textarea ? inptObj.innerHTML= obj.value.trim() : inptObj.setAttribute("value", obj.value.trim());
            obj.readonly ? inptObj.setAttribute('disabled','') : inptObj.removeAttribute('disabled');
        });
    }

    btnDisciplinaAdd.addEventListener("click", (e) => {
        modalDisciplinaTitle.innerHTML = "Adicionar";
        spanOperaction.innerHTML = "cadastrar";
        formDisciplina.action = btnDisciplinaAdd.getAttribute('url');
        doc.querySelector("[name='_method']").setAttribute('value','POST');
        clearFormControlActive();
    });

    btnUpdisciplina.forEach(item =>{
        item.addEventListener('click', (e)=>{
            modalDisciplinaTitle.innerHTML = "Actualização";
            spanOperaction.innerHTML = "editar";
            modalOperaction(item);
        })
    });

    btnDeldisciplina.forEach(item =>{
        item.addEventListener('click', (e)=>{
            modalDisciplinaTitle.innerHTML = "Apagar";
            spanOperaction.innerHTML = "eliminar";
            modalOperaction(item, true);
        })
    });

})(window, document);

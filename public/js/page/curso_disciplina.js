(function (win, doc) {
    "use strict";
    const formCursoDisciplina = doc.querySelector('#form-curso-disciplina');
    const btnDisciplinaAdd = doc.querySelector("#btn-add-curso-disciplina");
    const modalCursoDisciplinaTitle = doc.querySelector('#modalCursoDisciplinaTitle');
    const spanOperaction = doc.querySelector("#span-operaction");

    const btnUpCursoDisciplina = doc.querySelectorAll('.btn-curso-disciplina-tr');
    const btnDelCursoDisciplina = doc.querySelectorAll('.btn-curso-disciplina-del');

    function modalOperaction(item, action=false){
        formCursoDisciplina.action = item.getAttribute('url');
        doc.querySelector("[name='_method']").setAttribute('value',item.getAttribute('method'));
        let row = item.parentElement.parentElement;
        let column = row.children;
        let disciplinaDatas = [
            {name:"nome", value: column[0].innerHTML, readonly: false},
            {name:"descricao", value: column[1].innerHTML, readonly: false},
        ];
        disciplinaDatas.forEach(obj =>{
            let inptObj = doc.querySelector(`[name='${obj.name}']`);
            obj.readonly ? inptObj.setAttribute('disabled','') : inptObj.removeAttribute('disabled');
            action ? inptObj.setAttribute('disabled','') : inptObj.removeAttribute('disabled');
        });
    }

    btnDisciplinaAdd.addEventListener("click", (e) => {
        modalCursoDisciplinaTitle.innerHTML = "Adicionar";
        spanOperaction.innerHTML = "cadastrar";
        formCursoDisciplina.action = btnDisciplinaAdd.getAttribute('url');
        doc.querySelector("[name='_method']").setAttribute('value','POST');
        clearFormControlActive();
    });

    btnUpCursoDisciplina.forEach(item =>{
        item.addEventListener('click', (e)=>{
            modalCursoDisciplinaTitle.innerHTML = "Actualização";
            spanOperaction.innerHTML = "editar";
            modalOperaction(item);
        })
    });

    btnDelCursoDisciplina.forEach(item =>{
        item.addEventListener('click', (e)=>{
            modalCursoDisciplinaTitle.innerHTML = "Apagar";
            spanOperaction.innerHTML = "eliminar";
            modalOperaction(item, true);
        })
    });

})(window, document);

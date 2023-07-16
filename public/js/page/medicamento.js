(function (win, doc) {
    "use strict";

    const formUser = doc.querySelector('#form-user');
    const btnUserAdd = doc.querySelector("#btn-add-user");
    const modalMedicamentoTitle = doc.querySelector('#modalMedicamentoTitle');
    const spanOperaction = doc.querySelector("#span-operaction");

    const btnUpItems = doc.querySelectorAll('.btn-user-tr');
    const btnDelItems = doc.querySelectorAll('.btn-user-del');

    function modalOperaction(item, action=false){
        formUser.action = item.getAttribute('url');
        doc.querySelector("[name='_method']").setAttribute('value',item.getAttribute('method'));
        let row = item.parentElement.parentElement;
        let column = row.children;
        let userDatas = [
            {name:"nome", value: column[0].innerHTML, readonly: false},
            {name:"quantidade_minino_stock", value: column[1].innerHTML, readonly: false}
        ];
        textareaChange("descricao", column[2].innerHTML, action);
        userDatas.forEach(obj =>{
            let inptObj = doc.querySelector(`[name='${obj.name}']`);
            inptObj.setAttribute("value", obj.value);
            action ? inptObj.setAttribute('disabled','') : inptObj.removeAttribute('disabled');
        });
    }

    btnUserAdd.addEventListener("click", (e) => {
        modalMedicamentoTitle.innerHTML = "Adicionar";
        spanOperaction.innerHTML = "cadastrar";
        formUser.action = btnUserAdd.getAttribute('url');
        doc.querySelector("[name='_method']").setAttribute('value','POST');
        clearFormControlActive();
    });

    btnUpItems.forEach(item =>{
        item.addEventListener('click', (e)=>{
            modalMedicamentoTitle.innerHTML = "Actualização";
            spanOperaction.innerHTML = "editar";
            modalOperaction(item);
        })
    });

    btnDelItems.forEach(item =>{
        item.addEventListener('click', (e)=>{
            modalMedicamentoTitle.innerHTML = "Apagar";
            spanOperaction.innerHTML = "eliminar";
            modalOperaction(item, true);
        })
    });

    const btnItemTr = doc.querySelectorAll('.btn-item-tr');
    btnItemTr.forEach(item => {
        item.addEventListener('click',(e)=>{
            const medicamentoKey = doc.querySelector("#medicamento_key");
            const medicamentoNome = doc.querySelector("#medicamento_nome");
            medicamentoKey.value = item.dataset.key;
            medicamentoNome.value = item.dataset.value;
            medicamentoNome.setAttribute('disabled','');
        });
    });

})(window, document);

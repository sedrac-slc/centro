(function (win, doc) {
    "use strict";

    const formUser = doc.querySelector('#form-item');
    const btnUserAdd = doc.querySelector("#btn-add-item");
    const modalItemTitle = doc.querySelector('#modalItemTitle');
    const spanOperaction = doc.querySelector("#span-operaction");

    const btnUpItems = doc.querySelectorAll('.btn-item-tr');
    const btnDelItems = doc.querySelectorAll('.btn-item-del');

    const medicamentoNome = doc.querySelector("#medicamento_nome");

    function modalOperaction(item, action=false){
        formUser.action = item.getAttribute('url');
        doc.querySelector("[name='_method']").setAttribute('value',item.getAttribute('method'));
        let row = item.parentElement.parentElement;
        let column = row.children;
        let userDatas = [
            {name:"medicamento_nome", value: column[0].innerHTML, readonly: true},
            {name:"codigo", value: column[1].innerHTML, readonly: false},
            {name:"data_validade", value: column[2].innerHTML, readonly: false}
        ];
        userDatas.forEach(obj =>{
            let inptObj = doc.querySelector(`[name='${obj.name}']`);
            inptObj.setAttribute("value", obj.value.trim());
            obj.readonly ? inptObj.setAttribute('disabled','') : inptObj.removeAttribute('disabled');
            action ? inptObj.setAttribute('disabled','') : inptObj.removeAttribute('disabled');
        });
    }

    btnUserAdd.addEventListener("click", (e) => {
        modalItemTitle.innerHTML = "Adicionar";
        spanOperaction.innerHTML = "cadastrar";
        formUser.action = btnUserAdd.getAttribute('url');
        doc.querySelector("[name='_method']").setAttribute('value','POST');
        clearFormControlActive();
    });

    btnUpItems.forEach(item =>{
        item.addEventListener('click', (e)=>{
            modalItemTitle.innerHTML = "Actualização";
            spanOperaction.innerHTML = "editar";
            modalOperaction(item);
        })
    });

    btnDelItems.forEach(item =>{
        item.addEventListener('click', (e)=>{
            modalItemTitle.innerHTML = "Apagar";
            spanOperaction.innerHTML = "eliminar";
            modalOperaction(item, true);
        })
    });

    medicamentoNome.addEventListener('blur',(e)=>{
        let nome = medicamentoNome.value.trim();
        if(nome != ""){
            ajaxMedicamento(nome)
        }
    });

    const filterSelect = doc.querySelector("#filterSelect");
    const filterSearch = doc.querySelector("#filterSearch");

    filterSelect.addEventListener('change',(e)=>{
        switch(filterSelect.value){
            case "mes_validade":
                filterSearch.type = "month";
                break;
            case "data_validade":
                filterSearch.type = "date";
                break;
            case "ano_validade":
                filterSearch.type = "number";
                filterSearch.min = "1900";
                break;
            case "fora_do_prazo":
                filterSearch.value = "Visualizar";
                break;
            case "fora_do_prazo_elim":
                filterSearch.value = "Apagar";
                break;
            default:
                filterSearch.type = "text";
        }
    })

})(window, document);

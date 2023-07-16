(function (win, doc) {
    "use strict";
    const formUser = doc.querySelector('#form-retirada');
    const btnUserAdd = doc.querySelector("#btn-add-retirada");
    const modalRetiradaTitle = doc.querySelector('#modalRetiradaTitle');
    const spanOperaction = doc.querySelector("#span-operaction");

    const btnUpRetirada = doc.querySelectorAll('.btn-retirada-tr');
    const btnDelRetirada = doc.querySelectorAll('.btn-retirada-del');

    const medicamentoNome = doc.querySelector("#medicamento_nome");

    function modalOperaction(item, action=false){
        formUser.action = item.getAttribute('url');
        doc.querySelector("[name='_method']").setAttribute('value',item.getAttribute('method'));
        let row = item.parentElement.parentElement;
        let column = row.children;
        let userDatas = [
            {name:"farmaceutico_nome", value: column[0].innerHTML, readonly: true},
            {name:"medicamento_nome", value: column[1].innerHTML, readonly: false},
        ];
        userDatas.forEach(obj =>{
            let inptObj = doc.querySelector(`[name='${obj.name}']`);
            inptObj.setAttribute("value", obj.value.trim());
            obj.readonly ? inptObj.setAttribute('disabled','') : inptObj.removeAttribute('disabled');
            action ? inptObj.setAttribute('disabled','') : inptObj.removeAttribute('disabled');
        });
    }

    btnUserAdd.addEventListener("click", (e) => {
        const farmaceutico = doc.querySelector("#farmaceutico_nome");
        modalRetiradaTitle.innerHTML = "Adicionar";
        spanOperaction.innerHTML = "cadastrar";
        formUser.action = btnUserAdd.getAttribute('url');
        doc.querySelector("[name='_method']").setAttribute('value','POST');
        farmaceutico.value = btnUserAdd.dataset.nome;
        farmaceutico.setAttribute('disabled','');
        farmaceutico.setAttribute('readonly','');
        clearFormControlActive();
    });

    btnUpRetirada.forEach(item =>{
        item.addEventListener('click', (e)=>{
            modalRetiradaTitle.innerHTML = "Actualização";
            spanOperaction.innerHTML = "editar";
            modalOperaction(item);
        })
    });

    btnDelRetirada.forEach(item =>{
        item.addEventListener('click', (e)=>{
            modalRetiradaTitle.innerHTML = "Apagar";
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

})(window, document);

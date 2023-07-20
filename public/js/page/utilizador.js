(function (win, doc) {
    "use strict";

    const formUser = doc.querySelector('#form-user');
    const btnUserAdd = doc.querySelector("#btn-add-user");
    const modalUserTitle = doc.querySelector('#modalUserTitle');
    const spanOperaction = doc.querySelector("#span-operaction");

    const btnUpItems = doc.querySelectorAll('.btn-user-tr');
    const btnDelItems = doc.querySelectorAll('.btn-user-del');


    const formPasswords = [
        doc.querySelector("#password"),
        doc.querySelector("#password_confirmation")
    ];

    function openOrClosePassword(state){
        const panel = doc.querySelector("#password-input");
        state ? panel.classList.remove('d-none') : panel.classList.add('d-none');
        formPasswords.forEach( (item) =>{
            state ? item.removeAttribute('disabled') : item.setAttribute('disabled','');
        });
    }

    function modalOperaction(item, action=false){
        formUser.action = item.getAttribute('url');
        doc.querySelector("[name='_method']").setAttribute('value',item.getAttribute('method'));
        openOrClosePassword(false);
        let row = item.parentElement.parentElement;
        let column = row.children;
        selectChange("gender",column[3].dataset.vd, action);
        selectChange("tipo",column[6].dataset.vd, action);
        let userDatas = [
            {name:"name", value: column[1].innerHTML, readonly: false},
            {name:"email", value: column[2].innerHTML, readonly: false},
            {name:"phone", value: column[4].innerHTML, readonly: false},
            {name:"birthday", value: column[5].innerHTML, readonly: false},
        ];
        userDatas.forEach(obj =>{
            let inptObj = doc.querySelector(`[name='${obj.name}']`);
            inptObj.setAttribute("value", obj.value);
            action ? inptObj.setAttribute('disabled','') : inptObj.removeAttribute('disabled');
        });
    }

    btnUserAdd.addEventListener("click", (e) => {
        modalUserTitle.innerHTML = "Adicionar";
        spanOperaction.innerHTML = "cadastrar";
        formUser.action = btnUserAdd.getAttribute('url');
        doc.querySelector("[name='_method']").setAttribute('value','POST');
        openOrClosePassword(true);
        clearFormControlEmptyActive();
    });

    btnUpItems.forEach(item =>{
        item.addEventListener('click', (e)=>{
            modalUserTitle.innerHTML = "Actualização";
            spanOperaction.innerHTML = "editar";
            modalOperaction(item);
        })
    });

    btnDelItems.forEach(item =>{
        item.addEventListener('click', (e)=>{
            modalUserTitle.innerHTML = "Apagar";
            spanOperaction.innerHTML = "eliminar";
            modalOperaction(item, true);
        })
    });

    const filterSelect = doc.querySelector("#filterSelect");
    const filterDiv = doc.querySelector("#filter-div");

    filterSelect.addEventListener('change',(e)=>{
        let input = `<label for="filterSearch">Digita (a pesquisa):</label>`;
        switch(filterSelect.value){
            case "tipo":
                let selectTipo = `<label for="filterSearch"><span>Ocupação:</span></label>
                <select class="form-control  rounded" name="search" id="filterSearch" required="">
                    <option value="MEDICO" selected="">Médico</option>
                    <option value="FARMACEUTICO">Farmacêutico</option>
                </select>`;
                filterDiv.innerHTML = selectTipo;
                break;
            case "gender":
                let selectGender= `<label for="filterSearch"><span>Gênero:</span></label>
                    <select class="form-control rounded" name="search" id="filterSearch" required="">
                        <option value="MALE" selected="">Masculino</option>
                        <option value="FEMALE">Femenino</option>
                    </select>`;
                filterDiv.innerHTML = selectGender;
                break;
            case "birthday":
                let compDate = `<input type="date" id="filterSearch" name="search" class="form-control">`;
                filterDiv.innerHTML = input+compDate;
                break;
            default:
                let compDefault = `<input type="text" id="filterSearch" name="search" class="form-control">`;
                filterDiv.innerHTML = input+compDefault;
        }
    })

})(window, document);

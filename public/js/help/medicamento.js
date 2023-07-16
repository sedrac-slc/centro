
function ajaxMedicamento(nome){
    let html = "";
    const url = document.querySelector("#url-json");
    fetch(`${url.value+"?search="+nome}`).then(resp => resp.json()).then(resp => {
        const divTab = document.querySelector("#table-medicamento");
        resp.forEach((item,index) => {
            html += `<tr>
                <td class="text-center">
                    <input id="radio_${index}" class="form-check-input" type="radio" name="medicamento_id" value="${item.id}">
                </td>
                <td><label for="radio_${index}">${item.nome}</label></td>
                <td class="text-center">${item.items.length}</td>
            </tr>`;
        });
        divTab.innerHTML = tableComponentCreate(html);
    })
}

function tableComponentCreate(line){
    return `<table class="table">
        <thead>
            <tr>
                <th class="text-center"><i class="fas fa-check"></i><span>Escolher</span></th>
                <th><i class="fas fa-signature"></i><span>Nome</span></th>
                <th class="text-center"><i class="fas fa-list-ol"></i><span>Stock</span></th>
            </tr>
        </thead>
        <tbody>${line}</tbody>
    </table>`;
}

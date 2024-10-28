function ajaxDisciplina(nome) {
    let html = "";
    const url = document.querySelector("#url-disciplina-curso");
    const divTab = document.querySelector("#table-disciplina-result");
    if (nome != "") {
        fetch(`${url.value + "?search=" + nome}`)
            .then((resp) => resp.json())
            .then((resp) => {
                resp.forEach((item, index) => {
                    html += `<tr>
                    <td class="text-center">
                        <input id="radio_disciplina_${index}" class="form-check-input" type="radio" value="${item.id}" name="disciplina_id">
                    </td>
                    <td><label for="radio_disciplina_${index}">${item.nome}</label></td>
                </tr>`;
                });
                divTab.innerHTML = html == "" ? render("Disciplina não encontrada")  : tableComponentDisciplina(html);
            });
    }else{
        divTab.innerHTML = "";
    }
}

function tableComponentDisciplina(line) {
    return `<table class="table">
            <thead>
                <tr>
                    <th class="text-center"><span>#</span></th>
                    <th><span>Nome</span></th>
                 </tr>
            </thead>
            <tbody>${line}</tbody>
        </table>`;
}

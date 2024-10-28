function ajaxDisciplinaCurso(curso) {
    let html = "";
    const url = document.querySelector("#url-disciplina-curso");
    const divTab = document.querySelector("#table-disciplina-result");
    if (curso != "") {
        fetch(`${url.value + "?curso=" + curso}`)
            .then((resp) => resp.json())
            .then((resp) => {
                resp.forEach((item, index) => {
                    html += `<tr>
                    <td class="text-center">
                        <input id="radio_disciplina_${index}" class="form-check-input" type="radio" name="disciplina_id" value="${item.id}">
                    </td>
                    <td><label for="radio_disciplina_${index}">${item.nome}</label></td>
                    <td><label for="radio_disciplina_${index}">${item.descricao}</label></td>
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
                    <th><span>Descrição</span></th>
                 </tr>
            </thead>
            <tbody>${line}</tbody>
        </table>`;
}

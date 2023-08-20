function ajaxCurso(nome) {
    let html = "";
    const url = document.querySelector("#url-curso");
    const divTab = document.querySelector("#table-curso-result");
    const divTabDisciplina = document.querySelector("#table-disciplina-result");
    if (nome != "") {
        fetch(`${url.value + "?search=" + nome}`)
            .then((resp) => resp.json())
            .then((resp) => {
                resp.forEach((item, index) => {
                    html += `<tr>
                    <td class="text-center">
                        <input id="radio_curso_${index}" class="form-check-input" type="radio" name="curso_id" value="${item.id}" onclick="ajaxDisciplinaCurso(${item.id})">
                    </td>
                    <td><label for="radio_curso_${index}">${item.nome}</label></td>
                    <td>${item.data_inicio}</td>
                    <td>${item.data_termino}</td>
                    <td>${item.hora_entrada}</td>
                    <td>${item.hora_termino}</td>
                </tr>`;
                });
                divTab.innerHTML = html == "" ? render("Curso não encontrada") : tableComponentCurso(html);
            });
    }else{
        divTab.innerHTML = "";
        if(divTabDisciplina){
            divTabDisciplina.innerHTML = "";
        }
    }
}

function tableComponentCurso(line) {
    return `<table class="table">
            <thead>
                <tr>
                    <th class="text-center"><span>#</span></th>
                    <th><i class="fas fa-signature"></i><span>Nome</span></th>
                    <th><i></i><span>Data inicio</span></td>
                    <th><i></i><span>Data termino</span></td>
                    <th><i></i><span>Hora entrada</span></td>
                    <th><i></i><span>Hora saída</span></td>
                 </tr>
            </thead>
            <tbody>${line}</tbody>
        </table>`;
}

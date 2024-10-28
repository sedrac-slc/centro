function ajaxCurso(nome) {
    let html = "";
    const url = document.querySelector("#url-curso");
    const divTab = document.querySelector("#table-curso-result");
    if (nome != "") {
        fetch(`${url.value + "?search=" + nome}`)
            .then((resp) => resp.json())
            .then((resp) => {
                resp.forEach((item, index) => {
                    html += `<tr>
                    <td class="text-center">
                        <input id="radio_curso${index}" class="form-check-input" type="radio" name="curso_id" value="${item.id}">
                    </td>
                    <td><label for="radio_curso${index}">${item.nome}</label></td>
                    <td>${item.preco}</td>
                    <td>${item.data_inicio}</td>
                    <td>${item.data_termino}</td>
                    <td>${item.hora_entrada}</td>
                    <td>${item.hora_termino}</td>
                </tr>`;
                });
                divTab.innerHTML = html == "" ? render("Curso não encontrada") : tableComponentCreate(html);
            });
    }else{
        divTab.innerHTML = "";
    }
}

function tableComponentCreate(line) {
    return `<table class="table">
            <thead>
                <tr>
                    <th class="text-center"><span>#</span></th>
                    <th><span>Nome</span></th>
                    <th><span>Preço</span></td>
                    <th><span>Data inicio</span></td>
                    <th><span>Data termino</span></td>
                    <th><span>Hora entrada</span></td>
                    <th><span>Hora saída</span></td>
                 </tr>
            </thead>
            <tbody>${line}</tbody>
        </table>`;
}

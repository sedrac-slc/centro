function ajaxAlunos(nome) {
    let html = "";
    const url = document.querySelector("#url-alunos");
    const divTab = document.querySelector("#table-aluno-result");
    if (nome != "") {
        fetch(`${url.value + "?search=" + nome}`)
            .then((resp) => resp.json())
            .then((resp) => {
                resp.forEach((item, index) => {
                    html += `<tr>
                    <td class="text-center">
                        <input id="radio_aluno_${index}" class="form-check-input" type="radio" value="${item.aluno_id}" name="aluno_id">
                    </td>
                    <td><label for="radio_aluno_${index}">${item.curso}</label></td>
                    <td><label for="radio_aluno_${index}">${item.preco}</label></td>
                    <td><label for="radio_aluno_${index}">${item.name}</label></td>
                    <td><label for="radio_aluno_${index}">${item.email}</label></td>
                    <td><label for="radio_aluno_${index}">${item.phone}</label></td>
                </tr>`;
                });
                divTab.innerHTML = html == "" ? render("Aluno não encontrado")  : tableComponentAluno(html);
            });
    }else{
        divTab.innerHTML = "";
    }
}

function tableComponentAluno(line) {
    return `<table class="table">
            <thead>
                <tr>
                    <th class="text-center"><span>#</span></th>
                    <th><span>Curso</span></th>
                    <th><span>Preço</span></th>
                    <th><span>Aluno</span></th>
                    <th><span>Email</span></th>
                    <th><span>Contacto</span></th>
                 </tr>
            </thead>
            <tbody>${line}</tbody>
        </table>`;
}

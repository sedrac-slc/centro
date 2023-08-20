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
                        <input id="radio_aluno_${index}" class="form-check-input" type="radio" value="${item.curso_id}" name="curso_id" onclick="reloadInformation(${item.curso_id},${item.aluno_id})">
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

function reloadInformation(curso,aluno){
    ajaxDisciplinaCurso(curso);
    const inputAluno = document.querySelector("#aluno_join");
    inputAluno.value = aluno;
}

function tableComponentAluno(line) {
    return `<table class="table">
            <thead>
                <tr>
                    <th class="text-center"><span>#</span></th>
                    <th><i class="fas fa-clipboard"></i><span>Curso</span></th>
                    <th><i class="fas fa-money-bill"></i><span>Preço</span></th>
                    <th><i class="fas fa-signature"></i><span>Nome</span></th>
                    <th><i class="fas fa-at"></i><span>Email</span></th>
                    <th><i class="fas fa-phone"></i><span>Contacto</span></th>
                 </tr>
            </thead>
            <tbody>${line}</tbody>
        </table>`;
}

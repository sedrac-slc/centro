((doc) => {
    const periodoRelatorio = doc.querySelector("#periodoRelatorio");
    const campoRelatorio = doc.querySelector("#campoRelatorio");

    function formatDate(data, tipo="data") {
        const ano = data.getFullYear();
        const mes = String(data.getMonth() + 1).padStart(2, "0");
        const dia = String(data.getDate()).padStart(2, "0");
        if(tipo == "month") return `${ano}-${mes}`;
        if(tipo == "year") return `${ano}`;
        return `${ano}-${mes}-${dia}`;
    }

    periodoRelatorio.addEventListener("click", (e) => {
        let html;
        let data = new Date();
        switch (periodoRelatorio.value) {
            case "diario":
                html = `<label for="filterSearch">Digita o (periódo):</label>
                    <input type="date" id="valueRelatorio" name="value" class="form-control" value="${formatDate(data)}"></input>`;
                campoRelatorio.innerHTML = html;
                break;
            case "mensal":
                html = `<label for="filterSearch">Digita o (periódo):</label>
                <input type="month" id="valueRelatorio" name="value" class="form-control" value="${formatDate(data,"month")}"></input>`;
                campoRelatorio.innerHTML = html;
            break;
            case "anual":
                html = `<label for="filterSearch">Digita o (periódo):</label>
                <input type="number" id="valueRelatorio" name="value" class="form-control" value="${formatDate(data,"year")}"></input>`;
                campoRelatorio.innerHTML = html;
            break;
        }
    });
})(document);

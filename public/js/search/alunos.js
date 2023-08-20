((doc)=>{

const searchInput = doc.querySelector("#search-aluno");

searchInput.addEventListener('keyup',(e)=>{
    ajaxAlunos(searchInput.value);
});

})(document);

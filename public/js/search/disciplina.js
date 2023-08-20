((doc)=>{

const searchInput = doc.querySelector("#search-disciplina");

searchInput.addEventListener('keyup',(e)=>{
    ajaxDisciplina(searchInput.value);
});

})(document);

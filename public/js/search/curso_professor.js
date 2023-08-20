((doc)=>{

const searchInput = doc.querySelector("#search-aluno");

searchInput.addEventListener('keyup',(e)=>{
    ajaxCurso(searchInput.value);

});

})(document);

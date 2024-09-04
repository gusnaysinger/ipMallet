
console.log("js working")

///
///
///
var btn_delete = "<a id=\"btn_delete\" href=\"#\" class=\"btn btn-outline-warning\" role=\"button\"><i class=\"fa-solid fa-trash icon-editor-btn\"></i></a>";
var deletefunc = document.getElementById('delete');

deletefunc.value = "btn_delete";
btn_delete.addEventListener('click', function(){
    btn_delete.setAttribute('class', 'btn-danger')
})
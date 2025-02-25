"use strict"
$(() => {
   
        $("#first, #all").on("click", mostrar);
   
})
function mostrar() {
    const param=new FormData();

    if ($(this).attr("id") == "first") {
        param.append("perro", "111A")
    }else{
        param.append("perro", "");
    }   
    
    
    fetch("php/mostrar.php",{
        method:'POST',
        body: param 
    })
    .then((response) =>{
        if (response.status==200){
            return response.json();
         }else{
            throw ("Error en la comunicación")
         }
    }) 
    .then((data) => {
      
       $("tbody").empty();
       console.log(data);
           $(data.data).each((ind, ele) => {
               $("tbody").append(`<tr><td>${ele.chip}</td><td>${ele.nombre}</td><td>${ele.raza}</td><td>${ele.fechaNac}</td></tr>`)
           })
       
     })
     .catch((error) => {
       console.log(error);
     });
}
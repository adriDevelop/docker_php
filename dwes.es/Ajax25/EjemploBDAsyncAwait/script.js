"use strict"
$(() => {
   
        $("#first, #all").on("click", mostrar);
   
})
async function mostrar() {
    const param=new FormData();

    if ($(this).attr("id") == "first") {
        param.append("perro", "111A")
    }else{
        param.append("perro", "");
    }   
 
    try {
        const response=await fetch("php/mostrar.php",{
            method:'POST',
            body: param 
        })
        const data=await response.json();
        console.log(response.status);
        $("tbody").empty();
        console.log(data);
        $(data.data).each((ind, ele) => {
            $("tbody").append(`<tr><td>${ele.chip}</td><td>${ele.nombre}</td><td>${ele.raza}</td><td>${ele.fechaNac}</td></tr>`)
        })
           
         
    } catch (error) {
        console.error(error.message);
    }
   

}
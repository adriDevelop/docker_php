"use strict"
$(() => {
  
    $("#cursos").on("change", mostrarAsig)

})

const mostrarAsig=()=>{
fetch("Ejemplo5.xml")
.then ( response =>{
    if (response.status==200){
        return response.text();
     }else{
        throw ("Error en la comunicación")
     }
})
.then (data=>{
    $("#modulos option:gt(0)").remove();
    $(data).find("curso").each((ind,ele)=>{
        if (ind== $("#cursos").prop("selectedIndex")-1){
            $(ele).find("asig").each((i, valor) =>{
                $("#modulos").append("<option>"+ $(valor).text()+ "</option>")

            })
        }
    })
    Swal.fire("Todo correcto")
})
.catch (error=>{
    console.log(error);
})

}
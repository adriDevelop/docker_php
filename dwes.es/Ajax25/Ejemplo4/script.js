"use strict"

$(() => {
   
        $(":button").on("click", mostrarAsig)
    
})

const mostrarAsig=()=> {
    fetch("Ejemplo4.xml")
    .then ( response =>{
        if (response.status==200){
            return response.text();
         }else{
            throw ("Error en la comunicación")
         }
    })
    .then (data=>{
        let mensaje="";
            $(data).find("curso").each((ind, ele) => {
                if (ind == 1) {
                    mensaje = "Módulos de 2º DAW";
                    $(ele).find("asig").each((ind, mod) => {
                        mensaje += "<br>" + $(mod).text()
                    })
                }
            })
            $("#mensaje").html(mensaje);
    })
    .catch (error=>{
        console.log(error);
    })
    
}

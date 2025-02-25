"use strict";
$(() => {
  $("#regiones").on("change", mostrarProv);
});

const mostrarProv=() =>{
  fetch("Ejemplo6.php",{
    method:'POST',
    headers:{
            'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: `ca=${$("#regiones").val()}`
    
  })
    .then((response) => {
      if (response.status==200){
        return response.json();
     }else{
        throw ("Error en la comunicación")
     }
    })
    .then((data) => {
        let cadena = "";
        //borrar contenido de capa
        //$("#mostrar").empty();
        $(data).each((ind, ele) => {
          cadena += ele + "<br>";
        });
        $("#mostrar").html(cadena);
    })
    .catch((error) => {
      console.log(error);
    });
  
}

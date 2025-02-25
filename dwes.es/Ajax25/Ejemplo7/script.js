"use strict"
window.addEventListener("DOMContentLoaded", ()=>{
    mostrarProv();
})

const mostrarProv=() =>{
        fetch("https://raw.githubusercontent.com/IagoLast/pselect/master/data/provincias.json")
         .then((response) =>{ 
            if (response.status==200){
             return response.json();
            }else{
              throw ("Error en la comunicación")
            }
         })
        
         .then((data) => {
            //ordenar ascedente
           
            data.sort((a, b) => {
                return a.nm.localeCompare(b.nm)
            })
            //cargar en el select
            $(data).each((ind, ele) => {
                $("#provincias").append("<option id=" + ele.id + ">" + ele.nm + "</option>")
            })

            //evento change
            $("#provincias").on("change", function () {

                Swal.fire("El Id es " + $("#provincias option:selected").attr("id"))
            })
          })
          .catch((error) => {
            console.log(error);
          });
        
      }

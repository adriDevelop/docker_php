"use strict"
window.addEventListener("DOMContentLoaded", ()=>{
    mostrarProv();
})

const mostrarProv=async() =>{
    try{
        const response= await fetch("https://raw.githubusercontent.com/IagoLast/pselect/master/data/provincias.json")
        const data=await response.json();
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
        
    }catch(error){
        console.error(error);
    };
         
}

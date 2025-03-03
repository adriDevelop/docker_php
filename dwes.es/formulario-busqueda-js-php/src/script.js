{
    // Obtengo todos los datos del DOM
    const elements = document.querySelectorAll('input, select, button');

    // Función que comprueba el dni
    function validateDni(e){
        const regexDni = new RegExp("^[0-9]{8}[A-Z]{1}$");
        if (regexDni.test(e.target.value)){
            console.log('Dni validado');
        }else {
            console.log('Dni no validado');
        }
    }

    // Recorro los elementos del DOM recogidos para añadirle eventos
    elements.forEach(datos => {
        // Ahora, debo de añadirle a los elementos recogidos los eventos, comprobando el id antes
        if (datos.id == 'dni'){
            datos.addEventListener('change', validateDni);
        }
        console.log(datos);
    })
}
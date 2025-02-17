<?php
// Generamos su espacio de nombres
namespace mvc\modelo;

// Generaremos una interfaz de la que implementarán todos los modelos
interface Modelo{
    // El modelo tendrá un método despacha que tendrán todos los 
    // modelos que implementen de este
    public function despacha():mixed;
}
?>
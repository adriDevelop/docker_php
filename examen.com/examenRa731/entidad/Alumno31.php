<?php

// Espacio de nombres
namespace examenRa731\entidad;

use DateTime;

// Creamos la clase Alumno31
class Alumno31 extends Entidad{
    // Propiedades de la clase Alumno31
    protected string $nif;
    protected string $nombre;
    protected string $apellidos;
    protected ?DateTime $fecha_nacimiento;
    protected ?string $curso;
    protected ?string $grupo;

}

?>
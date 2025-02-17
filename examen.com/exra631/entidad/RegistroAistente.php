<?php
// Creación del espacio de nombres
namespace exra631\entidad;

use DateTime;

class RegistroAsistente{
    // Propiedades de la clase
    protected int $id;
    protected string $email;
    protected string $fecha_inscripcion;
    protected string $actividad;

    // Constructor de la clase
    public function __construct(int $id, string $email, string $fecha_inscripcion, string $actividad)
    {
        $this->id = $id;
        $this->email = $email;
        $this->fecha_inscripcion = $fecha_inscripcion;
        $this->actividad = $actividad;
    }

    // GETTER Y SETTER de las propiedades
    public function getId():int
    {
        return $this->id;
    }

    public function getEmail():string
    {
        return $this->email;
    }

    public function getFechaInscripcion():string
    {
        return $this->fecha_inscripcion;
    }

    public function getActividad():string
    {
        return $this->actividad;
    }

    public function setId(int $id){
        $this->id = $id;
    }

    public function setEmail(string $email){
        $this->email = $email;
    }

    public function setFechaInscripcion(string $fecha_inscripcion){
        $this->fecha_inscripcion = $fecha_inscripcion;
    }

    public function setActividad(string $actividad){
        $this->actividad = $actividad;
    }

    public function __toString()
    {
        return "Id del asistente: {$this->getId()}\nEmail del asistente: {$this->getEmail()},\nFecha de inscripción del asistente: {$this->getFechaInscripcion()}\nActividad realizada: {$this->getActividad()}";
    }
}
?>
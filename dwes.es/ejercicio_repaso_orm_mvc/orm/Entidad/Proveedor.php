<?php

// Espacio de nombres
namespace orm\Entidad;

// Instanciación de la clase
class Proveedor{
    protected string $nif;
    protected string $razon_social;
    protected string $direccion;
    protected string $cp;
    protected string $poblacion;
    protected string $provincia;
    protected string $pais;
    protected string $telefono;
    protected string $contacto;
    protected string $email;

    // Constructor de la clase
    public function __construct(string $nif, string $razon_social, string $direccion, string $cp, string $poblacion, string $provincia, string $pais, string $telefono, string $contacto, string $email){
        $this->nif = $nif;
        $this->razon_social = $razon_social;
        $this->direccion = $direccion;
        $this->cp = $cp;
        $this->poblacion = $poblacion;
        $this->provincia = $provincia;
        $this->pais = $pais;
        $this->telefono = $telefono;
        $this->contacto = $contacto;
        $this->email = $email;
    }

    // GETTERS && SETTERS
    public function getNif(){
        return $this->nif;
    }

    public function getRazonSocial(){
        return $this->razon_social;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function getCp(){
        return $this->cp;
    }

    public function getPoblacion(){
        return $this->poblacion;
    }

    public function getProvincia(){
        return $this->provincia;
    }

    public function getPais(){
        return $this->pais;
    }

    public function getTelefono(){
        return $this->telefono;
    }

    public function getContacto(){
        return $this->contacto;
    }

    public function getEmail(){
        return $this->email;
    }
}

?>
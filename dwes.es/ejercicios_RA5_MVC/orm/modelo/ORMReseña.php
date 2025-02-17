<?php

namespace orm\modelo;

use orm\modelo\ORMBase;
use orm\entidad\Reseña;

class ORMReseña extends ORMBase{
    protected string $tabla = "reseña";
    protected string $clave_primaria = "id_reseña";

    public function getClaseEntidad()
    {
        return Reseña::class;
    }
}

?>
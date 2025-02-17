<?php

namespace orm\modelo;

use orm\entidad\DireccionEnvio;
use orm\modelo\ORMBase;

class ORMDireccion_Envio extends ORMBase{
    protected string $tabla = "direccion_envio";
    protected string $clave_primaria = "id_dir_env";

    public function getClaseEntidad(){
        return DireccionEnvio::class;
    }
}

?>
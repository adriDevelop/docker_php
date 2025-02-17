<?php

namespace orm\entidad;

use orm\Entidad\Entidad;
use DateTime;

class Reseña extends Entidad{
    protected int $id_reseña;
    protected ?string $nif;
    protected ?string $referencia;
    protected DateTime $fecha;
    protected int $clasificacion;
    protected ?string $comentario;
}

?>
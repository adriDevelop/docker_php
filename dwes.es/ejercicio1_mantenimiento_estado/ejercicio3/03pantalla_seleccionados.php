<?php

    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SESSION['array_a_usar'] && $_SESSION['array_ingredientes']){
        echo "Tengo todos los datos kbron";
    } else {
        echo "No tengo una mierda";
    }

?>
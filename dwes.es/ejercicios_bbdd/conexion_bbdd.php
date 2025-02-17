<?php

    function conexion_bbdd(string $servidor, string $usuario, string $clave, string $schema,int $puerto, string $consulta){
        // Pasos para las conexiones de bbdd.

        // 1.- Lo primero es inicializar la conexión generando un nuevo objeto de mysql.
        $cbd = new mysqli($servidor, $usuario, $clave, $schema, $puerto);

        // 2.- Cuando tengamos la conexión de base de datos, tenemos que preparar la consulta.
        $stmt = $cbd->prepare($consulta);

        // 3.- Con la consulta generada, tenemos que usar el meto bind_param al que le pasaremos
        // los datos mediante "s, i, d..." para string, int, double/float respectivamente, y el
        // valor o valores que vayamos a pasar en la cláusula where.
        $stmt->bind_param("s", $email);

        // 4.- Debemos ejecutar la consulta, que nos devolverá true o false si ha sido o no correcta.
        $stmt->execute();

        // 5.- Debemos de almacenar el resultado en una variable y el get_result() nos devolverá un 
        // objeto de tipo result_set.
        $resultado = $stmt->get_result();

        // Devolvemos el valor de resultado, que será con lo que trabajemos desde fuera.
        return $resultado;
    }
?>
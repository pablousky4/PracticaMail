<?php
        $servername = "localhost";
        $username = "daw2";
        $password = "1234";
        $dbname = "mail";

        $conexion = new mysqli($servername, $username, $password, $dbname);

        if ($conexion->connect_error) {
            die("Conexión fallida: " . $conexion->connect_error);
        }
?>
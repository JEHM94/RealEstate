<?php

function connectDB() : mysqli
{
    $user = "root";
    $password = "root";
    $host = "localhost";
    $dbName = "realstate_crud";

    $db = new mysqli($host, $user, $password, $dbName);

    if (!$db) {
        echo "Error en el intento de conexión";
        exit;
    }
    return $db;
}

function closeDB($db){
    mysqli_close($db);
}

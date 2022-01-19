<?php
session_start();
$conexion = mysqli_connect(
    "localhost",
    "root",
    "",
    "cafeteria"
);
/*
if (isset($conexion)) {
    echo "si esta conectado";
}else{
    echo "no esta conectado";
}
*/
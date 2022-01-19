<?php
session_start();
$conexion = mysqli_connect(
    "localhost",
    "root",
    "",
    "cafeteria"
);
echo phpinfo();
/*
if (isset($conexion)) {
    echo "si esta conectado";
}else{
    echo "no esta conectado";
}
*/
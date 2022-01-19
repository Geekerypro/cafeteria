<?php
include "../db/conexion.php";


function ejecutarQuery($conn, $sql)
{
    $resultado = mysqli_query($conn, $sql);
    return $resultado;
}

function listarProductos($conn, $sql)
{
    $resultado = mysqli_query($conn, $sql);
    $resultadoArray = array();
    foreach ($resultado as $key) {
        $resultadoArray[] = $key;
    }
    return $resultadoArray;
}


if (isset($_POST['guardar_producto'])) {

    $nombre_producto = $_POST['nombre_producto'];
    $referencia_produtos = $_POST['referencia_produtos'];
    $categoria_produtucto = $_POST['categoria_produtucto'];
    $precio_producto = $_POST['precio_producto'];
    $peso_producto = $_POST['peso_producto'];
    $stock_producto = $_POST['stock_producto'];
    $fecha = date("Y-m-d");
    $query = "insert into productos(nombre, referencia, precio, peso, categoria, stock, fecha_creacion) values ('$nombre_producto', '$referencia_produtos', $precio_producto, $peso_producto, $categoria_produtucto, $stock_producto, '$fecha')";

    $resultado = ejecutarQuery($conexion, $query);
    if (!$resultado) {
        return die('Fallo' . mysqli_error($conexion));
    }

    header("Location: ../productos.php");
}

if (isset($_POST['guardar_producto_editado'])) {

    $id = $_POST['identificador'];
    $nombre_producto = $_POST['nombre_producto_editado'];
    $referencia_produtos = $_POST['referencia_produtos_editado'];
    $categoria_produtucto = $_POST['categoria_produtucto_editado'];
    $precio_producto = $_POST['precio_producto_editado'];
    $peso_producto = $_POST['peso_producto_editado'];
    $stock_producto = $_POST['stock_producto_editado'];
    $fecha = date("Y-m-d");
    $query = "update productos set nombre='$nombre_producto', referencia='$referencia_produtos', precio=$precio_producto, peso=$peso_producto, categoria=$categoria_produtucto, stock=$stock_producto where id=$id";

    $resultado = ejecutarQuery($conexion, $query);
    if (!$resultado) {
        return die('Fallo' . mysqli_error($conexion));
    }

    header("Location: ../productos.php");
}

if (isset($_GET['eliminar'])) {


    $eliminar = $_GET['eliminar'];
    $query_validador = "select id from ventas where producto = $eliminar";
    $resultado_validacion = listarProductos($conexion, $query_validador);
    if (count($resultado_validacion) > 0) {
        $_SESSION['mensaje'] = "Este producto no se puede eliminar por que ya hay ventas registradas con el codigo de este producto".count($resultado_validacion);
        $_SESSION['tipo'] = "danger";
    } else {
        $query = "delete from productos where id = $eliminar";
        $resultado = ejecutarQuery($conexion, $query);
        if (!$resultado) {
            return die('Fallo' . mysqli_error($conexion));
        }
        $_SESSION['mensaje'] = "Producto se elimino con exito!!!";
        $_SESSION['tipo'] = "success";
    }
    header("Location: ../productos.php");
}

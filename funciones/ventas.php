<?php
include "../db/conexion.php";

function ejecutarQuery($conn, $sql)
{
    $resultado = mysqli_query($conn, $sql);
    return $resultado;
}

function listarVentas($conn, $sql)
{
    $resultado = mysqli_query($conn, $sql);
    $resultadoArray = array();
    foreach ($resultado as $key) {
        $resultadoArray[] = $key;
    }
    return $resultadoArray;
}

if (isset($_POST['registrar_venta'])) {

    $producto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    $fecha = date("Y-m-d");
    $query_validacion = "select id, nombre, stock from productos where id = $producto";
    $resultado_validacion = listarVentas($conexion, $query_validacion);

    if (count($resultado_validacion) > 0) {
        if ($resultado_validacion[0]['stock'] < $cantidad) {
            $_SESSION['mensaje'] = "Stock insuficiente para completar la venta";
            $_SESSION['tipo'] = "danger";
            header("Location: ../index.php");
        } else {
            $query = "insert into ventas(fecha, producto, cantidad) values ('$fecha', '$producto', '$cantidad')";
            $resultado = ejecutarQuery($conexion, $query);
            $nuevo_stock = $resultado_validacion[0]['stock'] - $cantidad;
            $query_stock = "update productos set stock = $nuevo_stock where id = $producto";
            $actaulizar_stock = ejecutarQuery($conexion, $query_stock);
            if (!$resultado) {
                return die('Fallo' . mysqli_error($conexion));
            }
            $_SESSION['mensaje'] = "Venta registrada con exito!!!";
            $_SESSION['tipo'] = "success";
            header("Location: ../index.php");
        }
        echo $resultado_validacion[0]['stock'];
    } else {
        $_SESSION['mensaje'] = "Producto no existe";
        $_SESSION['tipo'] = "danger";
        header("Location: ../index.php");
    }
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


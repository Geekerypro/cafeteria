<?php include "parts/header.php"; ?>
<?php include "funciones/ventas.php"; ?>
<?php include "db/conexion.php"; ?>
<?php


$query_listaVentas = "select * from ventas order by id desc";
$result_listaVentas = listarVentas($conexion, $query_listaVentas);


?>

<div class="container">
    <h3 class="mt-4">Querys Directos</h3>
    <br>
    <h5>Consulta de producto con mayor stock</h5>
    <p>select * from productos where stock = (select max(stock) from productos);</p>
</div>

<?php include "parts/footer.php"; ?>
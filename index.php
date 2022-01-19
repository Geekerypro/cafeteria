<?php include "parts/header.php"; ?>
<?php include "funciones/ventas.php"; ?>
<?php include "db/conexion.php"; ?>
<?php


$query_listaVentas = "select * from ventas order by id desc";
$result_listaVentas = listarVentas($conexion, $query_listaVentas);


?>

<div class="container">
    <h3 class="mt-4 text-center">Vender Producto</h3>
    <div class="row mt-3 mb-5 justify-content-center">
        <div class="col-md-6">
            <?php
            if (isset($_SESSION['mensaje'])) {
            ?>
                <div class="alert alert-<?php echo $_SESSION['tipo'] ?> alert-dismissible fade show" role="alert">
                    <strong><?php echo $_SESSION['mensaje'] ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php session_unset(); } ?>
            <form action="funciones/ventas.php" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="producto">Id del Producto</label>
                        <input type="number" class="form-control" id="producto" name="producto">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad">
                    </div>
                </div>
                <button type="submit" name="registrar_venta" class="btn btn-dark btn-block">Registrar Venta</button>
            </form>

        </div>

    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < count($result_listaVentas); $i++) {
                    ?>
                        <tr>
                            <td><?php echo $result_listaVentas[$i]['id'] ?></td>
                            <td><?php echo $result_listaVentas[$i]['fecha'] ?></td>
                            <td><?php echo $result_listaVentas[$i]['producto'] ?></td>
                            <td><?php echo $result_listaVentas[$i]['cantidad'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>


    </div>
</div>

<?php include "parts/footer.php"; ?>
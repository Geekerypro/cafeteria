<?php include "parts/header.php"; ?>
<?php include "funciones/productos.php"; ?>
<?php include "db/conexion.php"; ?>
<?php


$query_listaProd = "select * from productos order by id desc";
$result_listaProd = listarProductos($conexion, $query_listaProd);

$query_listaCat = "select id, nombre_categoria, descripcion from categorias";
$result_listaCat  = listarProductos($conexion, $query_listaCat);


?>

<div class="container">
    <div class="row mt-4 mx-2">
        <h3>Productos</h3>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-dark ml-auto" data-toggle="modal" data-target="#staticBackdrop">
            Registrar Producto
        </button>

        <!-- Modal para registrar producto -->
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Registrar Nuevo Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="funciones/productos.php" method="POST">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nombre_producto">Nombre Produto</label>
                                    <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" placeholder="Nombre del Producto">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="referencia_produtos">Referencia</label>
                                    <input type="text" class="form-control" id="referencia_produtos" name="referencia_produtos" placeholder="Referencia del Producto">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="categoria_produtucto">Categoria</label>
                                <select id="categoria_produtucto" name="categoria_produtucto" class="form-control">

                                    <option selected>Categoria del Producto</option>
                                    <?php
                                    for ($i = 0; $i < count($result_listaCat); $i++) {
                                    ?>
                                        <option value="<?php echo $result_listaCat[$i]['id']; ?>"><?php echo $result_listaCat[$i]['nombre_categoria']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label for="precio_producto">Precio</label>
                                    <input type="number" class="form-control" id="precio_producto" name="precio_producto" placeholder="Precio">
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="peso_producto">Peso (En gramos)</label>
                                    <input type="number" class="form-control" id="peso_producto" name="peso_producto" placeholder="Peso en gramos">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="stock_producto">Stock</label>
                                    <input type="number" class="form-control" id="stock_producto" name="stock_producto">
                                </div>
                            </div>
                            <button type="submit" name="guardar_producto" class="mt-1 mb-3 btn btn-dark btn-block">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">

            <?php
            if (isset($_SESSION['mensaje'])) {
            ?>
                <div class="alert alert-<?php echo $_SESSION['tipo'] ?> alert-dismissible fade show" role="alert">
                    <strong><?php echo $_SESSION['mensaje'] ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php session_unset();
            } ?>
            <table class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre Producto</th>
                        <th scope="col">Referencia</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Peso</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Fecha Creacion</th>
                        <th scope="col" style="width: 120px;">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < count($result_listaProd); $i++) {
                    ?>
                        <tr>
                            <td><?php echo $result_listaProd[$i]['id'] ?></td>
                            <td><?php echo $result_listaProd[$i]['nombre'] ?></td>
                            <td><?php echo $result_listaProd[$i]['referencia'] ?></td>
                            <td><?php echo $result_listaProd[$i]['precio'] ?></td>
                            <td><?php echo $result_listaProd[$i]['peso'] ?> gm</td>
                            <td><?php echo $result_listaProd[$i]['categoria'] ?></td>
                            <td><?php echo $result_listaProd[$i]['stock'] ?></td>
                            <td><?php echo $result_listaProd[$i]['fecha_creacion'] ?></td>
                            <td>
                                <a class="btn ml-auto" data-toggle="modal" data-target="#modaleditarprod<?php echo $result_listaProd[$i]['id'] ?>"> <i class="fas fa-marker"></i> </a>
                                <a href="funciones/productos.php?eliminar=<?php echo $result_listaProd[$i]['id'] ?>" class="btn ml-auto"> <i class="fas fa-trash-alt"></i> </a>
                            </td>
                        </tr>

                        <!-- Modal para actaulizar informacion del producto-->
                        <div class="modal fade" id="modaleditarprod<?php echo $result_listaProd[$i]['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Editar informacion del producto</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="funciones/productos.php" method="POST">
                                            <input type="hidden" name="identificador" value="<?php echo $result_listaProd[$i]['id']; ?>">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="nombre_producto">Nombre del Producto</label>
                                                    <input type="text" class="form-control" id="nombre_producto" name="nombre_producto_editado" value="<?php echo $result_listaProd[$i]['nombre']; ?>">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="referencia_produtos">Referencia</label>
                                                    <input type="text" class="form-control" id="referencia_produtos" name="referencia_produtos_editado" value="<?php echo $result_listaProd[$i]['referencia']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="categoria_produtucto">Categoria</label>
                                                <select id="categoria_produtucto" name="categoria_produtucto_editado" class="form-control">

                                                    <?php
                                                    for ($h = 0; $h < count($result_listaCat); $h++) {
                                                        if ($result_listaCat[$h]['id'] == $result_listaProd[$i]['categoria']) {

                                                    ?>
                                                            <option selected value="<?php echo $result_listaCat[$h]['id']; ?>"><?php echo $result_listaCat[$h]['nombre_categoria']; ?></option>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <option value="<?php echo $result_listaCat[$h]['id']; ?>"><?php echo $result_listaCat[$h]['nombre_categoria']; ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-5">
                                                    <label for="precio_producto">Precio</label>
                                                    <input type="number" class="form-control" id="precio_producto" name="precio_producto_editado" value="<?php echo $result_listaProd[$i]['precio']; ?>">
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="peso_producto">Peso (En gramos)</label>
                                                    <input type="number" class="form-control" id="peso_producto" name="peso_producto_editado" value="<?php echo $result_listaProd[$i]['peso']; ?>">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="stock_producto">Stock</label>
                                                    <input type="number" class="form-control" id="stock_producto" name="stock_producto_editado" value="<?php echo $result_listaProd[$i]['stock']; ?>">
                                                </div>
                                            </div>
                                            <button type="submit" name="guardar_producto_editado" class="mt-1 mb-3 btn btn-dark btn-block">Guardar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>


    </div>
</div>

<?php include "parts/footer.php"; ?>
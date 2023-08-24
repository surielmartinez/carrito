<?php 
    session_start(); 
    $carrito = array();
    if(isset($_SESSION['carrito'])){ $carrito = $_SESSION['carrito']; }
    $pedido=0;
    if(isset($_SESSION['pedido'])){ $pedido = $_SESSION['pedido']; }
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../carrito/">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="../carrito/">Carrito</a></li>
            </ol>
        </nav>
        <h1>Prueba de Carrito</h1>
        <div class="col-lg-8 px-0">
            <p>Creando un CRUD para carrito de compras.</p>
            <hr class="col-1 my-4">
            <?php 
                $msj=""; $elemento = array();
                if(isset($_REQUEST['save'])){
                    $elemento['pedido']=$pedido;
                    $elemento['idprod']=$_REQUEST['idprod'];
                    $elemento['producto']=$_REQUEST['producto'];
                    $elemento['cantidad']=$_REQUEST['cantidad'];
                    $_SESSION['carrito'][$pedido]=$elemento;
                    $pedido++;
                    $_SESSION['pedido']=$pedido;
                    $msj="Elemento Guardado con Éxito.";
                }
                if(isset($_REQUEST['del'])){
                    $y=$_REQUEST['del'];
                    unset($_SESSION['carrito'][$y]);
                    $msj="Elemento Eliminado con Éxito.";
                }
                if(isset($_REQUEST['empty'])){
                    unset($_SESSION['carrito']);
                    unset($_SESSION['pedido']);
                    $msj="Carrito Vacío.";
                }
                echo '<h6 class="alert alert-primary" role="alert">'.$msj.'</h6>';
            ?>
        </div>
        <div class="row">
            <div class="col-md-2">
                <form action="index.php" enctype="multipart/form-data" method="post" target="_self">
                    <div class="form-group">
                        <label for="idprod">SKU</label>
                        <input type="text" class="form-control" name="idprod" id="idprod" aria-describedby="helpId"
                            placeholder="ID" require>
                        <small id="helpId" class="form-text text-muted">ID</small>
                    </div>
                    <div class="form-group">
                        <label for="producto">Producto</label>
                        <input type="text" class="form-control" name="producto" id="producto" aria-describedby="helpId"
                            placeholder="Producto" require>
                        <small id="helpId" class="form-text text-muted">Nombre del producto</small>
                    </div>
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input type="text" class="form-control" name="cantidad" id="cantidad" aria-describedby="helpId"
                            placeholder="Cantidad" require>
                        <small id="helpId" class="form-text text-muted">Número de Elementos</small>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="save" value="1" />
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
            <div class="col-md-5">
                <hr class="col-1 my-6">
                <?php var_dump($_REQUEST); ?>
                <hr class="col-1 my-4">
                <?php var_dump($_SESSION); ?>
            </div>
            <div class="col-md-5">
                <table class="table table-striped table-inverse table-responsive">
                    <thead class="thead-inverse">
                        <tr>
                            <th>#</th>
                            <th>Pedido</th>
                            <th>SKU</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $productos = $_SESSION['carrito'];
                                $x=1;
                                foreach($productos as $producto){
                            ?>
                        <tr>
                            <td><?=$x++?></td>
                            <td><?=$producto['pedido']?></td>
                            <td><?=$producto['idprod']?></td>
                            <td><?=$producto['producto']?></td>
                            <td><?=$producto['cantidad']?></td>
                            <td><a href="index.php?del=<?=$producto['pedido']?>" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tb>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th colspan="2" class="text-center">
                            <?php if($x>0) { ?>
                            <a href="index.php?empty=1" class="btn btn-warning">Vaciar Carrito</a>
                            <?php } ?>
                        </th>
                    </tb>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>
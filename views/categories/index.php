<?php
$categories = $this->d['categories'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="./publico/assets/css/normalize.css">
    <link rel="stylesheet" href="./publico/assets/css/style.css">
    <title>Categorias</title>
</head>

<body>
    <?php
    require_once 'views/header/headerlogin.php';
    ?>

    <h1 class="titulo centrar-texto">Categorias</h1>
    
    <main class="contenedor centrar-bloque">

        <div class="table-responsive">
            <table class="table table-dark table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th scope="col">Titulo</th>
                        <th scope="col">tipo</th>
                        <th scope="col">Actualizar</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($categories as $category) {
                        echo '<tr class = "table-light">';
                        echo '<td class="texto">' . $category->getTitle() . '</td>';
                        echo '<td class="texto">' . $category->getType() . '</td>';
                        echo '<td class="texto">'
                    ?>

                        <!-- Button trigger modal -->
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal<?php echo $category->getId() ?>">
                            Actualizar
                        </button>
                        <div class="modal fade" id="myModal<?php echo $category->getId() ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Actualizar</h5>
                                        <button class="btn btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <form action="<?php echo constant('URL') ?>categories/updateItem" method="post">

                                            <label for="title" class="form-label">Titulo</label>
                                            <input type="text" class="form-control" name="title" id="title" value="<?php echo $category->getTitle()?>" autocomplete="off" required placeholder="Nota">
                                            <br>
                                            <label for="type" class="form-label">Categoria</label>
                                            <select class="form-select form-select-m" name="type" id="type">
                                                <?php
                                                    if ($category->getType() == 'income') {
                                                        echo "<option selected value='income'>Income</option>";
                                                        echo "<option value='expense'>Expense</option>";
                                                    }else {
                                                        echo "<option value='income'>Income</option>";
                                                        echo "<option selected value='expense'>Expense</option>";

                                                    }
                                                
                                                ?>
                                            </select>
                                            <br>
                                            <input type="hidden" name="id" value="<?php echo $category->getId() ?>">

                                            <input class="btn btn-success centrar-boton" type="submit" value="Actualizar">
                                        </form>

                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <?php
                        echo '</td>';
                        echo '<td>';
                        ?>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#miModal<?php echo $category->getId() ?>">
                            Eliminar
                        </button>
                        <div class="modal fade" id="miModal<?php echo $category->getId() ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Eliminar</h5>
                                        <button class="btn btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <form action="<?php echo constant('URL') ?>categories/deleteItem" method="post">
                                            <p>Esta seguro que desea ELIMINAR este registro de Gasto?</p>
                                            <input type="hidden" name="id" value="<?php echo $category->getId() ?>">
                                            <input class="btn btn-danger centrar-boton" type="submit" value="Eliminar Registro">
                                        </form>

                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-success" data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>

</html>
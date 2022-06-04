<?php
$incomes = $this->d['incomes'];
$categorias = $this->d['categories'];
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
    <title>Gastos</title>
</head>

<body>
    <?php
    require_once 'views/header/headerlogin.php';
    ?>

    <h1 class="titulo centrar-texto">Gastos</h1>

    <main class="contenedor centrar-bloque">

        <div class="table-responsive">
            <table class="table table-dark table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th scope="col">Nota</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Actualizar</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($incomes as $income) {
                        echo '<tr class = "table-light">';
                        echo '<td class="texto-tabla">' . $income->getTitle() . '</td>';
                        echo '<td class="texto-tabla">$' . number_format(floatval($income->getAmount()), 2) . '</td>';
                        echo '<td class="texto-tabla">' . date('d-m-Y', strtotime($income->getDate())) . '</td>';
                        echo '<td >'
                    ?>

                        <!-- Modal actualizar -->
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal<?php echo $income->getId() ?>">
                            Actualizar
                        </button>
                        <div class="modal fade" id="myModal<?php echo $income->getId() ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Actualizar</h5>
                                        <button class="btn btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <form action="<?php echo constant('URL') ?>incomes/updateItem" method="post">

                                            <label for="title" class="form-label">Nota</label>
                                            <input type="text" class="form-control" name="title" id="title" value="<?php echo $income->getTitle() ?>" autocomplete="off" required placeholder="Nota">
                                            <br>
                                            <label for="category_id" class="form-label">Categoria</label>
                                            <select class="form-select form-select-m" name="category_id" id="category_id">
                                                <?php
                                                foreach ($categorias as $category) {
                                                    if ($category->getId() == $income->getCategory_id()) {
                                                        echo "<option selected value='{$category->getId()}'>{$category->getTitle()}</option>";
                                                    } else {
                                                        echo "<option value='{$category->getId()}'>{$category->getTitle()}</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <br>
                                            <label class="form-label" for="amount">Monto</label>
                                            <input class="form-control" type="money" name="amount" id="amount" value="<?php echo $income->getAmount() ?>" autocomplete="off" required placeholder="Monto">
                                            <br>
                                            <label class="form-label" for="date">Fecha</label>
                                            <input class="form-control" type="date" name="date" id="date" value="<?php echo date('Y-m-d', strtotime($income->getDate()))  ?>" autocomplete="off" required>
                                            <br>
                                            <input type="hidden" name="id" value="<?php echo $income->getId() ?>">

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
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#miModal<?php echo $income->getId() ?>">
                            Eliminar
                        </button>
                        <div class="modal fade" id="miModal<?php echo $income->getId() ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Eliminar</h5>
                                        <button class="btn btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <form action="<?php echo constant('URL') ?>incomes/deleteItem" method="post">
                                            <p>Esta seguro que desea ELIMINAR este registro de ingreso?</p>
                                            <input type="hidden" name="id" value="<?php echo $income->getId() ?>">
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
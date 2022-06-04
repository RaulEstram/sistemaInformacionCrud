<?php
$categorias = $this->d['categories'];
$user = $this->d['user'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="./publico/assets/css/normalize.css">
    <link rel="stylesheet" href="./publico/assets/css/style.css">
    <title>Ingresos</title>
</head>


<body>

  <?php
  require_once './views/header/headerlogin.php';
  ?>

  <h1 class="titulo centrar-texto">Crear Ingreso</h1>

  <div class="dash-content centrar-bloque transparente">

    <form action="<?php echo constant('URL') ?>createIncome/saveItem" method="post">
      <label for="title" class="form-label">Nota</label>
      <input type="text" class="form-control" name="title" id="title" autocomplete="off" required placeholder="Nota">
      <br>
      <label for="category_id" class="form-label">Categoria</label>
      <select class="form-select form-select-m" name="category_id" id="category_id">
        <?php
        foreach ($categorias as $category) {
          echo $category->getId();
          echo "<option value='{$category->getId()}'>{$category->getTitle()}</option>";
        }
        ?>
      </select>
      <br>
      <label class="form-label" for="amount">Monto</label>
      <input class="form-control" type="money" name="amount" id="amount" autocomplete="off" required placeholder="Monto">
      <br>
      <label class="form-label" for="date">Fecha</label>
      <input class="form-control" type="date" name="date" id="date" autocomplete="off" required>
      <br>


      <input class="btn btn-success centrar-boton" type="submit" value="Crear">
    </form>

  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>

</html>
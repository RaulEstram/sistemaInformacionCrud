<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" href="./publico/assets/css/normalize.css">
  <link rel="stylesheet" href="./publico/assets/css/style.css">
  <title>User</title>
</head>

<body>

  <?php
  require_once 'views/header/headerlogin.php';
  ?>
  <?php
  $this->showMessages();
  ?>

  <h1 class="titulo centrar-texto">Configuraciones de Usuario</h1>
  <h2 class="subtitulo centrar-texto">Hola <?php echo $this->d['user']->getName() ?></h2>
  <br>
  <main>
    <div class="dash-content transparente centrar-bloque contenedor">

      <form action="<?php echo constant('URL') ?>user/updateName" method="post">
        <label class="form-label subsubtitulo" for="name">Nombre</label>
        <br>
        <input class="form-control" type="text" name="name" id="name" autocomplete="off" required value="<?php echo $this->d['user']->getName() ?>">
        <br>
        <input class="btn btn-success centrar-boton" type="submit" value="Cambiar Nombre">
      </form>

      <hr>
      <form action="<?php echo constant('URL') ?>user/updateLastname" method="post">
        <label class="form-label subsubtitulo" for="lastname">Apellido</label>
        <br>
        <input class="form-control" type="text" name="lastname" id="lastname" autocomplete="off" required value="<?php echo $this->d['user']->getLastname() ?>">
        <br>
        <input class="btn btn-success centrar-boton" type="submit" value="Cambiar Apellido">
      </form>
      <hr>
      <form action="<?php echo constant('URL') ?>user/updateUsername" method="post">
        <label class="form-label subsubtitulo" for="username">Username</label>
        <br>
        <input class="form-control" type="text" name="username" id="username" autocomplete="off" required value="<?php echo $this->d['user']->getUsername() ?>">
        <br>
        <input class="btn btn-success centrar-boton" type="submit" value="Cambiar Username">
      </form>
      <hr>
      <form action="<?php echo constant('URL') ?>user/updateEmail" method="post">
        <label class="form-label subsubtitulo" for="email">Email</label>
        <br>
        <input class="form-control" type="text" name="email" id="email" autocomplete="off" required value="<?php echo $this->d['user']->getEmail() ?>">
        <br>
        <input class="btn btn-success centrar-boton" type="submit" value="Cambiar Email">
      </form>
      <hr>
      //TODO: contraseña
      <form action="<?php echo constant('URL') ?>user/updateUsername" method="post">
        <label class="form-label subsubtitulo" for="username">Contraseña</label>
        <br>
        <input class="form-control" type="text" name="username" id="username" autocomplete="off" required value="<?php echo $this->d['user']->getUsername() ?>">
        <br>
        <input class="btn btn-success centrar-boton" type="submit" value="Cambiar username">
      </form>
      <hr>
      <p>Foto</p>
      <form action="<?php echo constant('URL') ?>user/updatePhoto" method="post" enctype="multipart/form-data">
        <?php
        if (!empty($this->d['user']->getPhoto())) {
        ?>
          <img src="<?php echo constant('URL') ?>publico/img/icons/<?php echo $this->d['user']->getPhoto() ?>" alt="Imagen de Perfil" width="50px" height="50px">
        <?php
        }
        ?>
        <br>
        <label class="form-label subsubtitulo" for="photo">Foto de perfil</label>
        <br>
        <input class="form-control" type="file" name="photo" id="photo" autocomplete="off" required>
        <br>
        <input class="btn btn-success centrar-boton" type="submit" value="Cambiar Foto">
      </form>
    </div>

  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>

</html>
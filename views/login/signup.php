<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="./publico/assets/css/normalize.css">
    <link rel="stylesheet" href="./publico/assets/css/style.css">

    <title>Sing up</title>
</head>

<body>
    <?php
    require_once 'views/header/headerlogout.php';
    ?>
    <h1 class="titulo centrar-texto">Registrarse</h1>
    <?php
    $this->showMessages();
    ?>
    <main>
        <div class="login-panel dash-content transparente contenedor centrar-bloque">

            <form action="<?php echo constant('URL'); ?>signup/newUser" method="POST">
                <label class="form-label" for="name">Nombre</label>
                <input class="form-control" type="text" name="name" id="name">
                <br>
                <label class="form-label" for="lastname">Apellido</label>
                <input class="form-control" type="text" name="lastname" id="lastname">
                <br>
                <label class="form-label" for="username">Username</label>
                <input class="form-control" type="text" name="username" id="username">
                <br>
                <label class="form-label" for="password">Contraseña</label>
                <input class="form-control" type="password" name="password" id="password">
                <br>
                <label class="form-label" for="email">Email</label>
                <input class="form-control" type="email" name="email" id="email">
                <br>
                <input class="btn btn-success centrar-boton" type="submit" value="Registrarse">
                <br>
                <p>¿Ya tienes una cuenta? <a href="<?php echo constant('URL') ?>login "> Iniciar Session</a></p>
            </form>
        </div>
    </main>
    <a href="<?php echo constant('URL') ?>home">Home</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>

</html>
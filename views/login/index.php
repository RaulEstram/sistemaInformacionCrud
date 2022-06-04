<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="./publico/assets/css/normalize.css">
    <link rel="stylesheet" href="./publico/assets/css/style.css">
    <title>Login</title>
</head>

<body>
    <?php
    require_once 'views/header/headerlogout.php';
    ?>
    <?php

    echo session_status();
    ?>

    <?php
    $this->showMessages();
    ?>

    <h1 class="titulo centrar-texto">Iniciar Session</h1>

    <main>
        <div class="login-panel dash-content transparente contenedor centrar-bloque">

            <form action="<?php echo constant('URL') ?>login/authenticate" method="post">

                <label class="form-label" for="username">username</label>
                <input type="text" class="form-control" name="username" id="username">
                <br>
                <label class="form-label" for="password">password</label>
                <input type="password" class="form-control" name="password" id="password">
                <br>
                <input type="submit" class="btn btn-success centrar-boton" value="Login">
                <br>
                <p>¿No tienes una cuenta? <a class="" href="<?php echo constant('URL') ?>signup "> Crear cuenta</a></p>
            </form>
        </div>
    </main>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>

</html>
<?php

    // manejo errores
    error_reporting(E_ALL); 
    
    ini_set('ignore_repeated_errors', TRUE); 

    ini_set('display_errors', FALSE); 

    ini_set('log_errors', TRUE); 
    
    ini_set('error_log', './errors-log/my-errors.log');

    error_log("Inicio de Aplicacion");

    require_once 'config/config.php';

    require_once 'libs/database.php';
    require_once 'libs/controller.php';
    require_once 'libs/model.php';
    require_once 'libs/view.php';
    require_once 'libs/app.php';
    
    require_once 'models/usermodel.php';
    require_once 'models/loginmodel.php';
    require_once 'models/expensesmodel.php';
    require_once 'models/categoriesmodel.php';
    require_once 'models/incomesmodel.php';
    

    $app = new App();
?>

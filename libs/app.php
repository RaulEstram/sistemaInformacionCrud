<?php

    require_once './controllers/errores.php';

    class App{

        function __construct(){
            // acabado 1
            $url = isset($_GET['url']) ? $_GET['url'] : null;
            $url = rtrim($url, '/');
            $url = explode('/', $url);
            // acabado 2
            // cuando se ingresa sin definir el controlador
            if(empty($url[0])){
                $archivoController = 'controllers/home.php';
                require_once $archivoController;
                $controller = new Home();
                $controller->render();
                return false;
            }

            // acabado 3
            $archivoController = 'controllers/' . $url[0] . '.php';
            if (file_exists($archivoController)){
                require_once $archivoController;               
                
                // inicializar controlador
                $controller = new $url[0];
                $controller->loadModel($url[0]);
                
                // si hay un metodo  que se requiere cargar
                if(isset($url[1])){
                    if(method_exists($controller, $url[1])){
                        if(isset($url[2])){
                            // no de parametros
                            $nparam = sizeof($url) - 2;
                            // arreglo de parametros
                            $params = [];
                            for ($i=0; $i < $nparam; $i++) { 
                                array_push($params, $url[$i + 2]);
                            }
                            // ejecutar metodo con los paramatros
                            $controller->{$url[1]}($params);
                        }else {
                            // no tiene parametros, se manda a llamar, el metodo tal cual
                            try{
                                $controller->{$url[1]}();
                            } catch (ArgumentCountError $e ){
                                $controller->redirect('' . $url[0], []); 
                            }
                        }
                    }else {
                        // error, no existe el metodo
                        $controller = new Errores();
                        $controller->render();
                    }
                    
                }else{
                    // no hay metodo a cargar, se carga el metodod por default
                    $controller->render();
                }
            } else {
                // no existe el controlador, manda error
                $controller = new Errores();
                $controller->render();
            }
        }
    }

?>
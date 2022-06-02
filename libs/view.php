<?php

    // cosas basicas para las vistas

    class View{
        
        function __construct(){
        }

        function render ($nombre, $data = []){
            $this->d = $data;
            require_once 'views/'. $nombre . '.php';
        }

        
    }

?>
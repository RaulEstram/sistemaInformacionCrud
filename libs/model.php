<?php

    // clase de las cosas base que tiene un modelo, query y prepare para simplificar sintaxis

    include_once 'libs/imodel.php';

    class Model {
        function __construct(){
            $this->db = new Database();
        }

        function query($query){
            return $this->db->connect()->query($query);
        }

        function prepare($query){
            return $this->db->connect()->prepare($query);
        }
    }

?>
<?php

    // interfaz con los metodos que debe de tener un modelo

    interface IModel{
        public function save();
        public function getAll();
        public function get(int $id);
        public function delete(int $id);
        public function update();
        public function from(array $array);
    }

?>
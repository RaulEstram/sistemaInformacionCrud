<?php
    class Home extends Controller{
        function __construct(){
            parent::__construct();   
        }

        public function render(){
            $this->view->render('home/index', ['session' => false]);
        }
    }
?>
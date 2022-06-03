<?php

    class User extends Controller{
        
        function __construct(){
            parent::__construct();   
        }

        public function render(){
            $this->view->render('user/index', [
            ]);
        }

       
    }

?>
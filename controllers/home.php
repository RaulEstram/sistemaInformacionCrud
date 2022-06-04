<?php

    class Home extends SessionController{
        function __construct(){
            parent::__construct();   
            $this->user = $this->getUserSessionData();
        }

        public function render(){
            if ($this->user == NULL) {
                $this->view->render('home/index', ['session' => false]);
            } else {
                $this->view->render('home/index', ['session' => true]);
            }

        }
    }

?>
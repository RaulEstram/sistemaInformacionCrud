<?php
    class Categories extends Controller {


        function __construct(){
            parent::__construct(); 
            $this->loadModel('categories');
        }

        function render(){
            $categories = new CategoriesModel();
            $this->view->render('categories/index', [
            ]);
        }

    }
?>
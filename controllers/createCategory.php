<?php
    class CreateCategory extends Controller {


        function __construct(){
            parent::__construct(); 
            $this->loadModel('categories');
        }

        function render(){
            $category = new CategoriesModel();
            $this->view->render('categories/create',[
            ]);
        }

    }
?>
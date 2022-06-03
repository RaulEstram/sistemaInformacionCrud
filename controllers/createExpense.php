<?php
    class CreateExpense extends Controller {


        function __construct(){
            parent::__construct(); 
            $this->loadModel('expenses');
        }

        function render(){
            $category = new CategoriesModel();
            $this->view->render('expenses/create',[
            ]);
        }

    }
?>
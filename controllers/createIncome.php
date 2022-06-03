<?php
    class CreateIncome extends Controller {

        function __construct(){
            parent::__construct(); 
            $this->loadModel('incomes');
        }

        function render(){
            $category = new CategoriesModel();
            $this->view->render('incomes/create',[
            ]);
        }

    }
?>
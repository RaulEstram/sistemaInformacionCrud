<?php
    class Incomes extends Controller {

        function __construct(){
            parent::__construct(); 
            $this->loadModel('incomes');
        }

        function render(){
            $incomes = new IncomesModel();
            $categories = new CategoriesModel();
            $this->view->render('incomes/index', [
            ]);
        }

    }
?>
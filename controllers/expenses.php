<?php
    class Expenses extends Controller {

        function __construct(){
            parent::__construct(); 
            $this->loadModel('expenses');
        }

        function render(){
            $expenses = new ExpensesModel();
            $categories = new CategoriesModel();
            $this->view->render('expenses/index', []);
        }
    }
?>
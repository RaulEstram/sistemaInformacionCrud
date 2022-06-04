<?php

    class Dashboard extends SessionController{
        
        private $user;        
        function __construct()
        {
            parent::__construct();
            $this->user = $this->getUserSessionData();
            error_log('Dashboard::construct -> inicio de login');
        }

        function render(){
            error_log('Dashboard::render -> Carga el index de Dashboard');
            
            $expensesModel = new ExpensesModel();
            $incomesModel = new IncomesModel();
            $categoriesModel = new CategoriesModel();
            
            $expenses = $expensesModel->getByUserIdAndLimit($this->user->getId(), 5);
            
            $totalExpensesThisMonth = number_format(floatval($expensesModel->getTotalAmountThisMonth($this->user->getId())), 2);
            $maxExpensesThisMonth = number_format(floatval($expensesModel->getMaxExpensesThisMonth($this->user->getId())), 2) ;
            
            $incomes = $incomesModel->getByUserIdAndLimit($this->user->getiD(), 5);
            
            $totalIncomesThisMonth = number_format( floatval( $incomesModel->getTotalAmountThisMonth($this->user->getId())),2);
            $maxIncomesThisMonth = number_format( floatval( $incomesModel->getMaxIncomesThisMonth($this->user->getId())),2);
            
            $expensesCategories = $categoriesModel->getResumeExpensesByUserAndMonth($this->user->getId());
            $incomesCategories = $categoriesModel->getResumeIncomesByUserAndMonth($this->user->getId());
            $this->view->render('dashboard/index',[
                'user'                  => $this->user,
                'expenses'              => $expenses,
                'totalExpenses'         => $totalExpensesThisMonth,
                'maxExpense'            => $maxExpensesThisMonth,
                'incomes'               => $incomes,
                'totalIncomes'          => $totalIncomesThisMonth,
                'maxIncomes'            => $maxIncomesThisMonth,
                'expensesCategories'    => $expensesCategories,
                'incomesCategories'     => $incomesCategories
            ]);
        }


    }

?>
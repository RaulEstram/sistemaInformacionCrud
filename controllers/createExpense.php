<?php
    class CreateExpense extends SessionController {

        private $user;

        function __construct(){
            parent::__construct(); 
            $this->loadModel('expenses');
            $this->user = $this->getUserSessionData();
        }

        function render(){
            $category = new CategoriesModel();
            $categories = $category->getAllExpenseCategoriesByUser($this->user->getId());
            $this->view->render('expenses/create',[
                'user' => $this->user,
                'categories' => $categories,
            ]);
        }

        // peticion
        function saveItem(){
            if (!$this->existPOST(['title', 'category_id', 'amount', 'date'])) {
                $this->redirect('createExpense', []); // TODO:
                return;
            }

            $title = $this->getPost('title');
            $amount = $this->getPost('amount');
            $date = $this->getPost('date');
            $category = $this->getPost('category_id');

            if ($this->user == NULL || empty($title) || empty($amount) || empty($category) || empty($date)) {
                $this->redirect('createExpense', []); // TODO: 
            }

            $income = new ExpensesModel();
            $income->setTitle($title);
            $income->setAmount($amount);
            $income->setCategory_id($category);
            $income->setUser_id($this->user->getId());
            $income->setDate($date);

            if($income->save()){
                $this->redirect('createExpense', []); //TODO:
            }

            $this->redirect('createExpense', []); // TODO: 
        }

    }
?>
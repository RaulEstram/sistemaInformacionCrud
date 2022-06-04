<?php
    class Expenses extends SessionController {

        private $user;

        function __construct(){
            parent::__construct(); 
            $this->loadModel('expenses');
            $this->user = $this->getUserSessionData();
        }

        function render(){
            error_log("xxxxxxxxxxxxxxxxx");
            $expenses = new ExpensesModel();
            $categories = new CategoriesModel();
            $this->view->render('expenses/index', [
                'expenses' => $expenses->getAllByUserId($this->user->getId()),
                'user' => $this->user,
                'categories' => $categories->getAllExpenseCategoriesByUser($this->user->getId())
            ]);
        }
        // peticion
        function deleteItem(){
            if (!$this->existPOST(['id'])) {
                $this->redirect('expenses', []); // TODO:
                return;
            }
            $id = $this->getPost('id');

            if ($this->user == NULL || empty($id)) {
                $this->redirect('expenses', []); // TODO: 
            }

            $income = new ExpensesModel();
            $income->get($id);

            if($income->delete($income->getId())){
                $this->redirect('expenses', []); //TODO:
            }

            $this->redirect('expenses', []); // TODO: 
        }
        // peticion
        function updateItem(){
            if (!$this->existPOST(['id','title', 'category_id', 'amount', 'date'])) {
                $this->redirect('expenses', []); // TODO:
                return;
            }
            $id = $this->getPost('id');
            $title = $this->getPost('title');
            $amount = $this->getPost('amount');
            $date = $this->getPost('date');
            $category = $this->getPost('category_id');

            if ($this->user == NULL || empty($id) || empty($title) || empty($amount) || empty($category) || empty($date)) {
                $this->redirect('expenses', []); // TODO: 
            }

            $income = new ExpensesModel();
            $income->get($id);
            $income->setTitle($title);
            $income->setAmount($amount);
            $income->setCategory_id($category);
            $income->setDate($date);

            if($income->update()){
                $this->redirect('expenses', []); //TODO:
            }

            $this->redirect('expenses', []); // TODO: 
        }

    }
?>
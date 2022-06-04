<?php
    class CreateIncome extends SessionController {

        private $user;

        function __construct(){
            parent::__construct(); 
            $this->loadModel('incomes');
            $this->user = $this->getUserSessionData();
        }

        function render(){
            $category = new CategoriesModel();
            $categories = $category->getAllIncomeCategoriesByUser($this->user->getId());
            $this->view->render('incomes/create',[
                'user' => $this->user,
                'categories' => $categories,
            ]);
        }

        // peticion
        function saveItem(){
            if (!$this->existPOST(['title', 'category_id', 'amount', 'date'])) {
                $this->redirect('createIncome', []); // TODO:
                return;
            }

            $title = $this->getPost('title');
            $amount = $this->getPost('amount');
            $date = $this->getPost('date');
            $category = $this->getPost('category_id');

            if ($this->user == NULL || empty($title) || empty($amount) || empty($category) || empty($date)) {
                $this->redirect('createIncome', []); // TODO: 
            }

            $income = new IncomesModel();
            $income->setTitle($title);
            $income->setAmount($amount);
            $income->setCategory_id($category);
            $income->setUser_id($this->user->getId());
            $income->setDate($date);

            if($income->save()){
                $this->redirect('createIncome', []); //TODO:
            }

            $this->redirect('createIncome', []); // TODO: 
        }
    }
?>
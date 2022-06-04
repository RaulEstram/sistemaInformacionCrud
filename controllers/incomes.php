<?php
    class Incomes extends SessionController {

        private $user;

        function __construct(){
            parent::__construct(); 
            $this->loadModel('incomes');
            $this->user = $this->getUserSessionData();
        }

        function render(){
            $incomes = new IncomesModel();
            $categories = new CategoriesModel();
            $this->view->render('incomes/index', [
                'incomes' => $incomes->getAllByUserId($this->user->getId()),
                'user' => $this->user,
                'categories' => $categories->getAllIncomeCategoriesByUser($this->user->getId())
            ]);
        }
        // peticiondeleteItem
        function deleteItem(){
            if (!$this->existPOST(['id'])) {
                $this->redirect('incomes', []); // TODO:
                return;
            }
            $id = $this->getPost('id');

            if ($this->user == NULL || empty($id)) {
                $this->redirect('incomes', []); // TODO: 
            }

            $income = new IncomesModel();
            $income->get($id);

            if($income->delete($income->getId())){
                $this->redirect('incomes', []); //TODO:
            }

            $this->redirect('incomes', []); // TODO: 
        }
        
        // peticion
        function updateItem(){
            if (!$this->existPOST(['id','title', 'category_id', 'amount', 'date'])) {
                $this->redirect('incomes', []); // TODO:
                return;
            }
            $id = $this->getPost('id');
            $title = $this->getPost('title');
            $amount = $this->getPost('amount');
            $date = $this->getPost('date');
            $category = $this->getPost('category_id');

            if ($this->user == NULL || empty($id) || empty($title) || empty($amount) || empty($category) || empty($date)) {
                $this->redirect('incomes', []); // TODO: 
            }

            $income = new IncomesModel();
            $income->get($id);
            $income->setTitle($title);
            $income->setAmount($amount);
            $income->setCategory_id($category);
            $income->setDate($date);

            if($income->update()){
                $this->redirect('incomes', []); //TODO:
            }

            $this->redirect('incomes', []); // TODO: 
        }



    }
?>
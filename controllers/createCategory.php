<?php
    class CreateCategory extends SessionController {

        private $user;

        function __construct(){
            parent::__construct(); 
            $this->loadModel('categories');
            $this->user = $this->getUserSessionData();
        }

        function render(){
            $category = new CategoriesModel();
            $categories = $category->getAllExpenseCategoriesByUser($this->user->getId());
            $categories = $category->getAllExpenseCategoriesByUser($this->user->getId());
            $this->view->render('categories/create',[
                'user' => $this->user,
                'categories' => $categories,
            ]);
        }

        // peticion
        function saveItem(){
            if (!$this->existPOST(['title', 'type'])) {
                $this->redirect('createCategory', []); // TODO:
                return;
            }
            $title = $this->getPost('title');
            $type = $this->getPost('type');

            if ($this->user == NULL || empty($id) || empty($title) || empty($type) || empty($user_id) ) {
                $this->redirect('createCategory', []); // TODO: 
            }

            $category = new CategoriesModel();
            $category->setTitle($title);
            $category->setType($type);
            $category->setUser_id($this->user->getId());

            if($category->save()){
                $this->redirect('createCategory', []); //TODO:
            }

            $this->redirect('createCategory', []); // TODO: 
        }

    }
?>
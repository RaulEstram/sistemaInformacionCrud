<?php
    class Categories extends SessionController {

        private $user;

        function __construct(){
            parent::__construct(); 
            $this->loadModel('categories');
            $this->user = $this->getUserSessionData();
        }

        function render(){
            $categories = new CategoriesModel();
            $this->view->render('categories/index', [
                'user' => $this->user,
                'categories' => $categories->getAllByUser($this->user->getId())
            ]);
        }
        // peticiondeleteItem
        function deleteItem(){
            if (!$this->existPOST(['id'])) {
                $this->redirect('categories', []); // TODO:
                return;
            }
            $id = $this->getPost('id');

            if ($this->user == NULL || empty($id)) {
                $this->redirect('categories', []); // TODO: 
            }

            $category = new CategoriesModel();
            $category->get($id);

            if($category->delete($category->getId())){
                $this->redirect('categories', []); //TODO:
            }

            $this->redirect('categories', []); // TODO: 
        }
        
        // peticion
        function updateItem(){
            if (!$this->existPOST(['id','title', 'type'])) {
                $this->redirect('categories', []); // TODO:
                return;
            }
            $id = $this->getPost('id');
            $title = $this->getPost('title');
            $type = $this->getPost('type');

            if ($this->user == NULL || empty($id) || empty($title) || empty($type) || empty($user_id) ) {
                $this->redirect('categories', []); // TODO: 
            }

            $category = new CategoriesModel();
            $category->get($id);
            $category->setTitle($title);
            $category->setType($type);
            $category->setUser_id($this->user->getId());

            if($category->update()){
                $this->redirect('categories', []); //TODO:
            }

            $this->redirect('categories', []); // TODO: 
        }



    }
?>
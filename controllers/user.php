<?php

    class User extends SessionController{
        
        private $user;

        function __construct(){
            parent::__construct();   
            $this->user = $this->getUserSessionData();
        }

        public function render(){
            $this->view->render('user/index', [
                'user' => $this->user
            ]);
        }

        function updateBudget(){
            if(!$this->existPOST('budget')){
                $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATEBUDGET]); 
                return;
            }
            
            $budget = $this->getPost('budget');
            
            if (empty($budget) || $budget == 0 || $budget < 0) {
                $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATEBUDGET_EMPTY]);  
                return;
            }

            $this->user->setBudget($budget);
            if($this->user->update()){
                $this->redirect('user', ['success' => Success::SUCCESS_USER_UPDATEBUDGET]); 
                return;
            } else {
                $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATEBUDGET]); 
            }
        }

        function updateName(){
            if(!$this->existPOST('name')){
                $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATENAME ]); 
                return;
            }
            
            $name = $this->getPost('name');
            
            if (empty($name) || $name == NULL) {
                $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATENAME_EMPTY ]);    
                return;
            }

            $this->user->setName($name);
            if($this->user->update()){
                $this->redirect('user', ['success' => Success::SUCCESS_USER_UPDATENAME]); 
                return;
            } else {
                $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATENAME ]); 
            }
        }

        function updateUsername(){
            if(!$this->existPOST('username')){
                $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATEUSERNAME ]); 
                return;
            }
            
            $username = $this->getPost('username');
            
            if (empty($username) || $username == NULL) {
                $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATEUSERNAME_EMPTY ]);    
                return;
            }

            $this->user->setUsername($username);
            if($this->user->update()){
                $this->redirect('user', ['success' => Success::SUCCESS_USER_UPDATEUSERNAME]); 
                return;
            } else {
                $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATEUSERNAME ]); 
            }
        }


        function updatelastname(){
            if(!$this->existPOST('lastname')){
                $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATELASTNAME ]); 
                return;
            }
            
            $lastname = $this->getPost('lastname');
            
            if (empty($lastname) || $lastname == NULL) {
                $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATELASTNAME_EMPTY ]);    
                return;
            }

            $this->user->setLastname($lastname);
            if($this->user->update()){
                $this->redirect('user', ['success' => Success::SUCCESS_USER_UPDATELASTNAME]); 
                return;
            } else {
                $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATELASTNAME ]); 
            }

        }

        function updateEmail(){
            if(!$this->existPOST('email')){
                $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATEEMAIL ]); 
                return;
            }
            
            $email = $this->getPost('email');
            
            if (empty($email) || $email == NULL) {
                $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATEEMAIL_EMPTY]);    
                return;
            }

            $this->user->setEmail($email);
            if($this->user->update()){
                $this->redirect('user', ['success' => Success::SUCCESS_USER_UPDATEEMAIL]); 
                return;
            } else {
                $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATEEMAIL_EMPTY ]); 
            }
        }

        function updatePassword(){
            if(!$this->existPOST(['current_password', 'new_password'])){
                $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATEPASSWORD]);
                return;
            }
            
            $current = $this->getPost('current_password');
            $new = $this->getPost('new_password');
            
            if (empty($current) || $current == NULL || empty($new) || $new == NULL) {
                $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATEPASSWORD_EMPTY]);
                return;
            }

            if($current === $new){
                $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATEPASSWORD_ISNOTTHESAME]);
                return;
            }
            $this->loadModel('user');
            if ($this->model->comparePasswords($current, $this->user->getPassword())) {
                $this->user->setPassword($new);
                if ($this->user->update()) {
                    $this->redirect('user', ['success' => Success::SUCCESS_USER_UPDATEPASSWORD]);
                } else {
                    $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATEPASSWORD]);
                }
            }else{
                $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATEPASSWORD]);
                return;
            }

        }
        
        function updatePhoto(){
            if (!isset($_FILES['photo'])) {
                $this->redirect('dashboard', ['error' => Errors::ERROR_USER_UPDATEPHOTO]);
                return;
            }

            $photo = $_FILES['photo'];
            $target_dir = "publico/img/icons/";
            // quitarle extencion a nuestra foto (name metadato)
            $extension = explode('.', $photo["name"]);
            // guardamos el nombre 
            $filename = $extension[sizeof($extension) - 2]; 
            // guardamos extension
            $ext = $extension[sizeof($extension)-1];
            // obtenemos hash del nombre del archivo junto la fecha para usarlo como el nombre del archivo y al final se asignamos su extension
            $hash = hash('sha256', $filename . Date('ymdgi')) . '.' . $ext;
            // creamos el el path de archivo final
            $target_file = $target_dir . $hash;
            // instruccion para saber si la imagen si esta lista para guardar
            $uploadOk = 1;
            // especificar el tipo de imagen
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // comprobamos si existe como tal una imagen sabiendo si existe algun tamaño de la imagen
            $check = getimagesize($photo["tmp_name"]);

            if($check !== false) {
                //echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                //echo "File is not an image.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATEPHOTO_FORMAT]);
            } else {
                if (move_uploaded_file($photo["tmp_name"], $target_file)) {
                    $this->loadModel('user');
                    $this->model->updatePhoto($hash, $this->user->getId());
                    $this->redirect('user', ['success' => Success::SUCCESS_USER_UPDATEPHOTO]);
                } else {
                    $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATEPHOTO]);
                }
            }

        }
    }

?>
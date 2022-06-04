<?php
    class Signup extends SessionController{
        
        function __construct(){
            parent::__construct();
        }

        function render(){
            error_log('SINGUP::render() --> mostrando vista');
            $this->view->render('login/signup', []);
        }

        /*
        cuando el usuario se registre se llamara a este metodo
        1.- tomar los datos
        2.- validar datos
        3.- crear usuarios 
        */
        function newUser(){
            error_log('SIGNUP::newUser() --> entro al metodo');
            if($this->existPOST(['name','lastname','username', 'password', 'email'])){
                $name = $this->getPost('name');
                $lastname = $this->getPost('lastname');
                $username = $this->getPost('username');
                $password = $this->getPost('password');
                $email = $this->getPost('email');

                if ($name == '' || empty($name) || $lastname == '' || empty($lastname) || $username == '' || empty($username) || $password == '' || empty($password) || $email == '' || empty($email)) {
                    error_log('SIGNUP::newUser() --> algun valor esta vacio');
                    $this->redirect('signup', ['error' => 'a5bcd7089d83f45e17e989fbc86003ed']);
                }

                $user = new UserModel();
                $user->setName($name);
                $user->setLastname($lastname);
                $user->setUsername($username);
                $user->setPassword($password);
                $user->setEmail($email);
                

                if ($user->exists_username($username) || $user->exists_email($email)) {
                    error_log('SIGNUP::newUser() --> Username o email ya existen');
                    $this->redirect('signup', ['error' => 'a74accfd26e06d012266810952678cf3']);
                } else if ($user->save()){
                    error_log('SIGNUP::newUser() --> se guardo');
                    $this->redirect('login', ['success' => '8281e04ed52ccfc13820d0f6acb0985a']);
                } else {
                    error_log('SIGNUP::newUser() --> Error al guardar el usuario');
                    $this->redirect('signup', ['error' => '1fdce6bbf47d6b26a9cd809ea1910222']);
                }
            }else{
                error_log('SIGNUP::newUser() --> no estan los datos necesarios');
                $this->redirect('signup', ['error' => '1fdce6bbf47d6b26a9cd809ea1910222']);
            }
        }
    }
?>
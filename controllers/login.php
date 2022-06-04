<?php

    class Login extends SessionController{
        function __construct()
        {
            parent::__construct();
            error_log('Login::construct -> inicio de login');
        }

        function render(){
            error_log('Login::render -> Carga el index de login');
            $this->view->render('login/index');
        }

        function authenticate(){
            if( $this->existPOST(['username', 'password']) ){
                $username = $this->getPost('username');
                $password = $this->getPost('password');
    
                //validate data
                if($username == '' || empty($username) || $password == '' || empty($password)){
                    //$this->errorAtLogin('Campos vacios');
                    error_log('Login::authenticate() empty');
                    $this->redirect('login', ['error' => Errors::ERROR_LOGIN_AUTHENTICATE_EMPTY]);
                    return;
                }
                // si el login es exitoso regresa solo el ID del usuario
                $this->loadModel('login');
                $user = $this->model->login($username, $password);
                
                if($user != NULL){
                    // inicializa el proceso de las sesiones
                    error_log('Login::authenticate() passed');    
                    $this->initialize($user);
                }else{
                    //error al registrar, que intente de nuevo
                    //$this->errorAtLogin('Nombre de usuario y/o password incorrecto');
                    error_log('Login::authenticate() username and/or password wrong');
                    $this->redirect('login', ['error' => Errors::ERROR_LOGIN_AUTHENTICATE_DATA]);
                    return;
                }
            }else{
                // error, cargar vista con errores
                //$this->errorAtLogin('Error al procesar solicitud');
                error_log('Login::authenticate() error with params');
                $this->redirect('login', ['error' => Errors::ERROR_LOGIN_AUTHENTICATE]);
            }
        }
    }

?>
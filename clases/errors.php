<?php

    class Errors{
        //ERROR|SUCCESS
        //Controller
        //method
        //operation
        // dfb4dc6544b0dae81ea132de667b2a5d

        
        // 2
        const ERROR_LOGIN_AUTHENTICATE               = "11c37cfab311fbe28652f4947a9523c4";
        // 2
        const ERROR_LOGIN_AUTHENTICATE_EMPTY         = "2194ac064912be67fc164539dc435a42";
        // 2
        const ERROR_LOGIN_AUTHENTICATE_DATA          = "bcbe63ed8464684af6945ad8a89f76f8";
        // 1
        const ERROR_SIGNUP_NEWUSER                   = "1fdce6bbf47d6b26a9cd809ea1910222";
        // 1
        const ERROR_SIGNUP_NEWUSER_EMPTY             = "a5bcd7089d83f45e17e989fbc86003ed";
        // 1
        const ERROR_SIGNUP_NEWUSER_EXISTS            = "a74accfd26e06d012266810952678cf3";

        private $errorsList = [];

        public function __construct(){
            $this->errorsList = [
                Errors::ERROR_LOGIN_AUTHENTICATE        => 'Hubo un problema al autenticarse',
                Errors::ERROR_LOGIN_AUTHENTICATE_EMPTY  => 'Los parámetros para autenticar no pueden estar vacíos',
                Errors::ERROR_LOGIN_AUTHENTICATE_DATA   => 'Nombre de usuario y/o password incorrectos',
                Errors::ERROR_SIGNUP_NEWUSER            => 'Hubo un error al intentar registrarte. Intenta de nuevo',
                Errors::ERROR_SIGNUP_NEWUSER_EMPTY      => 'Los campos no pueden estar vacíos',
                Errors::ERROR_SIGNUP_NEWUSER_EXISTS     => 'El nombre de usuario ya existe, selecciona otro',
            ];
        }

        function get($hash){
            return $this->errorsList[$hash];
        }

        function existsKey($key){
            if(array_key_exists($key, $this->errorsList)){
                return true;
            }else{
                return false;
            }
        }
    }
?>
<?php

    class Success{
        //ERROR|SUCCESS
        //Controller
        //method
        //operation

        const SUCCESS_SIGNUP_NEWUSER       = "8281e04ed52ccfc13820d0f6acb0985a";
        
        private $successList = [];

        public function __construct(){
            $this->successList = [
                Success::SUCCESS_SIGNUP_NEWUSER => "Usuario registrado correctamente"
            ];
        }

        function get($hash){
            return $this->successList[$hash];
        }

        function existsKey($key){
            if(array_key_exists($key, $this->successList)){
                return true;
            }else{
                return false;
            }
        }
    }
?>
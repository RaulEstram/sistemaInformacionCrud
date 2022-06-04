<?php

    class Success{
        //ERROR|SUCCESS
        //Controller
        //method
        //operation
        
        const SUCCESS_ADMIN_NEWCATEGORY     = "f52228665c4f14c8695b194f670b0ef1";
        const SUCCESS_EXPENSES_DELETE       = "fcd919285d5759328b143801573ec47d";
        const SUCCESS_EXPENSES_NEWEXPENSE   = "fbbd0f23184e820e1df466abe6102955";
        const SUCCESS_USER_UPDATEBUDGET     = "2ee085ac8828407f4908e4d134195e5c";
        const SUCCESS_USER_UPDATENAME       = "6fb34a5e4118fb823636ca24a1d21669";
        const SUCCESS_USER_UPDATEUSERNAME   = "77284f4f74998718a6eca405b30dc831";
        const SUCCESS_USER_UPDATELASTNAME   = "5906512ea5c1ade008a94dd88ac3b7bc";
        const SUCCESS_USER_UPDATEEMAIL      = "a88dda85dab76c3ecee05a072e1c13d5";
        const SUCCESS_USER_UPDATEPASSWORD   = "251d974a5234c85fecfe546f5d77accd";
        const SUCCESS_USER_UPDATEPHOTO      = "edabc9e4581fee3f0056fff4685ee9a8";
        const SUCCESS_SIGNUP_NEWUSER       = "8281e04ed52ccfc13820d0f6acb0985a";
        
        private $successList = [];

        public function __construct(){
            $this->successList = [
                Success::SUCCESS_ADMIN_NEWCATEGORY => "Nueva categoría creada correctamente",
                Success::SUCCESS_EXPENSES_DELETE => "Gasto eliminado correctamente",
                Success::SUCCESS_EXPENSES_NEWEXPENSE => "Nuevo gasto registrado correctamente",
                Success::SUCCESS_USER_UPDATEBUDGET => "Presupuesto actualizado correctamente",
                Success::SUCCESS_USER_UPDATENAME => "Nombre actualizado correctamente",
                Success::SUCCESS_USER_UPDATELASTNAME => "Apellido actualizado correctamente",
                Success::SUCCESS_USER_UPDATEEMAIL => "Email actualizado correctamente",
                Success::SUCCESS_USER_UPDATEUSERNAME => "Username actualizado correctamente",
                Success::SUCCESS_USER_UPDATEPASSWORD => "Contraseña actualizado correctamente",
                Success::SUCCESS_USER_UPDATEPHOTO => "Imagen de usuario actualizada correctamente",
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
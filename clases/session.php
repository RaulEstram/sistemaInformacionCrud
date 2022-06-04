<?php
    
    class Session{
        
        private string $sessionName = 'user';

        public function __construct(){
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        }

        public function setCurrentUser($user): void{
            $_SESSION[$this->sessionName] = $user;
        }
    
        public function getCurrentUser(){
            return $_SESSION[$this->sessionName];
        }
    
        public function closeSession(): void{
            session_unset();
            session_destroy();
        }
    
        public function exists(): bool{
            return isset($_SESSION[$this->sessionName]);
        }
    }

?>
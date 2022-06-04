<?php

    class View{
        
        function __construct(){
        }

        function render ($nombre, $data = []){
            $this->d = $data;
            $this->handleMessages();
            error_log('views/'. $nombre . '.php --> ' . file_exists('views/'. $nombre . '.php'));
            require_once 'views/'. $nombre . '.php';
        }

        private function handleMessages(){
            if(isset($_GET['success']) && isset($_GET['error'])){
                // no se muestra nada porque no puede haber un error y success al mismo tiempo
            }else if(isset($_GET['success'])){
                $this->handleSuccess();
            }else if(isset($_GET['error'])){
                $this->handleError();
            }
        }

        private function handleError(){
            if(isset($_GET['error'])){
                $hash = $_GET['error'];
                $errors = new Errors();
                if($errors->existsKey($hash)){
                    error_log('View::handleError() existsKey =>' . $errors->get($hash));
                    $this->d['error'] = $errors->get($hash);
                }else{
                    $this->d['error'] = NULL;
                }
            }
        }
    
        private function handleSuccess(){
            if(isset($_GET['success'])){
                $hash = $_GET['success'];
                $success = new Success();
                if($success->existsKey($hash)){
                    error_log('View::handleError() existsKey =>' . $success->existsKey($hash));
                    $this->d['success'] = $success->get($hash);
                }else{
                    $this->d['success'] = NULL;
                }
            }
        }

        public function showMessages(){
            $this->showError();
            $this->showSuccess();
        }
        
        public function showError(){
            if(array_key_exists('error', $this->d)){
                echo '<div class="mensaje alert alert-danger alert-dismissible d-flex align-items-center" role="alert">';
                echo '<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>';
                echo "<div><p>" . $this->d['error'] ."</p></div>";
                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                echo '</div>';
            }
        }
    
        public function showSuccess(){
            if(array_key_exists('success', $this->d)){
                echo '<div class="success">'.$this->d['success'].'</div>';
            }
        }
        
    }

?>
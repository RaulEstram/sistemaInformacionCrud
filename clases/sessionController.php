<?php
    /**
     * Controlador que también maneja las sesiones
     */
    class SessionController extends Controller{
        
        private $userSession;
        private $username;
        private $userid;

        private $session;
        private $sites;

        private $user;
    
        function __construct(){
            parent::__construct();

            $this->init();
        }

        public function getUserSession(): string{
            return $this->userSession;
        }

        public function getUsername(): string{
            return $this->username;
        }

        public function getUserId(): int{
            return $this->userid;
        }

        private function init(){
            $this->session = new Session();
            $json = $this->getJSONFileConfig();
            $this->sites = $json['sites'];
            $this->defaultSites = $json['default-sites'];
            $this->validateSession();
        }

        private function getJSONFileConfig(): mixed{
            $string = file_get_contents("config/access.json");
            $json = json_decode($string, true);

            return $json;
        }

        /**
         * Implementa el flujo de autorización
         * para entrar a las páginas
         */
        function validateSession(){
            error_log('SessionController::validateSession()');
            //Si existe la sesión
            if($this->existsSession()){

                $role = $this->getUserSessionData()->getRole();

                error_log("sessionController::validateSession(): username:" . $this->user->getUsername() . " - role: " . $this->user->getRole());
                if($this->isPublic()){
                    error_log("aa");
                    if ($this->isNone()) {
                        error_log("bb");
                        return;
                    }else{
                        error_log("cc");
                        $this->redirectDefaultSiteByRole($role);
                    }
                    error_log( "SessionController::validateSession() => sitio público, redirige al main de cada rol" );
                }else{
                    if($this->isAuthorized($role)){
                        error_log( "SessionController::validateSession() => autorizado, lo deja pasar" );
                        //si el usuario está en una página de acuerdo
                        // a sus permisos termina el flujo
                    }else{
                        error_log( "SessionController::validateSession() => no autorizado, redirige al main de cada rol" );
                        // si el usuario no tiene permiso para estar en
                        // esa página lo redirije a la página de inicio
                        $this->redirectDefaultSiteByRole($role);
                    }
                }
            }else{
                error_log("no session");
                //No existe ninguna sesión
                //se valida si el acceso es público o no
                if($this->isPublic()){
                    error_log('SessionController::validateSession() public page');
                    //la pagina es publica
                    //no pasa nada
                }else{
                    //la página no es pública
                    //redirect al login
                    error_log('SessionController::validateSession() redirect al login');
                    header('location: '. constant('URL') . 'login');
                }
            }
        }

        function existsSession(): bool{
            if(!$this->session->exists()) return false;
            if($this->session->getCurrentUser() == NULL) return false;
            
            $userid = $this->session->getCurrentUser();
            if($userid) return true;
            return false;
        }

        function getUserSessionData(): UserModel | NULL{
            try {
                $id = $this->session->getCurrentUser();
                $this->user = new UserModel();
                $this->user->get($id);
                error_log("sessionController::getUserSessionData(): " . $this->user->getUsername());
                return $this->user;
            } catch (TypeError $e) {
                return NULL;
            }
            
        }

        public function initialize($user){
            error_log("sessionController::initialize(): user: " . $user->getUsername());
            error_log("sessionController::initialize(): id: " . $user->getId());
            $this->session->setCurrentUser($user->getId());
            $this->authorizeAccess($user->getRole());
        }

        private function isPublic(){
            $currentURL = $this->getCurrentPage();
            error_log("sessionController::isPublic(): currentURL => " . $currentURL);
            $currentURL = preg_replace( "/\?.*/", "", $currentURL); //omitir get info
            for($i = 0; $i < sizeof($this->sites); $i++){
                if($currentURL === $this->sites[$i]['site'] && ($this->sites[$i]['access'] === 'public' || $this->sites[$i]['access'] === '' )){
                    error_log("is public");
                    return true;
                }
            }
            return false;
        }

        private function isNone(){
            $currentURL = $this->getCurrentPage();
            error_log("sessionController::isPublic(): currentURL => " . $currentURL);
            $currentURL = preg_replace( "/\?.*/", "", $currentURL); //omitir get info
            for($i = 0; $i < sizeof($this->sites); $i++){
                if($currentURL == $this->sites[$i]['site'] && $this->sites[$i]['role'] === ''  && $this->sites[$i]['access'] === 'public' ){
                    error_log("is none");
                    return true;
                }
            }
            return false;
        }

        private function redirectDefaultSiteByRole($role){
            /* 
            $url = '';
            for($i = 0; $i < sizeof($this->sites); $i++){
                if($this->sites[$i]['role'] === $role){
                    $url = '/sistemaDeInformacionCrud/'.$this->sites[$i]['site'];
                break;
                }
            }
            */
            $url = '';
            foreach ($this->defaultSites as $key => $value) {
                error_log($key . ' - ' . $value);
                if ($role == $key) {
                    $url = constant('URL') . $value;
                    break;
                }
            }

            header('location: '.$url);
        }

        private function isAuthorized($role){
            $currentURL = $this->getCurrentPage();
            $currentURL = preg_replace( "/\?.*/", "", $currentURL); //omitir get info
            
            for($i = 0; $i < sizeof($this->sites); $i++){
                if($currentURL === $this->sites[$i]['site'] && $this->sites[$i]['role'] === $role){
                    return true;
                }
            }
            return false;
        }

        private function getCurrentPage(){
            $actual_link = trim("$_SERVER[REQUEST_URI]");
            $url = explode('/', $actual_link);
            error_log("sessionController::getCurrentPage(): actualLink =>" . $actual_link . ", url => " . $url . " --> " . $url[2]);
            return $url[2];
        }

        function authorizeAccess($role){
            error_log("sessionController::authorizeAccess(): role: $role");
            switch($role){
                case 'user':
                    $this->redirect($this->defaultSites['user']);
                break;
                case 'admin':
                    $this->redirect($this->defaultSites['admin']);
                break;
                default:
            }
        }

        function logout(){
            $this->session->closeSession();
        }
    }

?>
<?php
    class UserModel extends Model implements IModel{
        
        private $id;
        private $name;
        private $lastname;
        private $email;
        private $username;
        private $password;
        private $role;
        private $budget;
        private $photo;


        public function __construct(){
            parent::__construct();
            $this->name = '';
            $this->lastname = '';
            $this->email = '';
            $this->username = '';
            $this->password = '';
            $this->role = 'user';
            $this->budget = 0.0;
            $this->photo = null;
        }

        // METODOS DE CLASE

        public function exists_username(string $username): bool{
            try{
                $query = $this->prepare('SELECT username FROM user WHERE username = :username');
                $query->execute( ['username' => $username]);
                if($query->rowCount() > 0){
                    return true;
                }else{
                    return false;
                }
            }catch(PDOException $e){
                error_log('USERMODEL::exists_username() --> Error al intentar comprobar si ya existe un username --> ' . $e);
                return false;
            }
        }

        public function exists_email(string $email): bool{
            try{
                $query = $this->prepare('SELECT email FROM user WHERE email = :email');
                $query->execute( ['email' => $email]);
                if($query->rowCount() > 0){
                    return true;
                }else{
                    return false;
                }
            }catch(PDOException $e){
                error_log('USERMODEL::exists_email() --> Error al intentar comprobar si ya existe un email --> ' . $e);
                return false;
            }
        }

        public function updateName(string $name, int $user_id): bool{
            try{
                $query = $this->prepare('UPDATE user SET name = :name WHERE id = :id');
                $query->execute(['name' => $name, 'id' => $user_id]);
                if($query->rowCount() > 0){
                    return true;
                }else{
                    return false;
                }
            }catch(PDOException $e){
                return NULL;
            }
        }

        public function updateLastname(string $lastname,int $user_id): bool{
            try{
                $query = $this->prepare('UPDATE user SET lastname = :lastname WHERE id = :id');
                $query->execute(['lastname' => $lastname, 'id' => $user_id]);
                if($query->rowCount() > 0){
                    return true;
                }else{
                    return false;
                }
            }catch(PDOException $e){
                return NULL;
            }
        }

        public function updateEmail(string $email, int $user_id): bool{
            try{
                $query = $this->prepare('UPDATE user SET email = :email WHERE id = :id');
                $query->execute(['email' => $email, 'id' => $user_id]);
                if($query->rowCount() > 0){
                    return true;
                }else{
                    return false;
                }
            }catch(PDOException $e){
                return NULL;
            }
        }

        public function updateUsername(string $username, int $user_id): bool{
            try{
                $query = $this->prepare('UPDATE user SET username = :username WHERE id = :id');
                $query->execute(['username' => $username, 'id' => $user_id]);
                if($query->rowCount() > 0){
                    return true;
                }else{
                    return false;
                }
            }catch(PDOException $e){
                return NULL;
            }
        }

        public function updatePassword(string $password, int $user_id, bool $hash = true): bool{
            try{
                if ($hash){
                    $password = $this->getHashedPassword($password);
                }
                $query = $this->prepare('UPDATE user SET password = :password WHERE id = :id');
                $query->execute(['password' => $password, 'id' => $user_id]);
                if($query->rowCount() > 0){
                    return true;
                }else{
                    return false;
                }
            }catch(PDOException $e){
                return NULL;
            }
        }

        public function updateBudget(float $budget, int $user_id): bool{
            try{
                $query = $this->prepare('UPDATE user SET budget = :budget WHERE id = :id');
                $query->execute(['budget' => $budget, 'id' => $user_id]);
                if($query->rowCount() > 0){
                    return true;
                }else{
                    return false;
                }
            }catch(PDOException $e){
                return NULL;
            }
        }

        public function updatePhoto(string $photo, int $user_id): bool{
            try{
                $query = $this->prepare('UPDATE user SET photo = :photo WHERE id = :id');
                $query->execute(['photo' => $photo, 'id' => $user_id]);
                if($query->rowCount() > 0){
                    return true;
                }else{
                    return false;
                }
            }catch(PDOException $e){
                return NULL;
            }
        }

        public function comparePasswords(string $current,int $user_id, $hash = false): bool{
            try {
                $query = $this->prepare('SELECT id, password FROM user WHERE id = :id');
                $query->execute(['id' => $user_id]);
                if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    if (!$hash) {
                        $current = hash('sha256', $current);
                    }
                    return $current == $row['password'];
                }
                return false;
            } catch (\Throwable $th) {
                return false;
            }
        }

        // METODOS DE INTERFAZ IMODEL

        public function save(): bool{
            try {
                $query = $this->prepare('INSERT INTO user (name, lastname, email, username, password, role, budget, photo) VALUES(:name, :lastname, :email, :username, :password, :role, :budget, :photo)');
                $query->execute([
                    'name'      => $this->name,
                    'lastname'  => $this->lastname,
                    'email'     => $this->email,
                    'username'  => $this->username, 
                    'password'  => $this->password,
                    'role'      => $this->role,
                    'budget'    => $this->budget,
                    'photo'     => $this->photo,
                ]);

                return true;
            } catch (PDOException $e) {
                error_log('USERMODEL::save() --> Error al guardar el usuario --> ' . $e);
                return false;
            }
        }

        public function getAll(): array{
            $items = [];
            try {
                $query = $this->query('SELECT * FROM user');

                while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                    $item = new UserModel();
                    $item->setId($p['id']);
                    $item->setName($p['name']);
                    $item->setLastname($p['lastname']);
                    $item->setEmail($p['email']);
                    $item->setUsername($p['username']);
                    $item->setPassword($p['password'], false);
                    $item->setRole($p['role']);
                    $item->setBudget($p['budget']);
                    $item->setPhoto($p['photo']);
                    
                    array_push($items, $item);
                }

                return $items;
            } catch (PDOException $e) {
                error_log('USERMODEL::save() --> Error al guardar el usuario --> ' . $e);
                return $items;
            }
        }

        public function get(int $id): UserModel|bool{
            try {
                $query = $this->prepare('SELECT * FROM user WHERE id = :id');
                $query->execute(['id' => $id]);
                $user = $query->fetch(PDO::FETCH_ASSOC);

                $this->id       =   $user['id'];
                $this->name     =   $user['name'];
                $this->lastname =   $user['lastname'];
                $this->email    =   $user['email'];
                $this->username =   $user['username'];
                $this->password =   $user['password'];
                $this->role     =   $user['role'];
                $this->budget   =   $user['budget'];
                $this->photo    =   $user['photo'];
                
                return $this;
            } catch (PDOException $e) {
                error_log('USERMODEL::get() --> Error al obtener User by ID --> ' . $e);
                return false;
            }
        }

        public function delete(int $id): bool{
            try {
                $query = $this->prepare('DELETE FROM user WHERE id = :id');
                $query->execute(['id' => $id]);
                return true;
            } catch (PDOException $e) {
                error_log('USERMODEL::delete() --> Error al eliminar el usuario --> ' . $e);
                return false;
            }
        }

        public function update(): bool{
            try{
                $query = $this->prepare('UPDATE user SET name = :name, lastname = :lastname, email = :email, username = :username, password = :password, budget = :budget, photo = :photo WHERE id = :id');
                $query->execute([
                    'id'        => $this->id,
                    'name'      => $this->name,
                    'lastname'  => $this->lastname,
                    'email'     => $this->email,
                    'username'  => $this->username, 
                    'password'  => $this->password,
                    'budget'    => $this->budget,
                    'photo'     => $this->photo
                    ]);
                return true;
            }catch(PDOException $e){
                error_log('USERMODEL::update() --> Error al actualizar User --> ' . $e);
                return false;
            }
        }

        public function from(array $array): void{
            $this->id       = $array['id'];
            $this->name     = $array['name'];
            $this->lastname = $array['lastname'];
            $this->email    = $array['email'];
            $this->username = $array['username'];
            $this->password = $array['password'];
            $this->role     = $array['role'];
            $this->budget   = $array['budget'];
            $this->photo    = $array['photo'];
        }

        // METODO COMPLEMENTARIO

        private function getHashedPassword(string $password): string{
            return hash('sha256', $password);
        }

        // GETTERS AND SETTERS

        public function setPassword(string $password, bool $hash = true): void { 
            if ($hash) {
                $this->password = $this->getHashedPassword($password);
            } else {
                $this->password = $password;
            }
        }

        public function setId(int $id): void{                   $this->id = $id;}
        public function setName(string $name): void{            $this->name = $name;}
        public function setLastname(string $lastname): void{    $this->lastname = $lastname;}
        public function setEmail(string $email): void{          $this->email = $email;}
        public function setUsername(string $username): void{    $this->username = $username;}
        public function setRole(string $role): void{            $this->role = $role;}
        public function setBudget(float $budget): void{         $this->budget = $budget;}
        public function setPhoto(string $photo): void{          $this->photo = $photo;}

        public function getId(): int{                   return $this->id;}
        public function getName(): string{              return $this->name;}
        public function getLastname(): string{          return $this->lastname;}
        public function getEmail(): string{             return $this->email;}
        public function getUsername(): string{          return $this->username;}
        public function getPassword(): string{          return $this->password;}
        public function getRole(): string{              return $this->role;}
        public function getBudget(): float{             return $this->budget;}
        public function getPhoto(): string{             
            if ($this->photo == Null) {
                return '';
            }
            return $this->photo;}
        
    }
?>
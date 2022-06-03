<?php
    class UserModel extends Model{
        
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
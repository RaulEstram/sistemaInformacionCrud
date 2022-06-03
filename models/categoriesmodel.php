<?php
    class CategoriesModel extends Model{
        
        private $id;
        private $title;
        private $type;
        private $user_id;

        function __construct(){
            parent::__construct();   
        }

        
        // GETTERS & SETTERS
        
        public function setId(int $id): void{             $this->id = $id;}
        public function setTitle(string $title): void{    $this->title = $title;}
        public function setType(string $type): void{      $this->type = $type;}
        public function setUser_id(int $id): void{        $this->user_id = $id;}
        
        public function getId(): int{           return $this->id;}
        public function getTitle(): string{     return $this->title;}
        public function getType(): string{      return $this->type;}
        public function getUser_id(): int {     return $this->user_id;}
    }
?>
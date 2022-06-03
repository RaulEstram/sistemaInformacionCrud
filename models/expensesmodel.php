<?php
    class ExpensesModel extends Model {
        private $id;
        private $title;
        private $category_id;
        private $amount;
        private $date;
        private $user_id;

        function __construct(){
            parent::__construct();   
        }

        public function setId(int $id): void{                       $this->id = $id;}
        public function setTitle(string $title): void{              $this->title = $title;}
        public function setCategory_id(int $category_id): void{     $this->category_id = $category_id;}
        public function setAmount(float $amount): void{             $this->amount = $amount;}
        public function setDate(string $date): void{                $this->date = $date;}
        public function setUser_id(int $user_id): void{             $this->user_id = $user_id;}

        public function getId(): int{               return $this->id;}
        public function getTitle(): string{         return $this->title;}
        public function getCategory_id(): int{      return $this->category_id;}
        public function getAmount(): float{         return $this->amount;}
        public function getDate(): string {         return $this->date;}
        public function getUser_id(): int{          return $this->user_id;}

    }
?>
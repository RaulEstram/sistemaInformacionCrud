<?php
    class ExpensesModel extends Model implements IModel{
        private $id;
        private $title;
        private $category_id;
        private $amount;
        private $date;
        private $user_id;

        function __construct(){
            parent::__construct();   
        }

        // metodos de la clase

        function getAllByUserId($user_id){
            $items = [];
            try {
                $query = $this->prepare("SELECT expensesIncome.* FROM expensesIncome inner join category on category.id = expensesIncome.category_id where category.type = 'expense' and expensesIncome.user_id = :user_id order by expensesIncome.date desc");
                $query->execute(['user_id' => $user_id]);

                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $item = new ExpensesModel();
                    $item->from($row);
                    array_push($items, $item);
                }

                return $items;
            } catch (PDOException $e ) {
                error_log("EXPENSESMODEL:: getAllByUserId --> error al obtener todos los expenses por usuario --> " . $e);
                return [];
            }
        }

        // todos los expenses por usuario y limitar los resultados
        function getByUserIdAndLimit($user_id, $n){
            $items = [];
            try {
                $query = $this->prepare("SELECT expensesIncome.* FROM expensesIncome inner join category on category.id = expensesIncome.category_id where category.type = 'expense' and expensesIncome.user_id = :user_id order by expensesIncome.date desc limit :n");
                $query->execute([
                    'user_id'   => $user_id,
                    'n'         => $n
                ]);

                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $item = new ExpensesModel();
                    $item->from($row);
                    array_push($items, $item);
                }

                return $items;
            } catch (PDOException $e ) {
                error_log("EXPENSESMODEL:: getAllByUserId --> error al obtener todos los expenses por usuario --> " . $e);
                return [];
            }
        }

        // metodo que me de la suma total de los expenses que ha creado el usuario este mes
        function getTotalAmountThisMonth($user_id){
            try {
                $year = date('Y');
                $month = date('m');
                $query = $this->prepare("SELECT SUM(amount) AS total from expensesIncome inner join category on category.id = expensesIncome.category_id where category.type = 'expense' and expensesIncome.user_id = :user_id and year(expensesIncome.date) = :year and month(expensesIncome.date) = :month");
                $query->execute([
                    'year'      => $year,
                    'month'     => $month,
                    'user_id'   => $user_id
                ]);

                $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
                if ($total == NULL) {
                    $total = 0;
                }

                return $total;
            } catch (PDOException $e ) {
                error_log("EXPENSESMODEL::getTotalAmountThisMonth() --> error al obtener el total de los expenses del mes --> " . $e);
                return NULL;
            }
        }

        // obtener el expense mas grande del mes
        function getMaxExpensesThisMonth($user_id){
            try {
                $year = date('Y');
                $month = date('m');
                $query = $this->prepare("SELECT MAX(amount) AS total from expensesIncome inner join category on category.id = expensesIncome.category_id where category.type = 'expense' and expensesIncome.user_id = :user_id and year(expensesIncome.date) = :year and month(expensesIncome.date) = :month");
                $query->execute([
                    'year'      => $year,
                    'month'     => $month,
                    'user_id'   => $user_id
                ]);

                $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
                if ($total == NULL) {
                    $total = 0;
                }

                return $total;
            } catch (PDOException $e ) {
                error_log("EXPENSESMODEL::getTotalAmountThisMonth() --> error al obtener el total de los expenses del mes --> " . $e);
                return NULL;
            }
        }

        // total de expenses por categoria cantidad gastada por categoria
        function getTotalByCategoryThisMonth($category_id, $user_id){
            try {
                $total = 0;
                $year = date('Y');
                $month = date('m');
                $query = $this->prepare("SELECT SUM(amount) AS total from expensesIncome inner join category on category.id = expensesIncome.category_id where category.type = 'expense' and expensesIncome.user_id = :user_id and year(expensesIncome.date) = :year and month(expensesIncome.date) = :month and expensesIncome.category_id = :category_id");
                $query->execute([
                    'year'          => $year,
                    'month'         => $month,
                    'user_id'       => $user_id,
                    'category_id'   => $category_id
                ]);

                $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
                if ($total == NULL) {
                    $total = 0;
                }

                return $total;
            } catch (PDOException $e ) {
                error_log("EXPENSESMODEL::getTotalAmountThisMonth() --> error al obtener el total de los expenses del mes --> " . $e);
                return NULL;
            }
        }

        // obtener el total de expenses por categoria cantidad de registros por cada categoria
        function getNumberOfExpensesByCategoryThisMonth($category_id, $user_id){
            try {
                $total = 0;
                $year = date('Y');
                $month = date('m');
                $query = $this->prepare("SELECT COUNT(amount) AS total from expensesIncome inner join category on category.id = expensesIncome.category_id where category.type = 'expense' and expensesIncome.user_id = :user_id and year(expensesIncome.date) = :year and month(expensesIncome.date) = :month and expensesIncome.category_id = :category_id");
                $query->execute([
                    'year'          => $year,
                    'month'         => $month,
                    'user_id'       => $user_id,
                    'category_id'   => $category_id
                ]);

                $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
                if ($total == NULL) {
                    $total = 0;
                }

                return $total;
            } catch (PDOException $e ) {
                error_log("EXPENSESMODEL::getTotalAmountThisMonth() --> error al obtener el total de los expenses del mes --> " . $e);
                return NULL;
            }
        }

        // Metodos interfaz

        public function save(){
            try {
                $query = $this->prepare('INSERT INTO expensesIncome (title, category_id, amount, date, user_id) VALUES (:title, :category_id, :amount, :date ,:user_id)');
                $query->execute([
                    'title'         => $this->title,
                    'category_id'   => $this->category_id,
                    'amount'        => $this->amount,
                    'date'          => $this->date,
                    'user_id'       => $this->user_id,
                ]);
                if ($query->rowCount()) {
                    return true;
                }
                return false;
            } catch (PDOException $e) {
                error_log('EXPENSESMODEL::save() --> error al guardar el expense --> ' . $e);
                return false;
            }

        }

        public function getAll(){
            $items = [];
            try {
                $query = $this->query("SELECT expensesIncome.* FROM expensesIncome inner join category on category.id = expensesIncome.category_id where category.type = 'expense' order by expensesIncome.date desc");
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $item = new ExpensesModel();
                    $item->from($row);
                    array_push($items, $item);
                }
                return $item;
            } catch (PDOException $e ) {  
                error_log('EXPENSESMODEL::getAll() --> error al obtner los expenses --> ' . $e);
                return []; 
            }
        }

        public function get(int $id){
            try {
                $query = $this->prepare("SELECT expensesIncome.* FROM expensesIncome inner join category on category.id = expensesIncome.category_id where category.type = 'expense' and expensesIncome.id = :id order by expensesIncome.date desc");
                $query->execute(['id' => $id]);
                $expense_data = $query->fetch(PDO::FETCH_ASSOC);
                $this->from($expense_data);
                return $this;
            } catch (PDOException $e ) {
                error_log("EXPENSESMODEL::get() --> error al obtener registro por id --> " . $e);
            }
        }

        public function delete(int $id){
            try {
                $query = $this->prepare("DELETE FROM expensesIncome WHERE (`id` = :id)");
                $query->execute(['id' => $id]);
                return true;
            } catch (PDOException $e ) {
                error_log("EXPENSESMODEL::delete() --> error al eliminar expense --> " . $e);
                return false;
            }
        }

        public function update(){
            try {
                $query = $this->prepare("UPDATE expensesIncome SET `title` = :title, `category_id` = :category_id, `amount` = :amount, `date` = :date, `user_id` = :user_id WHERE (`id` = :id)");
                $query->execute([
                    'title'         =>  $this->title,
                    'category_id'   =>  $this->category_id,
                    'amount'        =>  $this->amount,
                    'date'          =>  $this->date,
                    'user_id'       =>  $this->user_id,
                    'id'            =>  $this->id
                ]);
                return true;
            } catch (PDOException $e ) {
                error_log("EXPENSESMODEL::update() --> Error al actualizar un expense --> " . $e);
                return false;
            }
        }

        public function from(array $array){
            $this->id           = $array['id'];
            $this->title        = $array['title'];
            $this->amount       = $array['amount'];
            $this->category_id   = $array['category_id'];
            $this->date         = $array['date'];
            $this->user_id       = $array['user_id'];
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
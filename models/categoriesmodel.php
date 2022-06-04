<?php
    class CategoriesModel extends Model implements IModel{
        
        private $id;
        private $title;
        private $type;
        private $user_id;

        function __construct(){
            parent::__construct();   
        }

        // METODOS


        // [[expense_type, sum, count], ...]
        PUBLIC function getResumeExpensesByUserAndMonth($id){
            $expenses_list = [];
            try {
                $year = date('Y');
                $month = date('m');
                $query = $this->prepare("
                select c.id, c.title as 'type', count(c.title) as 'cantidad', sum(ei.amount) as 'total', max(ei.amount) as 'maximo' 
                from expensesIncome ei inner join category c on c.id = ei.category_id 
                where ei.user_id = :user_id and c.type = 'expense' and year(ei.date) = :year and month(ei.date) = :month 
                group by c.id");
                $query->execute([
                    'user_id'   => $id,
                    'year'      => $year,
                    'month'     => $month
                ]);
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    array_push($expenses_list, $row);
                }
                return $expenses_list;
            } catch (PDOException $e ) {
                error_log("CATEGORIESMODEL::getResumeExpenses() --> error --> " . $e);
                return $expenses_list;
            }
        }

        public function getResumeIncomesByUserAndMonth($id){
            $expenses_list = [];
            try {
                $year = date('Y');
                $month = date('m');
                $query = $this->prepare("
                select c.id, c.title as 'type', count(c.title) as 'cantidad', sum(ei.amount) as 'total', max(ei.amount) as 'maximo' 
                from expensesIncome ei inner join category c on c.id = ei.category_id 
                where ei.user_id = :user_id and c.type = 'income' and year(ei.date) = :year and month(ei.date) = :month 
                group by c.id");
                $query->execute([
                    'user_id'   => $id,
                    'year'      => $year,
                    'month'     => $month
                ]);
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    array_push($expenses_list, $row);
                }
                return $expenses_list;
            } catch (PDOException $e ) {
                error_log("CATEGORIESMODEL::getResumeExpenses() --> error --> " . $e);
                return $expenses_list;
            }
        }

        public function getAllIncomeCategoriesByUser($user_id){
            $items = [];
            try {
                $query = $this->prepare("SELECT * FROM category where type = 'income' and (user_id = 1 or user_id = :id)");
                $query->execute(['id' => $user_id]);
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $item = new CategoriesModel();
                    $item->from($row);
                    array_push($items, $item);
                }
                return $items;
            } catch (PDOException $e) {
                error_log("CATEGORIESMODEL:: getAll() --> error al obtener todas las categorias --> obtener los categories" . $e);
                return [];
            }
        }

        public function getAllExpenseCategoriesByUser($user_id){
            $items = [];
            try {
                $query = $this->prepare("SELECT * FROM category where type = 'expense' and (user_id = 1 or user_id = :id)");
                $query->execute(['id' => $user_id]);
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $item = new CategoriesModel();
                    $item->from($row);
                    array_push($items, $item);
                }
                return $items;
            } catch (PDOException $e) {
                error_log("CATEGORIESMODEL:: getAll() --> error al obtener todas las categorias --> obtener los categories" . $e);
                return [];
            }
        }

        public function exists($title, $user_id){
            try {
                $query = $this->prepare("SELECT * FROM category where title = :title and user_id = :user_id");
                $query->execute([
                    'title' => $title,
                    'user_id' => $user_id
                ]);
                if ($query->rowCount()) {
                    return true;
                }
                return false;
            } catch (PDOException $e) {
                error_log("CATEGORIESMODEL:: get() --> error al obtener la categoria por id --> " . $e);
                return false;
            }
        }

        // METODOS POR INTERFAZ

        public function save(){
            try {
                $query = $this->prepare("INSERT INTO category (title, type, user_id) VALUES (:title,:type, :user_id)");
                $query->execute([
                    'title' => $this->title,
                    'type' => $this->type,
                    'user_id' => $this->user_id,
                ]);
                
                if ($query->rowCount()) {
                    return true;
                }

                return false;
            } catch (PDOException $e) {
                error_log("CATEGORIESMODEL::save()  --> error al guardar la categoria --> " . $e);
                return false;
            }
        }

        public function getAll(){
            $items = [];
            try {
                $query = $this->query("SELECT * FROM category");
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $item = new CategoriesModel();
                    $item->from($row);
                    array_push($items, $item);
                }
                return $item;
            } catch (PDOException $e) {
                error_log("CATEGORIESMODEL:: getAll() --> error al obtener todas las categorias --> obtener los categories" . $e);
                return [];
            }
        }

        public function getAllByUser($id){
            $items = [];
            try {
                $query = $this->prepare("SELECT * FROM category where user_id = :id");
                $query->execute(['id' => $id]);
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $item = new CategoriesModel();
                    $item->from($row);
                    array_push($items, $item);
                }
                return $items;
            } catch (PDOException $e) {
                error_log("CATEGORIESMODEL:: getAll() --> error al obtener todas las categorias --> obtener los categories" . $e);
                return [];
            }
        }

        public function get(int $id){
            try {
                $query = $this->prepare("SELECT * FROM category where id = :id");
                $query->execute(['id' => $id]);
                $category_data = $query->fetch(PDO::FETCH_ASSOC);
                $this->from($category_data);
                return $this;
            } catch (PDOException $e) {
                error_log("CATEGORIESMODEL:: get() --> error al obtener la categoria por id --> " . $e);
                return NULL;
            }
        }

        public function delete(int $id){
            try {
                $query = $this->prepare("DELETE FROM category WHERE (`id` = :id)");
                $query->execute(['id' => $id]);
                return true;
            } catch (PDOException $e) {
                error_log("CATEGORIESMODEL:: delete() --> error al eliminar categoria --> " . $e);
                return false;
            }
        }

        public function update(){
            try {
                $query = $this->prepare("UPDATE category SET `title` = :title, `type` = :type, `user_id` = :user_id WHERE (`id` = :id)");
                $query->execute([
                    'title' =>  $this->title,
                    'type'  =>  $this->type,
                    'id'    =>  $this->id,
                    'user_id' => $this->user_id
                ]);
                return true;
            } catch (PDOException $e) {
                error_log("CATEGORIESMODEL:: update() --> error al actualizar la categoria--> " . $e);
            }
        }

        public function from(array $array){
            try {
                $this->id       = $array['id'];
                $this->title    = $array['title'];
                $this->type     = $array['type'];
                $this->user_id  = $array['user_id'];
            } catch (PDOException $e) {
                error_log("CATEGORIESMODEL:: from --> error al asignarle las propiedades --> " . $e);
            }
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
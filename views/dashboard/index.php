<?php
$user = $this->d['user'];

$listExpenses = $this->d['expenses'];
$maxExpenses = $this->d['maxExpense'];
$totalExpenses = $this->d['totalExpenses'];
$expensesCategories = $this->d['expensesCategories'];

$listIncomes = $this->d['incomes'];
$maxIncomes = $this->d['maxIncomes'];
$totalIncomes = $this->d['totalIncomes'];
$incomesCategories = $this->d['incomesCategories'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css" integrity="sha384-/frq1SRXYH/bSyou/HUp/hib7RVN1TawQYja658FEOodR/FQBKVqT9Ol+Oz3Olq5" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="./publico/assets/css/normalize.css">
    <link rel="stylesheet" href="./publico/assets/css/style.css">
    <title>Dashboard</title>
</head>

<body>
    <!-- HEADER -->
    <?php
    require_once './views/header/headerlogin.php';
    ?>

    <!-- BODY -->
    <h1 class="titulo centrar-texto">Dashboard</h1>
    <h2 class="subtitulo centrar-texto"> <?php echo $user->getUsername() ?></h2>
    <br>
    <main>
        <div class="transparente dash-content centrar-bloque">
            <div class="dash-titulo-expenses">
                <h3 class="subsubtitulo centrar-texto">Gastos</h3>
            </div>
            <div class="dash-total-expenses">
                <p class=" texto centrar-texto">Total Gastado de este Mes: $<?php echo $totalExpenses  ?></p>
            </div>
            <div class="dash-mas-expenses">
                <p class="texto centrar-texto">Maximo gasto del Mes: $<?php echo $maxExpenses  ?></p>
            </div>
            <div class="dash-list-expenses">
                <h3 class="subsubtitulo centrar-texto">Ultimos Gastos</h3>
                <div class="table-responsive">
                    <table class="table table-dark table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Nota</th>
                                <th scope="col">Total</th>
                                <th scope="col">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($listExpenses as $expense) {
                                echo '<tr class = "table-light">';
                                echo '<td class="texto-tabla" >' . $expense->getTitle() . '</td>';
                                echo '<td class="texto-tabla" >$' . number_format(floatval($expense->getAmount()),2) . '</td>';
                                echo '<td class="texto-tabla" >' . date('d-m-Y', strtotime($expense->getDate())) . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="dash-expenses-categories">
                <h3 class="centrar-texto subsubtitulo">Categorias de Gastos</h3>
                <div class="table-responsive">
                    <table class="table table-dark table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Categoria</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($expensesCategories as $category) {
                                echo '<tr class = "table-light">';
                                echo '<td class="texto-tabla">' . $category['type'] . '</td>';
                                echo '<td class="texto-tabla">' . $category['cantidad'] . '</td>';
                                echo '<td class="texto-tabla">$' . number_format(floatval($category['total']), 2) . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="dash-titulo-incomes">
                <h3 class="subsubtitulo centrar-texto">Ingresos</h3>
            </div>
            <div class="dash-total-incomes">
                <p class=" texto centrar-texto">Total Ingresos de este Mes: $<?php echo $totalIncomes  ?></p>
            </div>
            <div class="dash-max-incomes">
                <p class="texto centrar-texto">Maximo Ingreso del Mes: $<?php echo $maxIncomes  ?></p>
            </div>
            <div class="dash-list-incomes">
                <h3 class="subsubtitulo centrar-texto">Ultimos Ingresos</h3>
                <div class="table-responsive">
                    <table class="table table-dark table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Nota</th>
                                <th scope="col">Total</th>
                                <th scope="col">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($listIncomes as $income) {
                                echo '<tr class = "table-light">';
                                echo '<td class="texto-tabla" >' . $income->getTitle() . '</td>';
                                echo '<td class="texto-tabla" >$' . number_format(floatval($income->getAmount()),2) . '</td>';
                                echo '<td class="texto-tabla" >' . date('d-m-Y', strtotime($income->getDate())) . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class=" dash-incomes-categories">
                <h3 class="centrar-texto subsubtitulo">Categorias de Ingresos</h3>
                <div class="table-responsive">
                    <table class="table table-dark table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Categoria</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($incomesCategories as $category) {
                                echo '<tr class = "table-light">';
                                echo '<td class="texto-tabla">' . $category['type'] . '</td>';
                                echo '<td class="texto-tabla">' . $category['cantidad'] . '</td>';
                                echo '<td class="texto-tabla"> $' . number_format(floatval($category['total']), 2) . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>

</html>
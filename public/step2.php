<?php

use YaFou\TaxCalculator\TaxCalculator;

require dirname(__DIR__) . '/vendor/autoload.php';

if (isset($_POST['salary'])) {
    $salary = $_POST['salary'];
    $couple = isset($_POST['couple']);
    $children = $_POST['children'];

    $calculator = new TaxCalculator();
    $result = $calculator->calculateTax((int) $salary, $couple, (int) $children);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculateur d'impôts</title>
</head>
<body>
    <h1>ETAPE 2</h1>

    <form action="" method="post">
        <div>
            <label for="salary">Salaire annuel : </label>
            <input type="number" name="salary" id="salary" value="55950"> €
        </div>

        <div>
            <input type="checkbox" name="couple" id="couple">
            <label for="couple">Couple marié ou pacsé</label>
        </div>
        
        <div>
            <label for="children">Nombre d'enfants</label>
            <input type="number" name="children" id="children" value="0">
        </div>

        <button type="submit">Calculer</button>
    </form>

    <?php if (isset($result)): ?>
        <div>
            <p>Vous avez gagné <?= $result->getSalary() ?> €.</p>
            <p>Vous devrez payer <?= $result->getTax() ?> € d'impôts.</p>
            <p>Il vous restera <?= $result->getBalance() ?> €.</p>
        </div>
    <?php endif; ?>
</body>
</html>

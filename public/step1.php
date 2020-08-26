<?php

use YaFou\TaxCalculator\TaxCalculator;

require dirname(__DIR__) . '/vendor/autoload.php';

if (isset($_POST['salary'])) {
    $salary = $_POST['salary'];

    $calculator = new TaxCalculator();
    $result = $calculator->calculateTax((int) $salary);
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
    <h1>ETAPE 1</h1>

    <form action="" method="post">
        <div>
            <label for="salary">Salaire annuel : </label>
            <input type="number" name="salary" id="salary" value="32000"> €
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

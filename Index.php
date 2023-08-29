<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatable" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/main.css">


    <title>Document</title>
</head>

<body>

<div class='container'>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <input class='form-control' type="number" name="num01" placeholder="First Number" value='<?= $_POST['num01']?>'>
        <select class="form-select form-select-lg mb-3" name="operator">
            <option <?php echo ($_POST['operator'] == 'addition') ? 'selected' : null; ?> value="addition">+</option>
            <option <?php echo ($_POST['operator'] == 'subtract') ? 'selected' : null; ?> value="subtract">-</option>
            <option <?php echo ($_POST['operator'] == 'multiply') ? 'selected' : null; ?> value="multiply">*</option>
            <option <?php echo ($_POST['operator'] == 'division') ? 'selected' : null; ?> value="division">/</option>
        </select>
        <input class='form-control' type="number" name="num02" placeholder="Second Number" value='<?= $_POST['num02']?>'>
        <button class='btn btn-primary'>Calculate</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Grab data from inputs
        $num01 = filter_input(INPUT_POST, "num01", FILTER_SANITIZE_NUMBER_FLOAT);
        $num02 = filter_input(INPUT_POST, "num02", FILTER_SANITIZE_NUMBER_FLOAT);
        $operator = htmlspecialchars($_POST["operator"]);

        // Error Handlers
        $errors = false;

        if (empty($num01) || empty($num02) || empty($operator)) {
            echo "<p class='calc-error'>Fill in all empty fields!</p>";
            $errors = true;
        }

        if (!is_numeric($num01) || !is_numeric($num02)) {
            echo "<p class='calc-error'>Only type numbers!</p>";
            $errors = true;
        }

        // Calculate the numbers if no errors
        if (!$errors) {
            $value = 0;

            switch ($operator) {
                case "addition":
                    $value = $num01 + $num02;
                    break;
                case "subtract":
                    $value = $num01 - $num02;
                    break;
                case "multiply":
                    $value = $num01 * $num02;
                    break;
                case "division":
                    $value = $num01 / $num02;
                    break;
                default:
                    echo "<p class='calc-error'>Something went wrong!</p>";
            }

            echo "<p class='calc-result'>Result = " . $value . "</p>";
        }
    }
    ?>

</div>
</body>

</html>

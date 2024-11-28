<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lb 4</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Лабораторна робота №4</h1>
    <h3>Калькулятор</h3>
    <form method="post">
        <input type="number" name="num1" value="0" required>
        <div class="op">
        <label><input type="radio" name="operation" value="+" required>+</label>
        <label><input type="radio" name="operation" value="-" required>-</label>
        <label><input type="radio" name="operation" value="/" required>/</label>
        <label><input type="radio" name="operation" value="*" required>*</label>
        </div>
        <input type="number" name="num2" value="0" required>
        <button type="submit">Обчислити</button>
    </form>

    <?php
    $file = "log.txt";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num1 = (float)$_POST['num1'];
        $num2 = (float)$_POST['num2'];
        $operation = $_POST['operation'];

        $res = null;

        switch ($operation) {
            case '+':
                $res = $num1 + $num2;
                break;
            case '-':
                $res = $num1 - $num2;
                break;
            case '/':
                if ($num2 != 0) {
                    $res = $num1 / $num2;
                } else {
                    $res = "Помилка: Ділення на нуль";
                }
                break;
            case '*':
                $res = $num1 * $num2;
                break;
        }

        $log = "$num1 $operation $num2 = $res" . PHP_EOL;

        file_put_contents($file, $log, FILE_APPEND);

        echo "<h3>Результат: $res</h3>";
    }

    if (file_exists($file)) {
        echo "<h3>Історія операцій:</h3>";
        echo "<pre>" . htmlspecialchars(file_get_contents($file)) . "</pre>";
    }
    ?>
</body>
</html>

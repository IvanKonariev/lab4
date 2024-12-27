<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Калькулятор</title>
</head>
<body>
    <h1>Простий калькулятор</h1>
    <form method="post" action="">
        <input type="number" name="num1" placeholder="Перше число" required>
        <select name="operation">
            <option value="add">+</option>
            <option value="subtract">-</option>
            <option value="multiply">*</option>
            <option value="divide">/</option>
        </select>
        <input type="number" name="num2" placeholder="Друге число" required>
        <button type="submit" name="calculate">Обчислити</button>
    </form>

    <h2>Результат:</h2>
    <?php
    if (isset($_POST['calculate'])) {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $operation = $_POST['operation'];
        $result = '';

        switch ($operation) {
            case 'add':
                $result = $num1 + $num2;
                $symbol = '+';
                break;
            case 'subtract':
                $result = $num1 - $num2;
                $symbol = '-';
                break;
            case 'multiply':
                $result = $num1 * $num2;
                $symbol = '*';
                break;
            case 'divide':
                if ($num2 != 0) {
                    $result = $num1 / $num2;
                    $symbol = '/';
                } else {
                    $result = 'Ділення на нуль неможливе';
                }
                break;
        }

        echo "<p>Результат: $result</p>";

        // Зберігаємо результат у файл history.txt
        if ($result !== 'Ділення на нуль неможливе') {
            $history = "$num1 $symbol $num2 = $result" . PHP_EOL;
            file_put_contents("history.txt", $history, FILE_APPEND);
        }
    }
    ?>

    <h2>Історія обчислень:</h2>
    <ul>
        <?php
        if (file_exists("history.txt")) {
            $lines = file("history.txt");
            foreach ($lines as $line) {
                echo "<li>" . htmlspecialchars($line) . "</li>";
            }
        } else {
            echo "<li>Історія порожня</li>";
        }
        ?>
    </ul>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сёстры и братья Алисы</title>
    <link rel="stylesheet" href="./style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container-sm">
    <h1>Узнайте количество сестёр у произвольного брата Алисы</h1>
    <form method="post" action="">
        <label for="sisters">Количество сестёр (без Алисы):</label>
        <input type="number" id="sisters" name="sisters" required>
        <br><br>
        <label for="brothers">Количество братьев:</label>
        <input type="number" id="brothers" name="brothers" required>
        <br><br>
        <input type="submit" value="Рассчитать">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Получаем значения из формы
        $sisters = intval($_POST['sisters']);
        $brothers = intval($_POST['brothers']);

        // Функция для вычисления количества сестёр у произвольного брата
        function getSistersForBrother($n, $m) {
            // Возвращаем n + 1, так как Алиса также считается сестрой
            return $n + 1;
        }

        // Вызываем функцию и отображаем результат
        $result = getSistersForBrother($sisters, $brothers);

        echo "<h2>Количество сестёр у произвольного брата Алисы: $result</h2>";
    }
    ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

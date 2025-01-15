<?php

include 'db_connect.php';

// Обработка отправки формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content = trim($_POST['content']);
    if (!empty($content)) {
        // Подготовленный запрос для защиты от SQL-инъекций
        $stmt = $conn->prepare("INSERT INTO comments (content) VALUES (?)");
        $stmt->bind_param("s", $content);
        $stmt->execute();
        $stmt->close();
    }
    // Перезагрузка страницы
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Получение комментариев
$result = $conn->query("SELECT * FROM comments ORDER BY id DESC");
$comments = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Комментарии</title>
    <link rel="stylesheet" href="./style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container-sm">
    <h1>Комментарии</h1>
    <form action="" method="post">
        <textarea name="content" placeholder="Добавьте ваш комментарий..."></textarea><br>
        <input type="submit" value="Добавить">
    </form>
    <ul>
        <?php foreach ($comments as $comment): ?>
            <li><?php echo htmlspecialchars($comment['content'], ENT_QUOTES, 'UTF-8'); ?></li>
        <?php endforeach; ?>
    </ul>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

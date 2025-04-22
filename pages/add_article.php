<?php
include '../includes/db.php';
// Обработка отправки формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = pg_escape_string($_POST['title']);
    $content = pg_escape_string($_POST['content']);
   
    $result = pg_query_params(
        $db_conn,
        "INSERT INTO articles (title, content) VALUES ($1, $2)",
        [$title, $content]
    );
   
    if ($result) {
        header("Location: /articles.php");
        exit;
    } else {
        echo "Ошибка: " . pg_last_error($db_conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Добавить статью</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Добавить новую статью</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="title">Заголовок:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="content">Содержание:</label>
                <textarea id="content" name="content" rows="10" required></textarea>
            </div>
            <button type="submit" class="btn">Сохранить статью</button>
        </form>
        <a href="/articles.php" class="btn">Назад к статьям</a>
    </div>
</body>
</html>

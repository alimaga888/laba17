<?php
include 'includes/db.php';
$result = pg_query($db_conn, "SELECT * FROM articles ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Статьи</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Статьи</h1>
        <a href="/pages/add_article.php" class="btn">Добавить статью</a>
        
        <div class="articles-container">
            <?php if (pg_num_rows($result) > 0): ?>
                <?php while ($row = pg_fetch_assoc($result)): ?>
                    <div class="article">
                        <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                        <p><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
                        <small>Дата публикации: <?php echo date('d.m.Y H:i', strtotime($row['created_at'])); ?></small>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Статей пока нет.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

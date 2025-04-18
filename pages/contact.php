<?php
include '../includes/header.php';

// Обработка формы
$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));

    if (empty($name)) {
        $errors[] = "Введите имя.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Введите корректный email.";
    }
    if (empty($message)) {
        $errors[] = "Введите сообщение.";
    }

    if (empty($errors)) {
        // Отправка письма (можно заменить на сохранение в БД)
        $to = "your@email.com";
        $subject = "Новое сообщение с сайта";
        $body = "Имя: $name\nEmail: $email\nСообщение:\n$message";
        $headers = "From: $email";

        mail($to, $subject, $body, $headers);
        $success = "Сообщение успешно отправлено!";
    }
}
?>

<main>
    <h1>Контакты</h1>

    <!-- Вывод сообщений об ошибке или успехе -->
    <?php if (!empty($errors)): ?>
        <ul class="form-errors">
            <?php foreach ($errors as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php elseif (!empty($success)): ?>
        <p class="form-success"><?= $success ?></p>
    <?php endif; ?>

    <!-- Форма -->
    <form method="post">
        <input type="text" name="name" placeholder="Имя" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
        <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        <textarea name="message" placeholder="Сообщение"><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
        <button type="submit">Отправить</button>
    </form>
</main>

<?php include '../includes/footer.php'; ?>

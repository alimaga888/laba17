<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!function_exists('pg_connect')) {
    die("Функция pg_connect не существует. Модуль PostgreSQL для PHP не установлен или не активирован.");
}

$conn = pg_connect("host=localhost dbname=demon.ru user=postgres password=password");
if (!$conn) {
    die("Ошибка подключения: " . pg_last_error());
}
echo "Подключение к PostgreSQL успешно!";
pg_close($conn);
?>

<?php

const PASS = "uUYNawBjI7bSzQFcQpromkiUE";

if (!isset($_COOKIE['pass'])) {
    header("Location: login.php");
    exit(0);
}

if ($_COOKIE['pass'] != PASS) {
    setcookie('pass', '', time() - 1, '/');
    header("Location: login.php");
    exit(0);
}

?>

<form enctype="multipart/form-data" action="upgrade.php" method="POST">
    <h3>Обновить базу данных:</h3>
    <input type="file" name="filename">
    <input type="submit" value="Отправить"><br>
    <p>
        ВНИМАНИЕ: После нажатия кнопки, возможна долгая загрузка страницы, не прерывайте загрузку.
    </p>
</form>
<hr>
<a href="goods-list.php">Список товаров</a>
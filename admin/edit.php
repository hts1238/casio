<?php

/*====== PASSWORD CHECK ======*/

const PASS = "uUYNawBjI7bSzQFcQpromkiUE";

if (!isset($_COOKIE['pass'])) {
    header("Location: login.php");
    exit(0);
}

if ($_COOKIE['pass'] != PASS) {
    setcookie('pass', '', time() - 1);
    header("Location: login.php");
    exit(0);
}

/*====== END OF PASSWORD CHECK ======*/

$name = $_GET['n'];
include_once("../functions/connect.php");
$db = connect();

if(!isset($_GET["collection"]) || !isset($_GET["price"])) {
    $sql = "SELECT `collection`, `price` FROM `casio-goods` WHERE `name`='$name'";
    $sql_result = mysqli_query($db, $sql);
    $sql_result = mysqli_fetch_assoc($sql_result);

    $collection = $sql_result['collection'];
    $price = $sql_result['price'];

    echo "
        <a href='goods-list.php?s=$collection'>Вернуться</a><hr>
        <form action='edit.php' method='GET'>
            <h1>$name</h1>
            <input type='hidden' name='n' value='$name'>
            <input type='text' name='collection' value='$collection'>
            <input type='number' name='price' value='$price'>
            <input type='submit' value='Сохранить'>
        </form>
    ";
}
else {
    $collection = $_GET['collection'];
    $price = $_GET['price'];

    $sql = "UPDATE `casio-goods` SET `collection`='$collection', `price`='$price' WHERE `name`='$name'";
    $sql_result = mysqli_query($db, $sql);

    header("Location: edit.php?n=$name");
}
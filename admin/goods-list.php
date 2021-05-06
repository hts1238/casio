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

if(!isset($_GET["s"])) {
    echo "
    <a href='./'>Вернуться</a><hr>
    <ul>
        <li><a href='./goods-list.php?s=g-shock'>G-SHOCK</a></li>
        <li><a href='./goods-list.php?s=g-shock-premium'>G-SHOCK PREMIUM</a></li>
        <li><a href='./goods-list.php?s=baby-g'>Baby-G</a></li>
        <li><a href='./goods-list.php?s=casio-sport'>Casio Sport</a></li>
        <li><a href='./goods-list.php?s=edifice'>EDIFICE</a></li>
        <li><a href='./goods-list.php?s=sheen'>SHEEN</a></li>
        <li><a href='./goods-list.php?s=wave-ceptor'>WAVE CEPTOR</a></li>
        <li><a href='./goods-list.php?s=casio-collection'>Casio Collection</a></li>
        <li><a href='./goods-list.php?s=clocks'>Clocks</a></li>
    </ul>";
    exit(0);
}

$collection = $_GET["s"];

include_once("../functions/connect.php");
$db = connect();

$sql = "SELECT `name`, `price` FROM `casio-goods` WHERE `collection`='$collection'";
$sql_result = mysqli_query($db, $sql);
$sql_result = mysqli_fetch_all($sql_result);

echo "<a href='goods-list.php'>Вернуться</a><hr>";
foreach ($sql_result as $item) {
    $name = $item[0];
    $price = $item[1];

    echo "
        <div style='display:flex;align-items:center;'>
            <h1>$name</h1>
            <h2>: $price руб. |</h2>
            <a href='edit.php?n=$name'>Править</a>
        </div>
    ";
}


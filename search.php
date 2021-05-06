<?php

if (!isset($_GET["s"])) {
    echo "
        <form action='search.php' method='get'>
            <input type='text' name='s' placeholder='Search'>
            <input type='text' name='c' placeholder='Collection'>
            <input type='submit'>
        </form>
    ";
}

$request = $_GET["s"];
$collection = isset($_GET["c"]) ? $_GET["c"] : 0;

$request = str_replace(' ', '-', preg_replace("/(^ *)|( *$)/", "", strtoupper($request)));
echo "debug: $request<br>";

include_once("functions/connect.php");
$db = connect();

$sql == "";
if (!$collection) {
    $sql = "SELECT `name`, `price`, `collection` FROM `casio-goods`";
}
else {
    $sql = "SELECT `name`, `price` FROM `casio-goods` WHERE `collection`='$collection'";
}
$sql_result = mysqli_query($db, $sql);
$sql_result = mysqli_fetch_all($sql_result);

echo "<div style='display:flex;flex-wrap: wrap;'>";
foreach ($sql_result as $item) {
    $name = $item[0];
    $price = $item[1];
    if (strpos($name, $request) !== false) {
        echo "
            <div style='padding:20px;display:flex;flex-direction:column;align-items:center;'>
            <h1 style='margin:5px;'>$name</h1>";
        if (!$collection) {
            echo "<h3 style='margin:5px;'>", $item[2], "</h3>";
        }
        echo "
            <a href='collections/view.php?n=$name' target='_blank'><img src='functions/getimg.php?name=$name' loading='lazy'></a>
            <h2>$price руб.</h2>
            </div>";
    }
}
echo "</div>";
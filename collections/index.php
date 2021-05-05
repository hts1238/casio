<?php

if (!isset($_GET['s'])) {
    include_once("templates/index.html");
}
else {
    $collection = $_GET['s'];
    echo "Collection is <b>$collection</b>.<br><a href='.'>Go back</a><hr>";

    include_once("../functions/connect.php");
    $db = connect();

    $sql = "SELECT `name`, `price` FROM `casio-goods` WHERE `collection`='$collection'";
    $sql_result = mysqli_query($db, $sql);
    $sql_result = mysqli_fetch_all($sql_result);

    //echo print_r($sql_result), "<hr>";

    echo "<div style='display:flex;flex-wrap: wrap;'>";
    for ($i = 0; $i < count($sql_result); $i++) {
        $name = $sql_result[$i][0];
        $price = $sql_result[$i][1];
        include("templates/collection.html");
    }
    echo "</div>";
}
<?php

include_once("templates/header.html");

if (!isset($_GET['s'])) {
    include_once("templates/index.html");
}
else {
    $collection = $_GET['s'];
    $sort = isset($_GET['sort']) ? $_GET['sort'] : false;
    echo "Collection is <b>$collection</b>.<br><a href='.'>Go back</a><hr>";

    include_once("../functions/connect.php");
    $db = connect();

    $sql = "SELECT `name`, `price` FROM `casio-goods` WHERE `collection`='$collection'";
    $sql_result = mysqli_query($db, $sql);
    $sql_result = mysqli_fetch_all($sql_result);

    //echo print_r($sql_result), "<hr>";
    echo "Сортировка: 
        <a href='./?s=$collection&sort=ap'>По возрастанию цены</a>
        <a href='./?s=$collection&sort=dp'>По убыванию цены</a>
        <a href='./?s=$collection&sort=al'>По алфавиту</a>
        <a href='./?s=$collection'>Сначала новые</a>
        ";
    echo "<div style='display:flex;flex-wrap: wrap;'>";
    if (!$sort) {
        $sql_result = array_reverse($sql_result);
        for ($i = 0; $i < count($sql_result); $i++) {
            $name = $sql_result[$i][0];
            $price = $sql_result[$i][1];
            include("templates/collection.html");
        }
    }
    else {
        foreach ($sql_result as $item) {
            $arr[$item[0]] = $item[1];
        }
        if ($sort == 'ap') {
            asort($arr);
            foreach ($arr as $name => $price) {
                include("templates/collection.html");
            }
        }
        if ($sort == 'dp') {
            arsort($arr);
            foreach ($arr as $name => $price) {
                include("templates/collection.html");
            }
        }
        if ($sort == 'al') {
            ksort($arr);
            foreach ($arr as $name => $price) {
                include("templates/collection.html");
            }
        }
    }
    echo "</div>";
}

include_once("templates/footer.html");
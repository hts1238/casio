<?php

include_once("templates/header.html");

if (!isset($_GET['s'])) {
    include_once("templates/index.html");
}
else {
    $collection = $_GET['s'];
    $sort = isset($_GET['sort']) ? $_GET['sort'] : false;
    echo "<link rel='stylesheet' href='styles/collection.css'>";

    include_once("../functions/connect.php");
    $db = connect();

    $sql = "SELECT `name`, `price` FROM `casio-goods` WHERE `collection`='$collection'";
    $sql_result = mysqli_query($db, $sql);
    $sql_result = mysqli_fetch_all($sql_result);

    echo "
        <form action='../search.php' method='get'>
            <input type='text' name='s' placeholder='Search'>
            <input type='submit'>
        </form>";

    if ($collection == 'clocks') {
        echo "<h1>Будильники и настольные часы</h1>";
    }
    else {
        include_once("../functions/getname.php");
        $collectionName = getCollectionName($collection);
        echo "<h1>Часы серии <b>$collectionName</b></h1>";
    }
        
    echo "Сортировка: 
        <a href='./?s=$collection&sort=ap'>По возрастанию цены</a>
        <a href='./?s=$collection&sort=dp'>По убыванию цены</a>
        <a href='./?s=$collection&sort=al'>По алфавиту</a>
        <a href='./?s=$collection'>Сначала новые</a>
        ";

    echo "<div class='collection-cont'>";
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
        }
        if ($sort == 'dp') {
            arsort($arr);
        }
        if ($sort == 'al') {
            ksort($arr);
        }
        foreach ($arr as $name => $price) {
            include("templates/collection.html");
        }
    }
    echo "</div>";
}

include_once("templates/footer.html");
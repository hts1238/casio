<?php

if (!isset($_GET["s"])) {
    echo "
        <form action='search.php' method='get'>
            <input type='text' name='s' placeholder='Search'>
            <input type='submit'>
        </form>
    ";
}

$request = $_GET["s"];

include_once("functions/search.php");
$result = search($request);


echo "<div style='display:flex;flex-wrap: wrap;'>";
    foreach ($result as $item) {
        $name = $item[0];
        $price = $item[1];
        $collection = $item[2];
        echo "
            <div style='padding:20px;display:flex;flex-direction:column;align-items:center;'>
                <h1 style='margin:5px;'>$name</h1>
                <h3 style='margin:5px;'>$collection</h3>
                <a href='collections/view.php?n=$name' target='_blank'><img src='functions/getimg.php?name=$name' loading='lazy'></a>
                <h2>$price руб.</h2>
            </div>";
    }
echo "</div>";
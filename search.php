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

include_once("templates/header.html");

echo "<link rel='stylesheet' href='collections/styles/collection.css'>";
echo "<div class='collection-cont'>";
    foreach ($result as $item) {
        $name = $item[0];
        $price = $item[1];
        $collection = $item[2];
        echo "
            <div class='collection-block'>
                <h1 style='margin:5px;'>$name</h1>
                <h3 style='margin:5px;'>$collection</h3>
                <a href='collections/view.php?n=$name' target='_blank'><img src='functions/getimg.php?name=$name' loading='lazy'></a>
                <h2>$price руб.</h2>
            </div>";
    }
echo "</div>";

include_once("templates/footer.html");
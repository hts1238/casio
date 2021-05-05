<?php

$name = $_GET["n"];

$content = file_get_contents("http://www.oldtimeworld.host.ru/apps/minicat/showmini.asp?n=$name");

$i = 1;
$res = "";
foreach (preg_split("/((\r?\n)|(\r\n?))/", $content) as $line) {
    if ($i == 216) {
        $line = str_replace(["</LI>", "</TH>"], "\n", $line);
        $line = str_replace("<TR ALIGN=LEFT>", "", $line);
        $res = preg_replace("(</?([A-Za-z])*>)", "", iconv("Windows-1251", "UTF-8", $line));
        break;
    }
    $i++;
}


foreach (preg_split("/((\r?\n)|(\r\n?))/", $res) as $line) {
    $arr[] = $line;
}

include_once("../functions/connect.php");
$db = connect();

$sql = "SELECT `price` FROM `casio-goods` WHERE `name`='$name'";
$sql_result = mysqli_query($db, $sql);
$sql_result = mysqli_fetch_assoc($sql_result);
$price = $sql_result['price'];

echo "<h1>", $arr[0], "</h1>";
echo "<h2>", $arr[1], "</h2>";
echo "<h2>Цена: $price руб.</h2>";
echo "<img src='../functions/getbigimg.php?name=$name'>";
echo "<p>", $arr[3], "<br>", $arr[4], "<br>", $arr[5], "</p>";

echo "<ul>";
foreach (array_slice($arr, 6) as $line) {
    if (strlen($line) < 3) {
        continue;
    }
    echo "<li>", $line, "</li>";
}
echo "</ul>";
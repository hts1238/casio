<?php
header("content-type: image/jpg");
$name = $_GET["name"];
$content = file_get_contents("http://www.oldtimeworld.host.ru/images/casio/small/$name.jpg");
if ($content) {
    echo $content;
}
else {
    echo file_get_contents("http://www.oldtimeworld.host.ru/images/casio/big/$name.jpg");
}
<?php
header("content-type: image/jpg");
$name = $_GET["name"];
echo file_get_contents("http://www.oldtimeworld.host.ru/images/casio/big/$name.jpg");
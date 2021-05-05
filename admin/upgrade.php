<?php

include_once("../functions/connect.php");
$db = connect();

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

require_once dirname(__FILE__) . '/../PHPExcel/Classes/PHPExcel/IOFactory.php';

$uploaddir = '../uploads/';
$uploadfile = $uploaddir . basename($_FILES['filename']['name']);
move_uploaded_file($_FILES['filename']['tmp_name'], $uploadfile);
$objPHPExcel = PHPExcel_IOFactory::load($uploadfile);

/*
$sql = "DELETE FROM `casio-goods`";
$sql_result = mysqli_query($db, $sql);
*/
$collection = "";
$i = 14;

while ($collection != "pop") {
    $name = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getValue();
    $isNew = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getValue() == "NEW!!!" ? 1 : 0;
    $price = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getValue();

    if (strlen($price) < 2) {
        $collection = str_replace(" ","-",strtolower($name));
        if ($collection[0] == "-") {
            $collection = substr($collection, 1);
        }
    }
    else {
        if ($isNew == 1) {
            $sql = "INSERT INTO `casio-goods`(`name`, `collection`, `price`) VALUES ('$name', '$collection', '$price')";
            $sql_result = mysqli_query($db, $sql);
        }
    }
    $i++;
}
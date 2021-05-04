<?php

function connect() {
    $DB_HOST = "localhost";
    $DB_LOGIN = "h56372_dbuser";
    $DB_PASSWORD = "011470.ru";
    $DB_NAME = "h56372_db";

    $db = mysqli_connect(
        $DB_HOST,
        $DB_LOGIN,
        $DB_PASSWORD,
        $DB_NAME
    );

    mysqli_set_charset($db, 'utf8');
    return $db;
}
$db = connect();

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

require_once dirname(__FILE__) . '/../PHPExcel/Classes/PHPExcel/IOFactory.php';

$uploaddir = '../uploads/';
$uploadfile = $uploaddir . basename($_FILES['filename']['name']);
move_uploaded_file($_FILES['filename']['tmp_name'], $uploadfile);
$objPHPExcel = PHPExcel_IOFactory::load($uploadfile);

$sql = "DELETE FROM `casio-goods`";
$sql_result = mysqli_query($db, $sql);
$collection = "";
$i = 14;

while ($collection != "POP") {
    $name = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getValue();
    $isNew = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getValue() == "NEW!!!" ? 1 : 0;
    $price = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getValue();

    if (strlen($price) < 2) {
        $collection = $name;
    }
    else {
        $sql = "INSERT INTO `casio-goods`(`name`, `collection`, `price`, `isnew`) VALUES ('$name', '$collection', '$price', '$isNew')";
        $sql_result = mysqli_query($db, $sql);
    }
    $i++;
}
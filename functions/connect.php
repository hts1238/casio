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
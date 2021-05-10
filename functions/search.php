<?php

function search($request) {
    $request = str_replace(' ', '-', preg_replace("/(^ *)|( *$)/", "", strtoupper($request)));

    include_once("functions/connect.php");
    $db = connect();

    $sql = "SELECT `name`, `price`, `collection` FROM `casio-goods`";
    $sql_result = mysqli_query($db, $sql);
    $sql_result = mysqli_fetch_all($sql_result);

    $result = [];
    foreach ($sql_result as $item) {
        if (strpos($item[0], $request) !== false) {
            $result[] = $item;
        }
    }
    return $result;
}
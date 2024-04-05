<?php
$username = "--";
$password = "--";
$dsn = "mysql:host=webhosting-db;dbname=--;charset=utf8";
$db = new PDO($dsn,$username,$password); //connection to database

function get_products($sql) { //returns whatever the given query instructs
    $username = "--";
    $password = "--";
    $dsn = "mysql:host=webhosting-db;dbname=--;charset=utf8";
    $db = new PDO($dsn,$username,$password);


    $result = $db->query($sql);
    return $result;
}
?>

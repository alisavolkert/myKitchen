<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "mykitchen_db";


try
{
    $db = new PDO('mysql:host='.$host.';dbname='.$db.'',$user,$pass);
    $db->query("SET NAMES 'utf8'");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    error_log($e->getMessage());
    die("Ein Datenbankfehler ist aufgetreten.");
}

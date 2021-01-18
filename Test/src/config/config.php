<?php

$dsn = 'mysql:dbname=2libellules_database;host=localhost:8889';
$user = 'les2libellules_db';
$password = 'Bragelogne971';
$options = [
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
];

?>
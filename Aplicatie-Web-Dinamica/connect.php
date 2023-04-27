<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'db_tema2';

$connect = new mysqli($servername, $username, $password, $database);
if($connect->connect_error):
    die("A aparut o eroare! Va rugam sa conectati administratorul site-ului!") . $connect->connect_error;
endif;

?>
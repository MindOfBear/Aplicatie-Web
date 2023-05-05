<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['loggedIn'])){
    die("Nu ai acces aici, conecteaza-te ca admin prima data :)");
}
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__."/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = $_POST["deletePiesaProgram"];

    $stmt = $connect->prepare("DELETE FROM program WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header('Location: ../admin.php');
    $_SESSION["eventType"] = "DELETE_PROG";
}
?>
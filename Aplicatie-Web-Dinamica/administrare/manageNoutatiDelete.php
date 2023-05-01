<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['loggedIn'])){
    die("Nu ai acces aici, conecteaza-te ca admin prima data :)");
}

$id = $_GET["id"];

define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__."/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        $stmt = $connect->prepare("DELETE FROM noutati WHERE id = ?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        header('Location: ../admin.php');
        $_SESSION["eventType"] = "DELETE_NEWS";
}
?>
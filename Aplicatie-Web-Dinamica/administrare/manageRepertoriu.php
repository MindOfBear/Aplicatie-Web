<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__."/connect.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['loggedIn'])){
    die("Nu ai acces aici, conecteaza-te ca admin prima data :)");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numeRepertoriu = $_POST['inputAddRepertoriu'];

    if(empty($numeRepertoriu)){
        header('Location: ../admin.php');
        $_SESSION["eventType"] = "EMPTY_REP";
    } else {
        $stmt = $connect->prepare("INSERT INTO repertoriu (nume) VALUE (?)");
        $stmt->bind_param("s", $numeRepertoriu);
        $stmt->execute();
        header('Location: ../admin.php');
        $_SESSION["eventType"] = "ADD_REP";
    }
}
?>
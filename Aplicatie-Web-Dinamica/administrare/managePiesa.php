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
    $id_repertoriu = $_POST["selectRepertoriu"];
    $nume = $_POST["inputNumePiesa"];

    if(empty($nume && $id_repertoriu)){
        header('Location: ../admin.php');
        $_SESSION["eventType"] = "EMPTY_PIESA";

    } else {
        $stmt = $connect->prepare("INSERT INTO piesa (id_repertoriu, nume) VALUES (?, ?)");
        $stmt->bind_param("ss", $id_repertoriu, $nume);
        $stmt->execute();
        header('Location: ../admin.php');
        $_SESSION["eventType"] = "ADDED_PIESA";
    }
}
?>
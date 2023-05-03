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
    $inputNumeMembru = $_POST["inputNumeMembru"];
    $inputGradMembru = $_POST["inputGradMembru"];
    $inputPozaMembru = $_POST["inputPozaMembru"];
    $inputDescriereMembru = $_POST["inputDescriereMembru"];

    if(empty($inputNumeMembru)||empty($inputGradMembru)||empty($inputPozaMembru)||empty($inputDescriereMembru)){
        header('Location: ../admin.php');
        $_SESSION["eventType"] = "EMPTY_MEMBERS";
    } else {
        $stmt = $connect->prepare("INSERT INTO members (nume,tip,descriere,poza) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss",$inputNumeMembru, $inputGradMembru, $inputDescriereMembru, $inputPozaMembru);
        $stmt->execute();
        header('Location: ../admin.php');
        $_SESSION["eventType"] = "ADDED_MEMBER";
    }
}
?>
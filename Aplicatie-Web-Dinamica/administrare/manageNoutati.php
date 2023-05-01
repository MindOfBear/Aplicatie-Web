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
    $data = date("Y/m/d");
    $inputNoutati = $_POST["inputNoutati"];

    if(empty($inputNoutati)){

        header('Location: ../admin.php');
        $_SESSION["eventType"] = "EMPTY_NEWS";
    } else {
        $stmt = $connect->prepare("INSERT INTO noutati (data, descriere) VALUES (?, ?)");
        $stmt->bind_param("ss", $data, $inputNoutati);
        $stmt->execute();
        header('Location: ../admin.php');
        $_SESSION["eventType"] = "ADDED_NEWS";
    }
}
?>
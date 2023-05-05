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
    $data = $_POST["inputDataProgram"];
    $ora = $_POST["inputOraProgram"];

    $idPiesa = $_POST["inputPiesaProgram"];
    $stmt = $connect->prepare("SELECT * FROM piesa WHERE id = ?");
    $stmt->bind_param("i", $idPiesa);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $idRepertoriu = $row["id_repertoriu"];



    if(empty($idPiesa) && empty($data) && empty($ora)){
        header('Location: ../admin.php');
        $_SESSION["eventType"] = "EMPTY_PROG";
    } else {
        $stmt = $connect->prepare("INSERT INTO program (id_piesa, id_repertoriu, data, ora) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $idPiesa,$idRepertoriu,$data, $ora);
        $stmt->execute();
        header('Location: ../admin.php');
        $_SESSION["eventType"] = "ADDED_PROG";
    }
}
?>
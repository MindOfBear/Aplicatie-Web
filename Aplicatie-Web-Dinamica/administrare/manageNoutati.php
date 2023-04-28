<?php
require_once("connect.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = date("d/m/Y");
    $descriere = $_POST['inputNoutati'];

    if(empty($descriere)){
        $notNull = "Nu poti adauga un anunt gol!";
    } else {
        $stmt = $connect->prepare("INSERT INTO descriere (data, descriere) VALUES (?, ?)");
        $stmt->bind_param("ss",$data ,$descriere);
        $stmt->execute();
        $notNull = "Noutate adaugata cu succes!";
    }
}

?>
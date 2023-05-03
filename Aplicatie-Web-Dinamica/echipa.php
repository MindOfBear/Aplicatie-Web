<?php
session_start();
include "header.html";
require_once "connect.php";
?>
<p class = "currentPage">Echipa</p>

<div class = "rightPhotos">
    <img id = "sidePhotos" src = "galerie/theatreTicket.png">
    <img id = "sidePhotos" src = "galerie/camera.png">
    <img id = "sidePhotos" src = "galerie/comedyandtragedy.png">
    <img id = "sidePhotos" src = "galerie/lightsonme.png">
</div>

<div class = "leftPhotos">
    <img id = "sidePhotos" src = "galerie/star.png">
    <img id = "sidePhotos" src = "galerie/lightsonme.png">
    <img id = "sidePhotos" src = "galerie/comedyandtragedy.png">
    <img id = "sidePhotos" src = "galerie/theatreTicket.png">
</div>


<div class = "holderEchipa">
    <?php
        $stmt = $connect->prepare("SELECT * FROM members");
        $stmt->execute();
        $result = $stmt->get_result();
        while($row=$result->fetch_assoc()){
    
    ?>
        <div class = holderMembru>
            <p id = "numeMembru"><?php echo htmlspecialchars($row['nume'])?></p>
            <p id ="gradMembru"><?php echo htmlspecialchars($row['tip'])?></p>
            <div class="centerDescriereMembru">
                <p id = "descriereMembru"><?php echo htmlspecialchars($row['descriere'])?></p>
            </div>
            <img id = "pozeMembri" src = "galerieMembri/<?php echo htmlspecialchars($row['poza'])?>.png">
        </div>
    <?php 
        }    
    ?>
        

</div>



<?php
include "footer.php";
?>
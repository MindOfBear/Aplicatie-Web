<?php
session_start();
include "header.html";
require_once "connect.php";
?>
<p class = "currentPage">Home</p>

<div class ="noutati">
    <p class="titluNoutati">Noutati & Anunturi</p>
    <div class = "bodyNoutati">
        <?php 
            $stmt = $connect->prepare("SELECT * FROM noutati ORDER BY data DESC");
            $stmt->execute();
            $result = $stmt->get_result();
            $rowCounter = $result->num_rows;        
            while($row = $result->fetch_assoc()) {        
        ?>
        <div class="noutatiParagrafe">
            <p class="homeNoutatiText"><?php echo htmlspecialchars($row['descriere']);?></p>
            <p class="homeNoutatiData"><?php echo htmlspecialchars($row['data']);?></p>
        </div>
    <?php }?>  
    
    </div>
</div>

<div class="msgWelcome">
    <p class="textWelcome">Bun venit pe pagina echipei teatrale, cerul este limita!</p>
    <p class="mesajSpecial">Nu exista limite pentru ceea ce putem realiza impreuna ca trupa de teatru.<br>
         Cu pasiunea si perseverenta noastra, vom continua sa ne ridicam mai sus,<br> spre visele noastre cele mai indraznete. Cerul este doar inceputul!</p>
</div>

<img style = "margin-left:50px" src = "galerie/comedyandtragedy.png">
<img src = "galerie/lightsonme.png">

<?php
include "footer.php";
?>
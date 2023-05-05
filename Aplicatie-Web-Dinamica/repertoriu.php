<?php
session_start();
include "header.html";
require_once "connect.php";
?>
<p class = "currentPage">Repertoriu</p>

<div class="holderRepertoriu">
    <h1 style = "text-align: center; color: white;">Repertoriu</h1>
    <h1 class = "infoPiesaRepertoriu">Repertoriul cuprinde</h1>
    <div class= "holderRepertorii">
    <?php 
        $stmt = $connect->prepare("SELECT * FROM repertoriu");
        $stmt->execute();
        $result = $stmt->get_result();
        $rowCounter = $result->num_rows;        
        while($row = $result->fetch_assoc()) {        
    ?>
        <form method = "POST" action = "repertoriu.php">
            <div class="repertoriu" id = "clickRepertoriu">
                <p id = "pRepert"><?php echo htmlspecialchars($row['nume']);?></p>
                <button name = "markRepertoriu" value = "<?php echo htmlspecialchars($row['id']);?>">Show info</button>
            </div>
        </form>
    <?php }?> 

    </div>
    <div class = "holderInfoPiese">
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $idRepert = $_POST["markRepertoriu"];
            $stmt = $connect->prepare("SELECT * FROM piesa WHERE id_repertoriu = (?)");
            $stmt->bind_param("i", $idRepert);
            $stmt->execute();
            $result = $stmt->get_result();
            $rowCounter = $result->num_rows;        
            while($row = $result->fetch_assoc()) { 
            
        ?>
            <p><?php echo htmlspecialchars($row['nume']);?></p>

    <?php }}?>
    

    </div>
</div>



<?php
include "footer.php";
?>
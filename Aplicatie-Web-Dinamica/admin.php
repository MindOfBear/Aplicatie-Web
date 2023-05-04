<?php
require_once("connect.php");
include "header.html";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$msgLogin = "";
$emptyLogin="";
if (isset($_SESSION["eventType"])){ 
    $eventType = $_SESSION["eventType"];
    $_SESSION["eventType"] = "";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if(empty($username) || empty($password)){
        $emptyLogin = "You must enter username and password first!";   
    } else {

        $stmt = $connect->prepare("SELECT * FROM admin WHERE username = ?");
        $stmt->bind_param("s", $username); 
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $hash = $row['password'];

            if (password_verify($password, $hash)) {
                $_SESSION["loggedIn"] = True;
            } else {
                $msgLogin = "Username or password are invalid!";
            }
        } else {
            $msgLogin = "Username or password are invalid!";
        }
    }
}
?>
<?php if(isset($_SESSION["loggedIn"])) { ?>
<p class = "currentPage" style="color:goldenrod">ADMIN</p>
<div class = "adminNoutati">
    <h1>Manage News</h1>
    <p style = "color:lightblue">
    <?php
        if(isset($eventType) && $eventType === "EMPTY_NEWS") 
        {
            echo "Nu poti adauga un anunt gol!";  
        } else if (isset($eventType) && $eventType === "ADDED_NEWS"){
            echo "Adaugata cu succes!"; 
        } else if (isset($eventType) && $eventType === "DELETE_NEWS"){
            echo "Anuntul a fost sters cu succes!"; 
        } else if (isset($eventType) && $eventType === "EDITED_NEWS"){
            echo "Anuntul a fost editat cu succes!"; 
        }         
     ?>
     </p>
    <form method = "POST" action="administrare/manageNoutati.php">
        <textarea name = "inputNoutati" type = "text" id = inputNoutati></textarea><br>
        <button id = "sendButton">Adauga</button>
    </form>
    <div class="displayInfo">       
        <?php 
            $stmt = $connect->prepare("SELECT * FROM noutati ORDER BY data DESC");
            $stmt->execute();
            $result = $stmt->get_result();
            $rowCounter = $result->num_rows;        
            while($row = $result->fetch_assoc()) {        
        ?>
            <div class="displayInfoSeparat">
                <h4><?php echo htmlspecialchars($row['descriere']); ?></h4>
                <div class="displayInfoButtons">
                <form method  = "POST" action = "administrare/manageNoutatiEdit.php?id=<?php echo $row['id']; ?>"> 
                    <button id = "manageButton">EDIT</button>
                </form>
                <form method  = "POST" action = "administrare/manageNoutatiDelete.php?id=<?php echo $row['id']; ?>"> 
                    <button id = "manageButton">DELETE</button>
                </form>
                </div>
            </div>
        <?php }?>          
    </div>
</div>


<div class="manageTeam">
    <h1>Manage Team</h1>
    <p style = "color:lightblue; font-size: 12px;">
    <?php
        if(isset($eventType) && $eventType === "EMPTY_MEMBERS") 
        {
            echo "Toate campuriile trebuie completate!";  
        } else if (isset($eventType) && $eventType === "ADDED_MEMBER"){
            echo "Membru adaugat cu succes!";      
        } else if (isset($eventType) && $eventType === "DELETE_MEMBER"){
            echo "Membrul a fost sters!";      
        } else if (isset($eventType) && $eventType === "EDITED_MEMBER"){
            echo "Membrul a fost actualizat cu succes!";      
        }
     ?>
     </p>
    <form method = "POST" action = "administrare/manageTeam.php">
        <input name = "inputNumeMembru" type = "text" id = "inputMembers" placeholder="Nume"><br>
        <label for = "inputGradMembru">Grad </label>
        <select name = "inputGradMembru" id = "listaGradMembru">
            <option value = "Regizor">Regizor</option>
            <option value = "Actor">Actor</option>
            <option value = "Scenograf">Scenograf</option>
            <option value = "Backstage">Backstage</option>
        </select><br>
        <input name = "inputPozaMembru" type = "text" id = "inputMembers" placeholder="Nume poza"><br>
        <textarea name = "inputDescriereMembru" type = "text" id = "inputMembersTextarea" placeholder="Descriere"></textarea><br>
        <button id = "sendButton">Adauga</button>
    </form>
    <div class="displayInfo">       
        <?php 
            $stmt = $connect->prepare("SELECT * FROM members");
            $stmt->execute();
            $result = $stmt->get_result();
            $rowCounter = $result->num_rows;        
            while($row = $result->fetch_assoc()) {        
        ?>
            <div class="displayInfoSeparat">
                <h4><?php echo "Nume: " . htmlspecialchars($row['nume']); ?></h4>
                <h4><?php echo "Tip: " . htmlspecialchars($row['tip']); ?></h4>
                <h4><?php echo "Descriere: " . htmlspecialchars($row['descriere']); ?></h4>
                <h4><?php echo "Poza: " . htmlspecialchars($row['poza']); ?></h4>
                <div class="displayInfoButtons">
                <form method  = "POST" action = "administrare/manageTeamEdit.php?id=<?php echo $row['id']; ?>"> 
                    <button id = "manageButton">EDIT</button>
                </form>
                <form method  = "POST" action = "administrare/manageTeamDelete.php?id=<?php echo $row['id']; ?>"> 
                    <button id = "manageButton">DELETE</button>
                </form>
                </div>
            </div>
        <?php }?>          
    </div>
</div>

<div class="manageRepertoriu">
    <h2>Manage Repertory</h2>
    <p style = "color:lightblue; font-size: 12px;">
    <?php
        if(isset($eventType) && $eventType === "EMPTY_REP") 
        {
            echo "Toate campuriile trebuie completate!";  
        } else if (isset($eventType) && $eventType === "ADD_REP"){
            echo "Repertoriul a fost adaugat!";
        }else if (isset($eventType) && $eventType === "DELETE_REP"){
            echo "Repertoriul a fost sters!";
        }else if (isset($eventType) && $eventType === "INVALID_REP"){
            echo "Selectie invalida!";
        }
     ?>
     </p>
    <form action = "administrare/manageRepertoriu.php" method="POST">
        <input id = "addRepertoriuPlace" name = "inputAddRepertoriu" placeholder = "Nume Repertoriu"><br>
        <button id = "sendButton">Adauga</button>
    </form>
    <form action = "administrare/manageRepertoriuDelete.php" method="POST">
        <select name = "inputDeleteRepertoriu" id = "inputDeleteRepertoriu">
            <option disabled selected value>Selectare Repertoriu</option>
            <?php 
                $stmt = $connect->prepare("SELECT * FROM repertoriu");
                $stmt->execute();
                $result = $stmt->get_result();
                $rowCounter = $result->num_rows;        
                while($row = $result->fetch_assoc()) {        
            ?>
            <option value = "<?php echo htmlspecialchars($row['id']);?>"><?php echo htmlspecialchars($row['nume']);?></option>
            <?php 
                }
            ?>
        </select><br>
        <button id = "sendButton">Delete</button>
    </form>
</div>

<div class = "managePiese">
    <h2>Manage Piesa</h2>
    <p style = "color:lightblue; font-size: 12px;">
    <?php
        if(isset($eventType) && $eventType === "EMPTY_PIESA") 
        {
            echo "Toate campuriile trebuie completate!";  
        } else if (isset($eventType) && $eventType === "ADDED_PIESA"){
            echo "Piesa a fost adaugata cu succes!";
        }
     ?>
     </p>
    <form action = "administrare/managePiesa.php" method="POST">
        <input placeholder = "Nume piesa" name = "inputNumePiesa" id = "addRepertoriuPlace">
        <p>Adauga in repertoriul</p>
        <select name = "selectRepertoriu">
            <option disabled selected value>Selectare</option>
            <?php 
                $stmt = $connect->prepare("SELECT * FROM repertoriu");
                $stmt->execute();
                $result = $stmt->get_result();
                $rowCounter = $result->num_rows;        
                while($row = $result->fetch_assoc()) {        
            ?>
            <option value = "<?php echo htmlspecialchars($row['id']);?>"><?php echo htmlspecialchars($row['nume']);?></option>
            <?php 
                }
            ?>
        </select><br>
        <button id = "sendButton">Adauga</button>
    </form>
    <form action = "administrare/managePiesaDelete.php" method = "POST">
    <p>Sterge piesa</p>
        <select name = "selectRepertoriu">
            <option disabled selected value>Stergere</option>
            <?php 
                $stmt = $connect->prepare("SELECT * FROM piesa");
                $stmt->execute();
                $result = $stmt->get_result();
                $rowCounter = $result->num_rows;        
                while($row = $result->fetch_assoc()) {        
            ?>
            <option value = "<?php echo htmlspecialchars($row['id']);?>"><?php echo htmlspecialchars($row['nume']);?></option>
            <?php 
                }
            ?>
        </select><br>
        <button id = "sendButtonn">Delete</button>
    </form>
</div>


<?php } else {?>
<div class="loginForm">
    <h1>Administrator view</h1>
    <form method="POST" action = "admin.php">
        <label for="username" id = "textLogin">Username</label><br>
        <input id="inputLogin" type="text" name = "username"><br>
        <label for="password" id = "textLogin">Password</label><br>
        <input id="inputLogin" type="password" name ="password"><br>
        <button id = "loginButton">Log In</button>
        <p style = "color: lightblue"><?php echo $msgLogin;?></p>
        <p style = "color: lightblue"><?php echo $emptyLogin;?></p>
    </form>
</div>
<?php
}
include "footer.php";
?>

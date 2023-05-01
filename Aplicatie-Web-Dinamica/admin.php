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
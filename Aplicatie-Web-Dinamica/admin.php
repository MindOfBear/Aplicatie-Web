<?php
require_once("connect.php");
include "header.html";
session_start();

$msgLogin = "";
$emptyLogin="";
$notNull = "";

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
    <form method = "POST" action="administrare/manageNoutati.php">
        <p style = "color:lightblue"><?php $notNull?></p>
        <textarea for = "inputNoutati" type = "text" id = inputNoutati></textarea><br>
        <button id = "sendButton">Adauga</button>
    </form>

    <form method = "GET" action = "administrare/manageNoutati.php">
        <div class="displayInfo">
            <div class="displayInfoSeparat">
                <h4>Acesta este un exemplu de anunt trebuie sa scriu mult sa vad daca se afiseaza, probabil o sa apara bine</h4>
                <button id = "manageButton">EDIT</button>
                <button id = "manageButton">DELETE</button>
            </div>
            
        </div>
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
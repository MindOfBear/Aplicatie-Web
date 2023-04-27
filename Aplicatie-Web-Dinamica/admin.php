<?php
require_once("connect.php");
include "header.html";
session_start();

$msgLogin = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

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
?>
<?php if(isset($_SESSION["loggedIn"])) { ?>
<p class = "currentPage" style="color:goldenrod">ADMIN</p>
<div class = "adminNoutati">
    <p>Management noutati</p>
    
</div>

<?php } else {?>
<div class="loginForm">
    <h1>Administrator view</h1>
    <form method="POST">
        <label for="username" id = "textLogin">Username</label><br>
        <input id="inputLogin" type="text" name = "username"><br>
        <label for="password" id = "textLogin">Password</label><br>
        <input id="inputLogin" type="password" name ="password"><br>
        <button id = "loginButton">Log In</button>
        <p style = "color: lightblue"><?php echo $msgLogin;?></p>
    </form>
</div>
<?php
}
include "footer.php";
?>
<?php
require_once("connect.php");
include "header.html";


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
            echo "<h1>Conectat cu succes!</h1>";
        } else {
            echo "<h1 id ='textLogin'>Username or password are invalid!</h1>";
;
        }
    } else {
        echo "<h1 id ='textLogin'>Username or password are invalid!</h1>";
    }
}
?>

<p class = "currentPage" style="color:red">ADMIN</p>

<div class="loginForm">
    <h1>Administrator view</h1>
    <form method="POST">
        <label for="username" id = "textLogin">Username</label><br>
        <input id="inputLogin" type="text" name = "username"><br>
        <label for="password" id = "textLogin">Password</label><br>
        <input id="inputLogin" type="password" name ="password"><br>
        <button id = "loginButton">Log In</button>
        <p id = "invalidData">Username or password is invalid!</p>
    </form>
</div>

<?php
include "footer.html";
?>
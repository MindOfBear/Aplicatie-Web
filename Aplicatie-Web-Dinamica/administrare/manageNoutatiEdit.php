<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__."/connect.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['loggedIn'])){
    die("Nu ai acces aici, conecteaza-te ca admin prima data :)");
}


$id = $_GET["id"];
$stmt = $connect->prepare("SELECT * FROM noutati WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
while($row = $result->fetch_assoc()) {
    $textNews = $row['descriere'];

}

if(isset($_POST['confirm-btn'])) {
    $inputNoutati = $_POST["inputNoutati"];
    $stmt = $connect->prepare("UPDATE noutati SET descriere = ? WHERE id = ?");
    $stmt->bind_param("si", $inputNoutati, $id);
    $stmt->execute();
    header("Location: ../admin.php");
    $_SESSION["eventType"] = "EDITED_NEWS";
}
if(isset($_POST['goBack'])) {
    header("Location: ../admin.php");
}


?>
<!DOCTYPE html>
<html>
    <head>
        <title>Aplicatie Web Teatru</title>
        <link rel="stylesheet" type="text/css" href="../style.css">
    </head>

    <body>
        <nav class="navbar">
            <p class ="textNavbar">Trupa teatrala | Cerul este limita</p>        
        </nav>
    <div class = "bgOpacity">
        <div class = "adminNoutati">
            <h1>News Editor</h1>
            <form method = "POST" action="manageNoutatiEdit.php?id=<?php echo $id?>">
                <textarea name = "inputNoutati" type = "text" id = "inputNoutati"><?php echo htmlspecialchars($textNews); ?></textarea><br>
                <button id = "sendButton" name = "confirm-btn">Save Edit</button>
            </form>
            <form method = "POST" action="manageNoutatiEdit.php?id=<?php echo $id?>">
                <button name = "goBack" id = "sendButton">Cancel</button>
            </form>

        </div>
    </div>
    </body>


<?php
        
include "../footer.php";
?>
</html>
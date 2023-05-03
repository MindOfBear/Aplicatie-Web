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
$stmt = $connect->prepare("SELECT * FROM members WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
while($row = $result->fetch_assoc()) {
    $nume = $row['nume'];
    $tip = $row['tip'];
    $descriere = $row['descriere'];
    $poza = $row['poza'];
}

if(isset($_POST['confirm-btn'])) {
    $inputNumeMembru = $_POST["inputNumeMembru"];
    $inputGradMembru = $_POST["inputGradMembru"];
    $inputPozaMembru = $_POST["inputPozaMembru"];
    $inputDescriereMembru = $_POST["inputDescriereMembru"];

    $stmt = $connect->prepare("UPDATE members SET nume = ?, tip = ?, descriere = ?, poza = ?  WHERE id = ?");
    $stmt->bind_param("ssssi", $inputNumeMembru, $inputGradMembru, $inputDescriereMembru, $inputPozaMembru, $id);
    $stmt->execute();
    header("Location: ../admin.php");
    $_SESSION["eventType"] = "EDITED_MEMBER";
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
        <div class = "manageTeam">
            <h1>Team Editor</h1>
            <form method = "POST" action="manageTeamEdit.php?id=<?php echo $id?>">
                <input name = "inputNumeMembru" type = "text" id = "inputMembers" placeholder="Nume" value = <?php  echo htmlspecialchars($nume) ?>><br>
                <label for = "inputGradMembru">Grad </label>
                <select name = "inputGradMembru" id = "listaGradMembru" value = <?php "$tip"?>>
                    <option value = "Regizor">Regizor</option>
                    <option value = "Actor">Actor</option>
                    <option value = "Scenograf">Scenograf</option>
                    <option value = "Backstage">Backstage</option>
                </select><br>
                <input name = "inputPozaMembru" type = "text" id = "inputMembers" placeholder="Nume poza" value = <?php  echo htmlspecialchars($poza) ?>><br>
                <textarea name = "inputDescriereMembru" type = "text" id = "inputMembersTextarea"><?php echo htmlspecialchars($descriere); ?></textarea><br>
                <button id = "sendButton" name = "confirm-btn">Save Edit</button>
            </form>
            <form method = "POST" action="manageTeamEdit.php?id=<?php echo $id?>">
                <button name = "goBack" id = "sendButton">Cancel</button>
            </form>

        </div>
    </div>
    </body>
<?php
include "../footer.php";
?>
</html>
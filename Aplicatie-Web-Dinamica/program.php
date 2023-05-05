<?php
include "header.html";
require_once("connect.php");
session_start();
?>
<p class = "currentPage">Program</p>
<div class = "displayProgram">
    <h1>Pentru mai multe detalii, puteti consulta si noutatiile de pe pagina Home!</h1>
    <div class="holderTabel">
        <table class = "tabel">
            <thead>
                <tr id = "fixedTableHead">
                    <th>PIESA</th>
                    <th>ORA</th>
                    <th>DATA</th>
                    <th>REPERTORIU</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $stmt = $connect->prepare("SELECT p.nume AS piesa, r.nume AS repertoriu, pr.data, pr.ora
                                           FROM program pr
                                           JOIN piesa p ON pr.id_piesa = p.id 
                                           JOIN repertoriu r ON pr.id_repertoriu = r.id ORDER BY data, ora;");
                $stmt->execute();
                $result = $stmt->get_result();     
                while($row = $result->fetch_assoc()) { 
                    $oraIntreaga = $row["ora"];
                    $ora = substr($oraIntreaga, 0 ,5);

                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['piesa']); ?></td>
                        <td><?php echo htmlspecialchars($ora); ?></td>
                        <td><?php echo htmlspecialchars($row['data']); ?></td>
                        <td><?php echo htmlspecialchars($row['repertoriu']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
</div>

<?php
include "footer.php";
?>
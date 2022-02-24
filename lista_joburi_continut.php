<form method="get">
Cauta dupa un cuvant cheie: <input type="text" name="search"> <input type="submit" name="searchSubmit" value="Cauta">
</form>
<br>
<table>
    <tr>
        <th>Titlu</th>
        <th>Descriere</th>
        <th>Judet</th>
        <th>Localitate</th>
        <th>Valabilitate</th>
        <th>Status</th>
        <th>Taguri</th>
        <!-- <th>Edit</th>
        <th>Stergere</th> -->
        <?php
            if ($_SESSION['rol'] == Constants::ROL_CANDIDAT || $_SESSION['rol'] == Constants::FARA_ROL) {
                echo '<th>Aplica</th>';
            } else {
                echo '<th>Edit</th>
                      <th>Stergere</th>';
            }
        ?>
    </tr>

<?php

$sql = new sqlQuery('SELECT', ['id', 'titlu', 'descriere', 'judet', 'oras', 'valabilitate', 'status', 'tags'],
                    true, ['ID', 'Titlu', 'Descriere', 'Judet', 'Localitate', 'Valabilitate', 'Status', 'Taguri'],
                    'joburi_test', false, '', false, '', '', '');
$sql->buildQuery();
$queryResult = $conn->query($sql->getQuery());
$joburi = [];

foreach ($queryResult as $row) {
    $row['Descriere'] = nl2br($row['Descriere']);

    $dateObj = new DateTime('now');
    $dateObj2 = new DateTime($row['Valabilitate']);
    if ($dateObj2 > $dateObj) {
        $interval = $dateObj2->diff($dateObj);
        $row['Valabilitate'] = 'Expira pe ' . $dateObj2->format('Y-m-d') . ' (' . $interval->days . ' zile ramase)';
    } elseif ($dateObj2->format('Y-m-d') == $dateObj->format('Y-m-d')) {
        $row['Valabilitate'] = 'Expira astazi';
    } else {
        $row['Valabilitate'] = 'A expirat';
    }
    
    switch ($row['Status']) {
        case '1':
            $row['Status'] = 'Activ';
            break;
        case '0':
            $row['Status'] = 'Inactiv';
            break;
    }

    ?>

    <tr>
        <td><?= $row['Titlu'] ?></td>
        <td><?= $row['Descriere'] ?></td>
        <td><?= $row['Judet'] ?></td>
        <td><?= $row['Localitate'] ?></td>
        <td><?= $row['Valabilitate'] ?></td>
        <td><?= $row['Status'] ?></td>
        <td><?= $row['Taguri'] ?></td>
        <!-- <td><a href="editare_job.php?id=<?=$row['ID']?>"><button>Editeaza</button></a></td>
        <td><a href="stergere_job.php?delete=<?=$row['ID']?>" onclick="return confirm('Esti sigur ca vrei sa stergi acest job?');"><button>Sterge</button></a></td> -->
        <?php
            if ($_SESSION['rol'] == Constants::ROL_CANDIDAT || $_SESSION['rol'] == Constants::FARA_ROL) {
                echo '<td><a href="aplica_job.php?id_job=' . $row['ID'] . '"><button>Aplica</button></a></td>';
            } else {
                echo '<td><a href="editare_job.php?id=' . $row['ID'] . '"><button>Editeaza</button></a></td>
                      <td><a href="stergere_job.php?delete=' . $row['ID'] . '" onclick="return confirm(' .
                      "'" . 'Esti sigur ca vrei sa stergi acest job?' . "'" . ');"><button>Sterge</button></a></td>';
            }
        ?>
    </tr>

    <?php
}

if ($_SESSION['rol'] != Constants::FARA_ROL) {
    echo '</table>
      <footer>
      <a href="dashboard.php">Inapoi la dashboard</a>
      <form method="post" action="delogare.php">
        <input type="submit" name="delogare" value="Delogheaza-te">
      </form>
      </footer>
      </html>';
}

?>

<!-- </table>
<footer>
<a href="dashboard.php">Inapoi la dashboard</a>
<form method="post" action="delogare.php">
    <input type="submit" name="delogare" value="Delogheaza-te">
</form>
</footer>
</html> -->
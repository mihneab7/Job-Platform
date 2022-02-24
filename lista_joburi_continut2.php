<style>
    table, th, td {
        border: 1px solid black;
    }
</style>
<header>
    <h1>Toate joburile postate pe platforma</h1>
</header>
<form method="get">
Cauta dupa un cuvant cheie: <input type="text" name="search"> <input type="submit" name="searchSubmit" value="Cauta">
</form>
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

foreach ($queryResult as $row) {
    $row['Descriere'] = nl2br($row['descriere']);

    $dateObj = new DateTime('now');
    $dateObj2 = new DateTime($row['valabilitate']);
    if ($dateObj2 > $dateObj) {
        $interval = $dateObj2->diff($dateObj);
        $row['valabilitate'] = 'Expira pe ' . $dateObj2->format('Y-m-d') . ' (' . $interval->days . ' zile ramase)';
    } elseif ($dateObj2->format('Y-m-d') == $dateObj->format('Y-m-d')) {
        $row['Valabilitate'] = 'Expira astazi';
    } else {
        $row['Valabilitate'] = 'A expirat';
    }
    
    switch ($row['status']) {
        case '1':
            $row['status'] = 'Activ';
            break;
        case '0':
            $row['status'] = 'Inactiv';
            break;
    }

?>

<tr>
    <td><?= $row['titlu'] ?></td>
    <td><?= nl2br($row['descriere']) ?></td>
    <td><?= $row['judet'] ?></td>
    <td><?= $row['oras'] ?></td>
    <td><?= $row['valabilitate'] ?></td>
    <td><?= $row['status'] ?></td>
    <td><?= $row['tags'] ?></td>
    <!-- <td><a href="editare_job.php?id=<?=$row['id']?>"><button>Editeaza</button></a></td>
    <td><a href="stergere_job.php?delete=<?=$row['id']?>" onclick="return confirm('Esti sigur ca vrei sa stergi acest job?');"><button>Sterge</button></a></td> -->
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
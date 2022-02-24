<?php

session_start();

ini_set('log_errors', TRUE);
ini_set('error_log', './erori.txt');

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$_SESSION['paginaCandidat'] = 'setat';
if ($_SESSION['rol'] == Constants::ROL_CANDIDAT) {
    header('Location: http://localhost/hr/faraAcces.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<style>
    table, th, td {
        border: 1px solid black;
    }
</style>
<header>
    <h1>Toate conturile candidatilor inscrise in baza de date</h1>
</header>
<table>
    <tr>
        <th>Nume</th>
        <th>Prenume</th>
        <th>E-mail</th>
        <th>Status</th>
        <th>Rol</th>
        <th>Edit</th>
        <th>Stergere</th>
    </tr>

<?php

require_once('dbconn_attempt.php');

$conturi = [];
$sql = new sqlQuery('SELECT', ['id', 'nume', 'prenume', 'email', 'parola', 'status', 'rol_id'], true,
                    ['ID', 'Nume', 'Prenume', 'E-mail', 'Parola', 'Status', 'Rol'], 'conturi_test2', true,
                    'rol_id = 3', false, '', '', '');

$sql->buildQuery();
$queryResult = $conn->query($sql->getQuery());

foreach ($queryResult as $row) {
    $conturi[] = $row;
    switch ($row['Status']) {
        case '1':
            $row['Status'] = 'Activ';
            break;
        case '0':
            $row['Status'] = 'Inactiv';
            break;
    }

    switch ($row['Rol']) {
        case Constants::ROL_ADMIN:
            $row['Rol'] = 'Administrator';
            break;
        case Constants::ROL_HR:
            $row['Rol'] = 'HR';
            break;
        case Constants::ROL_CANDIDAT:
            $row['Rol'] = 'Candidat';
            break;
    }
?>

<tr>
    <td><?= $row['Nume'] ?></td>
    <td><?= $row['Prenume'] ?></td>
    <td><?= $row['E-mail'] ?></td>
    <td><?= $row['Status'] ?></td>
    <td><?= $row['Rol'] ?></td>
    <td><a href="editare_cont.php?id=<?=$row['ID']?>"><button>Editeaza</button></a></td>
    <td><a href="stergere_cont.php?delete=<?=$row['ID']?>" onclick="return confirm('Esti sigur ca vrei sa stergi acest cont?');"><button>Sterge</button></a></td>

</tr>

<?php

}

?>

</table>
<footer>
<a href="dashboard.php">Inapoi la dashboard</a>
<form method="post" action="delogare.php">
    <input type="submit" name="delogare" value="Delogheaza-te">
</form>
</footer>
</html>
<?php

session_start();

ini_set('log_errors', TRUE);
ini_set('error_log', './erori.txt');

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

if ($_SESSION['rol'] != Constants::ROL_ADMIN) {
    header('Location: http://localhost/hr/faraAcces.php');
}

if (isset($_GET['delete'])) {
    $_SESSION['delete_id'] = $_GET['delete'];
    header('Location: http://localhost/hr/stergere_cont.php');
}

require_once('dbconn_attempt.php');

$actualId = $_GET['id'];

$sql = new sqlQuery('SELECT', '*', false, '', 'conturi_test2', true, 'ID = :actualId', false,
                    '', '', '');
$sql->buildQuery();
$statement = $conn->prepare($sql->getQuery());
$statement->execute(['actualId' => $actualId]);

foreach ($statement as $row) {
    $id = $row['id'];
    $nume = $row['nume'];
    $prenume = $row['prenume'];
    $email = $row['email'];
    $parola = $row['parola'];
    $status = $row['status'];
    $rol_id = $row['rol_id'];
}

?>

<!DOCTYPE html>
<html>
    <header>
        <h1>Editeaza contul</h1>
    </header>
    <form method="get">
        <table>
            <tr><td align="right">ID: </td><td align="left"><input type="text" name="id" value="<?= $id ?>"></td></tr>
            <tr><td align="right">Nume: </td><td align="left"><input type="text" name="nume" value="<?= $nume ?>"></td></tr>
            <tr><td align="right">Prenume: </td><td align="left"><input type="text" name="prenume" value="<?= $prenume ?>"></td></tr>
            <tr><td align="right">E-mail: </td><td align="left"><input type="text" name="email" value="<?= $email ?>"></td></tr>
            <tr><td align="right">Parola: </td><td align="left"><input type="password" name="parola" value="<?= $parola ?>"></td></tr>
            <tr><td align="right">Status: </td><td align="left"><input type="text" name="status" value="<?= $status ?>"></td></tr>
            <tr><td align="right">Rol: </td><td align="left"><input type="text" name="rol" value="<?= $rol_id ?>"></td></tr>
        </table>
        <input type="submit" name="submit" value="Editeaza">
    </form>
    <footer>
        <a href="dashboard.php">Inapoi la dashboard</a>
        <a href="lista_conturi.php">Inapoi la lista conturilor</a>
        <form method="post" action="delogare.php">
            <input type="submit" name="delogare" value="Delogheaza-te">
        </form>
    </footer>
</html>

<?php

if (isset($_GET['submit'])) {
    $sql2 = new sqlQuery('UPDATE', '',
                        false, '', 'conturi_test2', true,
                        ['id = :id', 'nume = :nume', 'prenume = :prenume',
                        'email = :email', 'parola = :parola', 'status = :status',
                        'rol_id = :rol_id', 'id = :actualId'],
                        false, '', '', '');
    $sql2->buildQuery();
    $statement2 = $conn->prepare($sql2->getQuery());
    $statement2->execute(['id' => $_GET['id'],
                          'nume' => $_GET['nume'],
                          'prenume' => $_GET['prenume'],
                          'email' => $_GET['email'],
                          'parola' => $_GET['parola'],
                          'status' => $_GET['status'],
                          'rol_id' => $_GET['rol'],
                          'actualId' => $actualId]);
    
    if ($_SESSION['paginaCandidat'] == 'setat') {
        $_SESSION['paginaCandidat'] = 'nesetat';
        header('Location: http://localhost/hr/lista_candidati.php');
    } else {
        header('Location: http://localhost/hr/lista_conturi.php');
    }
}

?>
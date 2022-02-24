<?php

session_start();

ini_set('log_errors', TRUE);
ini_set('error_log', './erori.txt');

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

if ($_SESSION['rol'] == Constants::ROL_CANDIDAT) {
    header('Location: http://localhost/hr/faraAcces.php');
}

require_once('dbconn_attempt.php');
require_once('judete_orase.php');

$actualId = $_GET['id'];

$sql = new sqlQuery('SELECT', '*', false, '', 'joburi_test', true, 'ID = :actualId', false,
                    '', '', '');
$sql->buildQuery();
$statement = $conn->prepare($sql->getQuery());
$statement->execute(['actualId' => $actualId]);

foreach ($statement as $row) {
    $id = $row['id'];
    $titlu = $row['titlu'];
    $descriere = $row['descriere'];
    $judet = $row['judet'];
    $localitate = $row['oras'];
    $valabilitate = $row['valabilitate'];
    $status = $row['status'];
    $tags = $row['tags'];
}

?>

<!DOCTYPE html>
<html>
    <header>
        <h1>Editeaza jobul</h1>
    </header>
    <form method="get">
        <table>
            <tr><td align="right">ID: </td><td align="left"><input type="text" name="id" value="<?= $id ?>"></td></tr>
            <tr><td align="right">Titlu: </td><td align="left"><input type="text" name="titlu" value="<?= $titlu ?>"></td></tr>
            <tr><td align="right">Descriere: </td><td align="left"><textarea name="descriere" rows="20" cols="50"><?= $descriere ?></textarea></td></tr>
            <tr><td align="right">Judet: </td><td align="left"><select name="judet" checked="<?= $judet ?>">
                <?php
                    $length = count($judete);

                    for ($i = 0; $i < $length; $i++) {
                        echo '<option value="' . $judete[$i] . '"';
                        if ($judete[$i] == $judet) {
                            echo ' selected';
                        }
                        echo '>' . $judeteExplicit[$i] . '</option>' . "\n";
                    }
                ?>
            </select></td></tr>
            <tr><td align="right">Localitate: </td><td align="left"><select name="oras" checked="<?= $localitate ?>">
                <?php
                    for ($i = 0; $i < $length; $i++) {
                        echo '<option value="' . $orase[$i] . '"';
                        if ($orase[$i] == $localitate) {
                            echo ' selected';
                        }
                        echo '>' . $orase[$i] . '</option>' . "\n";
                    }
                ?>
            </select></td></tr>
            <tr><td align="right">Data expirare: </td><td align="left"><input type="date" name="valabilitate" value="<?= $valabilitate ?>"></td></tr>
            <tr><td align="right">Status: </td><td align="left"><input type="text" name="status" value="<?= $status ?>"></td></tr>
            <tr><td align="right">Taguri: </td><td align="left"><input type="text" name="tags" value="<?= $tags ?>"></td></tr>
        </table>
        <input type="submit" name="submit" value="Editeaza">
    </form>
    <footer>
        <a href="dashboard.php">Inapoi la dashboard</a>
        <a href="lista_joburi.php">Inapoi la lista joburilor</a>
        <form method="post" action="delogare.php">
            <input type="submit" name="delogare" value="Delogheaza-te">
        </form>
    </footer>

<?php

$_GET['judet'] = $judet;

if (isset($_GET['submit'])) {
    $sql2 = new sqlQuery('UPDATE', '',
                        false, '', 'joburi_test', true,
                        ['id = :id', 'titlu = :titlu', 'descriere = :descriere',
                        'judet = :judet', 'oras = :oras', 'valabilitate = :valabilitate',
                        'status = :status', 'tags = :tags', 'id = :actualId'],
                        false, '', '', '');
    $sql2->buildQuery();
    $statement2 = $conn->prepare($sql2->getQuery());
    $statement2->execute(['id' => $_GET['id'],
                          'titlu' => $_GET['titlu'],
                          'descriere' => $_GET['descriere'],
                          'judet' => $_GET['judet'],
                          'oras' => $_GET['oras'],
                          'valabilitate' => $_GET['valabilitate'],
                          'status' => $_GET['status'],
                          'tags' => $_GET['tags'],
                          'actualId' => $actualId]);
    $url = "http://localhost/hr/lista_joburi.php";
    echo "<script type='text/javascript'>document.location.href='{$url}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $url . '">';
}

?>

</html>
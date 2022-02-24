<?php

session_start();

ini_set('log_errors', TRUE);
ini_set('error_log', './erori.txt');

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

if ($_SESSION['rol'] != Constants::ROL_ADMIN && $_SESSION['rol'] != Constants::ROL_HR) {
    header('Location: http://localhost/hr/faraAcces.php');
}

require_once('dbconn_attempt.php');
require_once('judete_orase.php');

?>

<!DOCTYPE html>
<html lang="en">
    <header>
        <h1>Posteaza un nou job</h1>
    </header>
    <form method="post">
        <table>
        <tr><td align="right">Titlu: </td><td align="left"><input type="text" name="titlu"></td></tr>
        <tr><td align="right">Descriere: </td><td align="left"><textarea name="descriere" rows="20" cols="50"></textarea></td></tr>
        <tr><td align="right">Judet: </td><td align="left"><select name="judet">
                <?php
                    $length = count($judete);

                    for ($i = 0; $i < $length; $i++) {
                        echo '<option value="' . $judete[$i] . '">' . $judeteExplicit[$i] . '</option>' . "\n";
                    }
                ?>
        </select></td></tr>
        <tr><td align="right">Oras: </td><td align="left"><select name="oras">
                <?php
                    for ($i = 0; $i < $length; $i++) {
                        echo '<option value="' . $orase[$i] . '">' . $orase[$i] . '</option>' . "\n";
                    }
                ?>
        </select></td></tr>
        <tr><td align="right">Data expirare: </td><td align="left"><input type="date" name="data"></td></tr>
        <tr><td align="right">Taguri: </td><td align="left"><input type="text" name="taguri"></td></tr>
        </table>
        <input type="submit" name="submit" value="Adauga job">
    </form>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $titlu = $_POST['titlu'];
        $descriere = $_POST['descriere'];
        $judet = $_POST['judet'];
        $oras = $_POST['oras'];
        $valabilitate = $_POST['data'];
        $taguri = $_POST['taguri'];

        $sql = new sqlQuery('INSERT', ['titlu', 'descriere', 'judet', 'oras', 'valabilitate', 'tags'],
                            false, '', 'joburi_test', false, '', false, '', '', ':titlu, :descriere, :judet, :oras, :valabilitate, :tags');
        $sql->buildQuery();
        $statement = $conn->prepare($sql->getQuery());
        $statement->execute(['titlu' => $titlu,
                             'descriere' => $descriere,
                             'judet' => $judet,
                             'oras' => $oras,
                             'valabilitate' => $valabilitate,
                             'tags' => $taguri]);
        
        $url = "http://localhost/hr/dashboard.php";
        echo "<script type='text/javascript'>document.location.href='{$url}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $url . '">';
    }
}

?>

    <footer>
        <a href="dashboard.php">Inapoi la dashboard</a>
        <form method="post" action="delogare.php">
            <input type="submit" name="delogare" value="Delogheaza-te">
        </form>
    </footer>
</html>
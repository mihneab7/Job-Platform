<?php

session_start();

ini_set('log_errors', TRUE);
ini_set('error_log', './erori.txt');

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

require_once('dbconn_attempt.php');

if ($_SESSION['rol'] == Constants::FARA_ROL || $_SESSION['rol'] == Constants::ROL_CANDIDAT) {
    header('Location: http://localhost/hr/faraAcces.php');
}

$statusuri = ['Trimisa', 'Vazuta', 'Respinsa', 'Acceptata pentru interviu', 'Acceptata'];

?>

<!DOCTYPE html>
<html>
    <header>
        <h1>Schimba statusul</h1>
    </header>
    <form method="post">
        <table>
            <tr><td align="right">Titlu:</td><td align="left"><input type="text" name="titlu" value="<?= $_GET['titlu'] ?>" readonly></td></tr>
            <tr><td align="right">Judet:</td><td align="left"><input type="text" name="judet" value="<?= $_GET['judet'] ?>" readonly></td></tr>
            <tr><td align="right">Localitate:</td><td align="left"><input type="text" name="localitate" value="<?= $_GET['localitate'] ?>" readonly></td></tr>
            <tr><td align="right">Expira la data de:</td><td align="left"><input type="date" name="expirat" value="<?= $_GET['expirat'] ?>" readonly></td></tr>
            <tr><td align="right">Email:</td><td align="left"><input type="text" name="email" value="<?= $_GET['email'] ?>" readonly></td></tr>
            <tr><td align="right">CV:</td><td align="left"><input type="text" name="cv" value="<?= $_GET['cv'] ?>" readonly></td></tr>
            <tr><td align="right">Data aplicatiei:</td><td align="left"><input type="data_app" name="titlu" value="<?= $_GET['data_app'] ?>" readonly></td></tr>
            <tr><td align="right">Status:</td><td align="left"><select name="status">
                <?php
                    for ($i = 0; $i < Constants::NR_STATUSURI; $i++) {
                        echo '<option value="' . Constants::STATUSURI[$i] . '"';
                        if (Constants::STATUSURI[$i] == $_GET['status']) {
                            echo ' selected';
                        }
                        echo '>' . Constants::STATUSURI[$i] . '</option>' . "\n";
                    }
                ?>
            </select></td></tr>
            <tr><td align="right"></td><td align="left"><input type="submit" name="update" value="Schimba status"></td></tr>
        </table>
    </form>
    <footer>
        <a href="dashboard.php">Inapoi la dashboard</a>
        <a href="lista_aplicatii.php">Inapoi la lista aplicatiilor</a>
        <form method="post" action="delogare.php">
            <input type="submit" name="delogare" value="Delogheaza-te">
        </form>
    </footer>

    <?php

        switch ($_POST['status']) {
            case Constants::STATUSURI[0]:
                $_POST['status'] = 1;
                break;

            case Constants::STATUSURI[1]:
                $_POST['status'] = 2;
                break;

            case Constants::STATUSURI[2]:
                $_POST['status'] = 3;
                break;

            case Constants::STATUSURI[3]:
                $_POST['status'] = 4;
                break;

            case Constants::STATUSURI[4]:
                $_POST['status'] = 5;
                break;
        }

        if (isset($_POST['update'])) {
            $sql = 'UPDATE aplicatii_test SET status = :status WHERE id = :id';
            $statement = $conn->prepare($sql);
            $statement->execute(['status' => $_POST['status'],
                                 'id' => $_GET['app_id']]);
            header('Location: http://localhost/hr/lista_aplicatii.php');
        }

    ?>

</html>
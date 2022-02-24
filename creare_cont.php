<?php

session_start();

ini_set('log_errors', TRUE);
ini_set('error_log', './erori.txt');

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

switch ($_SESSION['rol']) {
    case Constants::ROL_ADMIN:
        echo '<!DOCTYPE html>
        <html>
            <header>
                <h1>Creeaza un cont nou</h1>
                <h3>Atentie! Logarea se va face folosind e-mail si parola!</h3>
            </header>
            <form method="post">
                <table>
                    <tr><td align="right">Nume: </td><td align="left"><input type="text" name="nume"></td></tr>
                    <tr><td align="right">Prenume: </td><td align="left"><input type="text" name="prenume"></td></tr>
                    <tr><td align="right">E-mail: </td><td align="left"><input type="text" name="email"></td></tr>
                    <tr><td align="right">Parola: </td><td align="left"><input type="password" name="parola"></td></tr>
                    <tr><td align="right">Rol: </td><td align="left"><select name="rol">
                        <option value="1">Administrator</option>
                        <option value="2">HR</option>
                        <option value="3">Candidat</option>
                    </select></td></tr>
                </table>
                <input type="submit" name="submit" value="Creeaza cont">
            </form>';
            
        require_once('dbconn_attempt.php');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['submit'])) {
                $nume = $_POST['nume'];
                $prenume = $_POST['prenume'];
                $email = $_POST['email'];
                $parola = $_POST['parola'];
                $rol = (int) $_POST['rol'];

                $sql = new sqlQuery('INSERT', ['nume', 'prenume', 'email', 'parola', 'rol_id'],
                                    false, '', 'conturi_test2', false, '', false, '', '', ':nume, :prenume, :email, :parola, :rol');
                $sql->buildQuery();
                $statement = $conn->prepare($sql->getQuery());
                $statement->execute(['nume' => $nume,
                                     'prenume' => $prenume,
                                     'email' => $email,
                                     'parola' => $parola,
                                     'rol' => $rol]);

                header('Location: http://localhost/hr/dashboard.php');
            }
        }

        echo '<footer>
        <a href="dashboard.php">Inapoi la dashboard</a>
        <form method="post" action="delogare.php">
            <input type="submit" name="delogare" value="Delogheaza-te">
        </form>
        </footer>';
        break;

    case Constants::FARA_ROL:
        echo '<!DOCTYPE html>
        <html>
            <header>
                <h1>Creeaza un cont nou</h1>
                <h3>Atentie! Logarea se va face folosind e-mail si parola!</h3>
            </header>
            <form method="post">
                <table>
                    <tr><td align="right">Nume: </td><td align="left"><input type="text" name="nume"></td></tr>
                    <tr><td align="right">Prenume: </td><td align="left"><input type="text" name="prenume"></td></tr>
                    <tr><td align="right">E-mail: </td><td align="left"><input type="text" name="email"></td></tr>
                    <tr><td align="right">Parola: </td><td align="left"><input type="password" name="parola"></td></tr>
                </table>
                <input type="submit" name="submit" value="Creeaza cont">
            </form>';
        
        require_once('dbconn_attempt.php');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['submit'])) {
                $nume = $_POST['nume'];
                $prenume = $_POST['prenume'];
                $email = $_POST['email'];
                $parola = $_POST['parola'];

                $sql = new sqlQuery('INSERT', ['nume', 'prenume', 'email', 'parola'],
                                    false, '', 'conturi_candidati', false, '', false, '', '', ':nume, :prenume, :email, :parola');
                $sql->buildQuery();
                $statement = $conn->prepare($sql->getQuery());
                $statement->execute(['nume' => $nume,
                                     'prenume' => $prenume,
                                     'email' => $email,
                                     'parola' => $parola]);
                
                header('Location: http://localhost/hr/login_candidati.php');
            }
        }

        echo '<footer>
        <a href="login_candidati.php">Inapoi la pagina de login</a>
        </footer>';
        break;

    default:
        header('Location: http://localhost/hr/faraAcces.php');
}

?>
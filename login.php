<?php

session_start();

ini_set('log_errors', TRUE);
ini_set('error_log', './erori.txt');

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

if ($_SESSION['rol'] != Constants::FARA_ROL) {
    header('Location: http://localhost/hr/dashboard.php');
}

?>

<!DOCTYPE html>
<html lang="en">
    <header>
        <h1>Va rugam sa va logati in platforma Flanco</h1>
    </header>
    <form method="post">
        <table>
            <tr><td align="right">E-mail:</td><td align="left"><input type="text" name="email"></td></tr>
            <tr><td align="right">Parola:</td><td align="left"><input type="password" name="parola"></td></tr>
        </table>
        <input type="submit" name="login" value="Logheaza-te">
    </form>
    <br>
    <!-- Daca nu ai cont, iti poti crea unul nou <a href="creare_cont.php">aici</a>.
    <br> -->
</html>

<?php

require_once('dbconn_attempt.php');

function testData($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['email'])) {
        echo 'E-mailul este obligatoriu! ';
    } else {
        $email = testData($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'Format de e-mail invalid! ';
        }
    }

    $parola = $_POST['parola'];

    $sql = new sqlQuery('SELECT', '*', false, '', 'conturi', true, 'email = :email' . ' AND parola = :parola',
                        false, '', '', '');
    $sql->buildQuery();
    $statement = $conn->prepare($sql->getQuery());
    

    if (isset($_POST['login'])) {
        $statement->execute(['email' => $email, 'parola' => $parola]);
        if ($statement->rowCount() > 0) {
            foreach ($statement as $cont) {
                $_SESSION['rol'] = (int) $cont['rol_id'];
            }
            header('Location: http://localhost/hr/dashboard.php');
        } else {
            echo 'E-mailul sau parola este gresita!';
        }
    }
}

?>
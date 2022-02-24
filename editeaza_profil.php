<?php

session_start();

ini_set('log_errors', TRUE);
ini_set('error_log', './erori.txt');

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

require_once('dbconn_attempt.php');

function incarcaCV($filename, $file, $size, $candidat_id, $conn)
{
    $array = explode('.', $filename);
    if (isset($_SESSION['id_candidat_logat'])) {
        $filename = $array[0] . '_' . $candidat_id . '.' . $array[1];
    } else {
        $_SESSION['randomNumber'] = rand(0, 999_999);
        $filename = $array[0] . '_null' . $_SESSION['randomNumber'] . $array[1];
    }
    $destination  = Constants::CALE_INCARCARE . $filename;
    $today = new DateTime('now');

    if ($size > 20_971_520) {
        throw new Exception('Fisierul este prea mare.');
    } else {
        if (move_uploaded_file($file, $destination)) {
            $sql = 'INSERT INTO cvs_test (path, size, date, candidat_id) VALUES (:path, :size, :date, :candidat_id)';
            $statement = $conn->prepare($sql);
            $statement->execute(['path' => $destination,
                                 'size' => $size,
                                 'date' => $today->format('Y-m-d'),
                                 'candidat_id' => $candidat_id]);
        }
    }
}

function obtainName($name)
{
    $string = substr($name, strlen(Constants::CALE_INCARCARE));
    $array = explode('.', $string);
    return $array[0];
}

if ($_SESSION['rol'] == Constants::FARA_ROL || $_SESSION['rol'] == Constants::ROL_HR) {
    header('Location: http://localhost/hr/faraAcces.php');
}

$sql = 'SELECT * FROM conturi_candidati_test WHERE id = :id';
$statement = $conn->prepare($sql);
$statement->execute(['id' => $_SESSION['id_candidat_logat']]);

$sql2 = 'SELECT * FROM cvs_test WHERE candidat_id = :candidat_id GROUP BY id ORDER BY id desc LIMIT 1';
$statement2 = $conn->prepare($sql2);
$statement2->execute(['candidat_id' => $_SESSION['id_candidat_logat']]);

try {
    foreach ($statement as $row) {
        $nume = $row['nume'];
        $prenume = $row['prenume'];
        $email = $row['email'];
        $parola = $row['parola'];
    }

    $rowCV = $statement2->fetch();
    $date = $rowCV['date'];
    $path = $rowCV['path'];
} catch (Exception $e) {
    echo $e->getMessage();
}

?>

<!DOCTYPE html>
<html>
    <header>
        <h1>Pagina de editare a profilului</h1>
    </header>
    <form method="post" enctype="multipart/form-data">
        <table>
            <tr><td align="right">Nume: </td><td align="left"><input type="text" name="nume" value="<?= $nume ?>"></td></tr>
            <tr><td align="right">Prenume: </td><td align="left"><input type="text" name="prenume" value="<?= $prenume ?>"></td></tr>
            <tr><td align="right">Email: </td><td align="left"><input type="text" name="email" value="<?= $email ?>"></td></tr>
            <tr><td align="right">Parola: </td><td align="left"><input type="password" name="parola" value="<?= $parola ?>"></td></tr>
            <tr><td align="right">CV: </td><td align="left"><input type="file" name="upload"></td></tr>
            <?php
                if (isset($path)) {
                    echo '<tr><td></td><td align="left">Ultimul CV a fost incarcat la data de <b>' . $date . '</b> si se numeste <b>' .
                          obtainName($path) . '<b></td></tr>';
                } else {
                    echo '<tr><td></td><td align="left">Niciun CV nu a fost incarcat pana acum</td></tr>';
                }
            ?>
            <tr><td></td><td align="left"><input type="submit" name="descarca" value="Descarca CV"></td></tr>
            <tr><td></td><td align="left"><input type="submit" name="actualizeaza" value="Actualizeaza"></td></tr>
        </table>
    </form>

    <?php
        if (isset($_POST['descarca'])) {
            if (isset($rowCV)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename=' . basename($rowCV['path']));
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . $rowCV['size']);
                readfile($rowCV['path']);
            } else {
                echo 'Nu a fost incarcat niciun CV.';
            }
        }
        
        if (isset($_POST['actualizeaza'])) {
            if (isset($_FILES)) {
                incarcaCV($_FILES['upload']['name'], $_FILES['upload']['tmp_name'],
                      $_FILES['upload']['size'], $_SESSION['id_candidat_logat'],
                      $conn);
            }

            $sql3 = 'UPDATE conturi_candidati_test SET nume = :nume, prenume = :prenume, email = :email,
                     parola = :parola WHERE id = :id';
            $statement3 = $conn->prepare($sql3);
            $statement3->execute(['nume' => $_POST['nume'],
                                  'prenume' => $_POST['prenume'],
                                  'email' => $_POST['email'],
                                  'parola' => $_POST['parola'],
                                  'id' => $_SESSION['id_candidat_logat']]);

            header('Location: http://localhost/hr/editeaza_profil.php');
        }

    ?>

    <br>
    <a href="dashboard.php">Inapoi la dashboard</a>
    <form method="post" action="delogare.php">
        <input type="submit" name="delogare" value="Delogheaza-te">
    </form>

</html>
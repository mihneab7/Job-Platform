<?php

session_start();

ini_set('log_errors', TRUE);
ini_set('error_log', './erori.txt');

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

require_once('dbconn_attempt.php');

function incarcaCV($filename, $file, $size, $conn)
{
    $array = explode('.', $filename);
    if ($_SESSION['id_candidat_logat'] != '') {
        $filename = $array[0] . '_' . $_SESSION['id_candidat_logat'] . '.' . $array[1];
        $temp = $_SESSION['id_candidat_logat'];
    } else {
        $_SESSION['randomNumber'] = rand(0, 999_999);
        $filename = $array[0] . '_null' . $_SESSION['randomNumber'] . '.' . $array[1];
        $temp = null;
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
                                 'candidat_id' => $temp]);
        }
    }
}

function incarcaAplicatie($job_id, $conn)
{
    $date = new DateTime('now');
    $status = 1;
    
    if ($_SESSION['id_candidat_logat'] != '') {
        $sql = 'SELECT * FROM conturi_candidati WHERE id = :id';
        $statement = $conn->prepare($sql);
        $statement->execute(['id' => $_SESSION['id_candidat_logat']]);
        $candidat = $statement->fetch();
        $emailCandidat = $candidat['email'];

        $sql2 = 'SELECT * FROM cvs_test WHERE candidat_id = :candidat_id GROUP BY id ORDER BY id desc LIMIT 1';
        $statement2 = $conn->prepare($sql2);
        $statement2->execute(['candidat_id' => $_SESSION['id_candidat_logat']]);
        $cv = $statement2->fetch();
        $cvID = $cv['id'];

        $sql3 = 'INSERT INTO aplicatii_test (data, email, status, job_id, candidat_id, cv_id) VALUES
            (:data, :email, :status, :job_id, :candidat_id, :cv_id)';
        $statement3 = $conn->prepare($sql3);
        $statement3->execute(['data' => $date->format('Y-m-d'),
                              'email' => $emailCandidat,
                              'status' => $status,
                              'job_id' => $job_id,
                              'candidat_id' => $_SESSION['id_candidat_logat'],
                              'cv_id' => $cvID]);
    } else {
        $sql = 'SELECT * FROM cvs_test WHERE path LIKE "%_null' . $_SESSION['randomNumber'] . '%"';
        $statement = $conn->prepare($sql);
        $statement->execute();
        $cv = $statement->fetch();
        $cvID = $cv['id'];
        
        $sql2 = 'INSERT INTO aplicatii_test (data, email, status, job_id, candidat_id, cv_id) VALUES
            (:data, :email, :status, :job_id, :candidat_id, :cv_id)';
        $statement2 = $conn->prepare($sql2);
        $statement2->execute(['data' => $date->format('Y-m-d'),
                              'email' => $_POST['email'],
                              'status' => $status,
                              'job_id' => $job_id,
                              'candidat_id' => $_SESSION['id_candiat_logat'],
                              'cv_id' => $cvID]);
    }
    
    
}

$sql = 'SELECT * FROM joburi_test WHERE id = :id_job';
$statement = $conn->prepare($sql);
$statement->execute(['id_job' => $_GET['id_job']]);
$job = $statement->fetch();

?>

<!DOCTYPE html>
<html>
    <header>
        <h1>Aplica pentru job</h1>
    </header>
    <form method="post" enctype="multipart/form-data">
        <table>
            <tr><td align="right">Titlu job: </td><td align="left"><input type="text" name="titluJob" value="<?= $job['titlu'] ?>" readonly></td></tr>
            <tr><td align="right">Descriere: </td><td align="left"><textarea name="descriere" rows="20" cols="50" readonly><?= $job['descriere'] ?></textarea></td></tr>
            <tr><td align="right">Judet: </td><td align="left"><input type="text" name="judet" value="<?= $job['judet'] ?>" readonly></td></tr>
            <tr><td align="right">Localitate: </td><td align="left"><input type="text" name="localitate" value="<?= $job['oras'] ?>" readonly></td></tr>
            <tr><td align="right">Expira pe: </td><td align="left"><input type="text" name="valabilitate" value="<?= $job['valabilitate'] ?>" readonly></td></tr>
            <tr><td align="right">Status: </td><td align="left"><input type="text" name="judet" value="<?= ($job['status']) ? 'Activ' : 'Inactiv' ?>" readonly></td></tr>
            <tr><td align="right">Taguri: </td><td align="left"><input type="text" name="tags" value="<?= $job['tags'] ?>" readonly></td></tr>
            <?php if ($_SESSION['rol'] == Constants::FARA_ROL) {
                echo '<tr><td align="right">E-mail (obligatoriu): </td><td><input type="text" name="email"></td></tr>';
            }
            ?>
            <tr><td align="right">CV: </td><td align="left"><input type="file" name="upload"></td></tr>
            <tr><td></td><td align="left">Atentie! Va fi folosit ultimul CV incarcat pe profil. Daca doriti sa folositi
                alt CV, va rugam sa il incarcati aici</td></tr>
            <tr><td></td><td align="left">Daca nu ti-ai creat cont, o poti face <a href="creare_cont.php">aici</a></td></tr>
            <tr><td></td><td align="left"><input type="submit" name="aplica" value="Aplica"></td></tr>
        </table>
    </form>

    <?php
        if (isset($_POST['aplica'])) {
            if ($_SESSION['id_candidat_logat'] != '') {
                if (isset($_FILES)) {
                    incarcaCV($_FILES['upload']['name'], $_FILES['upload']['tmp_name'],
                            $_FILES['upload']['size'],
                            $conn);
                    incarcaAplicatie($_GET['id_job'], $conn);
                } else {
                    try {
                        incarcaAplicatie($_GET['id_job'], $conn);
                    } catch (Exception $e) {
                        echo 'Nu a fost incarcat niciun CV!';
                    }
                }
            } else {
                if ((isset($_FILES)) && (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))) {
                    incarcaCV($_FILES['upload']['name'], $_FILES['upload']['tmp_name'],
                            $_FILES['upload']['size'], $conn);
                    incarcaAplicatie($_GET['id_job'], $conn);
                } else {
                    echo 'Nu exista CV sau e-mailul este invalid!' . "\n";
                }
            }
        }
        
        echo '<a href="lista_joburi.php">Inapoi la lista joburilor</a> ';

        if ($_SESSION['rol'] != Constants::FARA_ROL) {
            echo '<a href="dashboard.php">Inapoi la dashboard</a>
                <form method="post" action="delogare.php">
                    <input type="submit" name="delogare" value="Delogheaza-te">
                </form>';
        }
    ?>

</html>
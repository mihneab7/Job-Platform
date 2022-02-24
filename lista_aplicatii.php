<?php

session_start();
ob_start();

ini_set('log_errors', TRUE);
ini_set('error_log', './erori.txt');

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

require_once('dbconn_attempt.php');

function obtainName($name)
{
    $string = substr($name, strlen(Constants::CALE_INCARCARE));
    return $string;
}

?>

<!DOCTYPE html>
<html>
    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
    <header>
        <h1>Lista tuturor aplicatiilor <?php if ($_SESSION['rol'] == Constants::ROL_CANDIDAT) {echo 'tale';} ?></h1>
    </header>

    <?php
        switch ($_SESSION['rol']) {
            case Constants::ROL_CANDIDAT:
                $sql = 'SELECT joburi_test.titlu AS Titlu, joburi_test.judet AS Judet, joburi_test.oras AS Localitate,
                        joburi_test.valabilitate AS "Expira in data de", cvs_test.path AS CV, aplicatii_test.data AS "Data aplicatiei",
                        aplicatii_test.status AS Status FROM aplicatii_test LEFT JOIN joburi_test ON job_id = joburi_test.id
                        LEFT JOIN cvs_test ON cv_id = cvs_test.id WHERE aplicatii_test.candidat_id = :id';
                $statement = $conn->prepare($sql);
                $statement->execute(['id' => $_SESSION['id_candidat_logat']]);
                $result = $statement->fetchAll();
                break;
            
            case Constants::ROL_ADMIN:
                $sql = 'SELECT aplicatii_test.id, joburi_test.titlu AS Titlu, joburi_test.judet AS Judet, joburi_test.oras AS Localitate,
                        joburi_test.valabilitate AS "Expira in data de", aplicatii_test.email AS Email, cvs_test.id AS cv_id,
                        cvs_test.path AS CV, cvs_test.size AS Size, aplicatii_test.id AS ID, aplicatii_test.data AS "Data aplicatiei",
                        aplicatii_test.status AS Status FROM aplicatii_test LEFT JOIN joburi_test ON job_id = joburi_test.id
                        LEFT JOIN cvs_test ON cv_id = cvs_test.id';
                $statement = $conn->prepare($sql);
                $statement->execute();
                $result = $statement->fetchAll();
                break;

            case Constants::ROL_HR:
                $sql = 'SELECT aplicatii_test.id, joburi_test.titlu AS Titlu, joburi_test.judet AS Judet, joburi_test.oras AS Localitate,
                        joburi_test.valabilitate AS "Expira in data de", aplicatii_test.email AS Email, cvs_test.id AS cv_id,
                        cvs_test.path AS CV, cvs_test.size AS Size, aplicatii_test.id AS ID, aplicatii_test.data AS "Data aplicatiei",
                        aplicatii_test.status AS Status FROM aplicatii_test LEFT JOIN joburi_test ON job_id = joburi_test.id
                        LEFT JOIN cvs_test ON cv_id = cvs_test.id';
                $statement = $conn->prepare($sql);
                $statement->execute();
                $result = $statement->fetchAll();
                break;

            default:
                header('Location: http://localhost/hr/faraAcces.php');
        }
    ?>

    <table>
        <tr>
            <th>Titlu</th>
            <th>Judet</th>
            <th>Localitate</th>
            <th>Expira la data de</th>
            <?php if ($_SESSION['rol'] != Constants::ROL_CANDIDAT) {
                echo '<th>Email</th>';
            } ?>
            <th>CV</th>
            <th>Data aplicatiei</th>
            <th>Status</th>
            <?php if ($_SESSION['rol'] != Constants::ROL_CANDIDAT) {
                echo '<th>Edit</th>';
                echo '<th>Descarca CV</th>';
            } ?>
        </tr>

        <?php

        if ($_SESSION['rol'] != Constants::ROL_CANDIDAT) {
            foreach ($result as $res) {
                switch ($res['Status']) {
                    case '1':
                        $res['Status'] = 'Trimisa';
                        break;
                    
                    case '2':
                        $res['Status'] = 'Vazuta';
                        break;
                    
                    case '3':
                        $res['Status'] = 'Respinsa';
                        break;

                    case '4':
                        $res['Status'] = 'Acceptata pentru interviu';
                        break;

                    case '5':
                        $res['Status'] = 'Acceptata';
                        break;
                }

                echo '<tr><td>' . $res['Titlu'] . '</td><td>' . $res['Judet'] . '</td><td>' . $res['Localitate'] .
                     '</td><td>' . $res['Expira in data de'] . '</td><td>' . $res['Email'] . '</td><td>' .
                     $res['CV'] . '</td><td>' . $res['Data aplicatiei'] . '</td><td>' . $res['Status'] .
                     '</td><td><a href="schimba_status.php?app_id=' . $res['ID'] . '&titlu=' . $res['Titlu'] . 
                     '&judet=' . $res['Judet'] . '&localitate=' . $res['Localitate'] . '&expirat=' . 
                     $res['Expira in data de'] . '&email=' . $res['Email'] . '&cv=' . $res['CV'] . 
                     '&data_app=' . $res['Data aplicatiei'] . '&status=' . $res['Status'] . '"><button>Schimba</button></a></td>
                     <td><form method="post"><input type="submit" name="cv_id' . $res['cv_id'] . '" value="Descarca CV">
                     </form></td></tr>';
            }
        } else {
            foreach ($result as $res) {
                $res['CV'] = obtainName($res['CV']);

                switch ($res['Status']) {
                    case '1':
                        $res['Status'] = 'Trimisa';
                        break;
                    
                    case '2':
                        $res['Status'] = 'Vazuta';
                        break;
                    
                    case '3':
                        $res['Status'] = 'Respinsa';
                        break;

                    case '4':
                        $res['Status'] = 'Acceptata pentru interviu';
                        break;

                    case '5':
                        $res['Status'] = 'Acceptata';
                        break;
                }

                echo '<tr><td>' . $res['Titlu'] . '</td><td>' . $res['Judet'] . '</td><td>' . $res['Localitate'] . 
                     '</td><td>' . $res['Expira in data de'] . '</td><td>' . $res['CV'] . '</td><td>' . $res['Data aplicatiei'] .
                     '</td><td>' . $res['Status'] . '</td></tr>';
            }
        }

        foreach ($result as $res) {
            if (isset($_POST['cv_id' . $res['cv_id']])) {
                ob_end_clean();
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename=' . basename($res['CV']));
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . $res['Size']);
                readfile($res['CV']);
            }
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
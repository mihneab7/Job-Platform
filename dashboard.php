<!DOCTYPE html>
<html lang="en">
    <header>
        <h1>Dashboard</h1>
    </header>

<?php

session_start();

ini_set('log_errors', TRUE);
ini_set('error_log', './erori.txt');

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

require_once('dbconn_attempt.php');

switch ($_SESSION['rol']) {
    case Constants::ROL_ADMIN:
        echo 'Rol: Administrator';
        echo '<ul>
        <u><b>Vizualizare</b></u>
        <li><a href="lista_conturi.php">Vezi conturile</a></li>
        <li><a href="lista_candidati.php">Vezi candidati</a></li>
        <li><a href="lista_aplicatii.php">Vezi aplicatii</a></li>
        <li><a href="lista_joburi.php">Vezi joburi</a></li>
        <br>
        <u><b>Creatie</b></u>
        <li><a href="creare_cont.php">Creeaza cont nou</a></li>
        <li><a href="postare_job.php">Posteaza job nou</a></li>
        </ul>';
        break;

    case Constants::ROL_HR:
        echo 'Rol: HR';
        echo '<ul>
        <u><b>Vizualizare</b></u>
        <li><a href="lista_candidati.php">Vezi candidati</a></li>
        <li><a href="lista_aplicatii.php">Vezi aplicatii</a></li>
        <li><a href="lista_joburi.php">Vezi joburi</a></li>
        <br>
        <u><b>Creatie</b></u>
        <li><a href="postare_job.php">Posteaza job nou</a></li>
        </ul>';
        break;
    
    case Constants::ROL_CANDIDAT:
        echo 'Rol: Candidat';
        echo '<ul>
        <u><b>Vizualizare</b></u>
        <li><a href="lista_joburi.php">Vezi joburi</a></li>
        <li><a href="lista_aplicatii.php">Vezi aplicatii</a></li>
        <br>
        <u><b>Creatie</b></u>
        <li><a href="editeaza_profil.php">Editeaza profil</a></li></ul>';
}

?>

    <br>
    <form method="post" action="delogare.php">
        <input type="submit" name="delogare" value="Delogheaza-te">
    </form>
</html>
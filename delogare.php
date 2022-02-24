<?php

session_start();

ini_set('log_errors', TRUE);
ini_set('error_log', './erori.txt');

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

if ($_SESSION['rol'] != Constants::ROL_CANDIDAT) {
    $_SESSION['rol'] = Constants::FARA_ROL;
    header('Location: http://localhost/hr/login.php');
} else {
    $_SESSION['rol'] = Constants::FARA_ROL;
    $_SESSION['id_candidat_logat'] = Constants::ID_CANDIDAT_DELOGAT;
    header('Location: http://localhost/hr/login_candidati.php');
}

?>
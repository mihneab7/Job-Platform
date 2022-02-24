<?php

session_start();

ini_set('log_errors', TRUE);
ini_set('error_log', './erori.txt');

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

require_once('dbconn_attempt.php');

if ($_SESSION['rol'] != Constants::ROL_ADMIN) {
    header('Location: http://localhost/hr/faraAcces.php');
}

$actualId = $_GET['delete'];

$sql = new sqlQuery('DELETE', '', false, '', 'conturi_test2', true, 'id = :actualId', false,
                    '', '', '');
$sql->buildQuery();
$statement = $conn->prepare($sql->getQuery());
$statement->execute(['actualId' => $actualId]);

header('Location: http://localhost/hr/lista_conturi.php');

?>
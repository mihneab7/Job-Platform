<?php

session_start();

ini_set('log_errors', TRUE);
ini_set('error_log', './erori.txt');

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

require_once('dbconn_attempt.php');

ob_start();

?>

<!DOCTYPE html>
<html lang="en">
<style>
    table, th, td {
        border: 1px solid black;
    }
</style>
<header>
    <h1>Toate joburile postate pe platforma</h1>
</header>

<?php

require_once('lista_joburi_continut.php');

if (isset($_GET['searchSubmit'])) {
    ob_end_clean();
    
    $sql = 'SELECT * FROM joburi_test WHERE tags LIKE "%' . $_GET['search'] . '%"';
    $queryResult = $conn->query($sql);
    $joburi = [];

    require_once('lista_joburi_continut2.php');

    $_GET['searchSubmit'] = '';
    $_GET['search'] = '';
}

?>
<?php

try {
    $instance = ConnectDb::getInstance();
    $conn = $instance->getConnection();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed! ' . $e->getMessage();
    die();
}
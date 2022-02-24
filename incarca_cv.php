<?php

ini_set('log_errors', TRUE);
ini_set('error_log', './erori.txt');

$filename = $_FILES['upload']['name'];
$destination  = 'uploads/' . $filename;
$file = $_FILES['upload']['tmp_name'];

if ($_FILES['upload']['size'] > 20_000_000) {
    echo 'File too large!';
} else {
    $size = $_FILES['upload']['size'];
    if (move_uploaded_file($file, $destination)) {
        $sql = 'INSERT INTO cvs (path, size, candidat_id) VALUES (:path, :size, :candidat_id)';
        $statement = $conn->prepare($sql);
        $statement->execute(['path' => $destination,
                             'size' => $size,
                             'candidat_id' => $candidat_id]);
    }
}

function incarcaCV($filename, $file, $size)
{
    $destination  = Constants::CALE_INCARCARE . $filename;

    if ($size > 20_971_520) {
        throw new Exception('Fisierul este prea mare.');
    } else {
        if (move_uploaded_file($file, $destination)) {
            $sql = 'INSERT INTO cvs (path, size, candidat_id) VALUES (:path, :size, :candidat_id)';
            $statement = $conn->prepare($sql);
            $statement->execute(['path' => $destination,
                                 'size' => $size,
                                 'candidat_id' => $candidat_id]);
        }
    }
}
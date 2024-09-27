<?php

    var_dump($_POST, $_REQUEST, file_get_contents("php://input"));
    $data = $_POST;
    $serializedData = serialize($data);

    $filename = __DIR__ . '/barcodes.txt';

    file_put_contents($filename, $serializedData, FILE_APPEND|LOCK_EX)
?>
 
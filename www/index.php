<?php
// Установка CORS-заголовков
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Accept");

// Обработка предзапросов CORS (OPTIONS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Обработка POST-запросов
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rawData = file_get_contents("php://input");
    $data = json_decode($rawData, true);
    
    if (isset($data['file'])) {
        $serializedData = serialize($data['file']);
        $filename = __DIR__ . '/barcodes.txt';
        
        if (file_put_contents($filename, $serializedData . PHP_EOL, FILE_APPEND | LOCK_EX)) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Data received']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Failed to write to file']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'No file data received']);
    }
} else {
    http_response_code(405); // Метод не разрешен
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
}
?>
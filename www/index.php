<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    // Проверьте, действительно ли вы получаете данные
    var_dump($data);
    // Обработка данных
    echo json_encode(['message' => 'POST-запрос обработан!', 'data' => $data]);
    exit();
}

// Если метод не поддерживается
http_response_code(405);
echo json_encode(['error' => 'Метод не разрешен']);
?>

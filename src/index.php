<?php

require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200); exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); exit;
}

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

socket_connect($socket, $_ENV['HOST'], $_ENV['PORT']);
socket_write($socket, file_get_contents('php://input'));

$result = json_decode( socket_read($socket, 2048), true );

socket_close($socket);

http_response_code($result['status'] !== 0 ? 400 : 200);

exit(json_encode([
    'error'   => $result['status'] !== 0,
    'message' => $result['status'] !== 0 ? 'Error sending command, check emulator console' : 'Your command has been successfully sent',
]));

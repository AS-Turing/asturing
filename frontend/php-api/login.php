<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;

$config = require __DIR__ . '/.env.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    http_response_code(200);
    exit();
}

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");

// Lecture des données d'entrée
$input = json_decode(file_get_contents('php://input'), true);
$password = htmlspecialchars(trim($input['password']));
$fingerprint = htmlspecialchars(trim($input['fingerPrint']));

// Vérification des credentials
$authorized = in_array($fingerprint, $config['ALLOWED_FINGERPRINTS'], true);
$isPasswordCorrect = password_verify($password, $config['ADMIN_PASSWORD']);

function sendResponse(int $statusCode, array $data): void {
    http_response_code($statusCode);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
}

if (!$isPasswordCorrect || !$authorized) {
    sendResponse(400, ['error' => 'Invalid credentials']);
}

// Génération du JWT
$payload = [
    'iss' => 'as-turing.fr',
    'exp' => time() + 3600,
    'sub' => 'admin'
];

$jwt = JWT::encode($payload, $config['JWT_SECRET'], 'HS256');

// Réponse en cas de succès
sendResponse(200, ['success' => true, 'token' => $jwt]);

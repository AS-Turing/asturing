<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;

$config = require __DIR__ . '/.env.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");

$input = json_decode(file_get_contents('php://input'), true);

$password = htmlspecialchars(trim($input["password"]));

if (!password_verify($password, $config["ADMIN_PASSWORD"])) {

    echo json_encode(['error' => 'Invalid credentials']);
    exit();
}

$payload = [
    'iss' => 'as-turing.fr',
    'exp' => time() + 3600,
    'sub' => 'admin'
];

$jwt = JWT::encode($payload, $config["JWT_SECRET"], 'HS256');

echo json_encode(['success' => true, 'token' => $jwt]);
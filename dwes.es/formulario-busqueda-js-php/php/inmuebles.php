<?php

header("Access-Control-Allow-Origin: *"); // Permitir solicitudes desde cualquier origen
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Métodos permitidos
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require_once "connection.php";

$data = json_decode(file_get_contents('php://input'), true);
$zona = isset($data['zona']) ? htmlspecialchars($data['zona']) : null;
$habitaciones = isset($data['habitaciones']) ? htmlspecialchars($data['habitaciones']) : null;
$precio = isset($data['precio']) ? htmlspecialchars($data['precio']) : null;


$jsondata["data"] = array();

try {
	$stmt = $pdo->prepare("SELECT * FROM `inmuebles` WHERE habitaciones=$habitaciones and precio<=$precio and zona=$zona");
	$stmt->execute();
	$jsondata["data"] = $stmt->fetchAll();
} catch (PDOException $e) {
	$jsondata["mensaje"] = $e;
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
$pdo = null;

exit();
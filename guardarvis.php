<?php
session_start();
require_once("database/conexion.php");
$db = new Database();
$con = $db->conectar();

try {
    $documento = $_POST['documento_usu'] ?? '';
    $tipo = $_POST['id_tipo_visitante'] ?? '';
    $fechavis = $_POST['fecha_visita'] ?? '';
    $entrada = $_POST['hora_entrada'] ?? '';

    if (!$documento || !$tipo || !$fechavis || !$entrada) {
        echo json_encode(['error' => 'Documento, tipo de visitante, fecha de visita y hora de entrada son obligatorios.']);
        exit;
    }

    $sql = "INSERT INTO visitas (documento_usu, id_tipo_visitante, fecha_visita, hora_entrada) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->execute([$documento, $tipo, $fechavis, $entrada]);

    echo json_encode(['message' => 'Visita registrada exitosamente']);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    exit;
}

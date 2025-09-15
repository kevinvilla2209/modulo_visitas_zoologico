<?php
session_start();
require_once("database/conexion.php");
$db = new Database();
$con = $db->conectar();

try {
    $documento = $_POST['documento'] ?? '';
    $nomb_usu = $_POST['nomb_usu'] ?? '';
    $apell_usu = $_POST['apell_usu'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $celular = $_POST['celular'] ?? '';

    if (!$documento || !$nomb_usu || !$apell_usu || !$correo || !$celular) {
        echo json_encode(['error' => 'Todos los campos son obligatorios.']);
        exit;
    }

    $stmt = $con->prepare("SELECT * FROM usuario WHERE documento = ?");
    $stmt->execute([$documento]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['error' => 'El documento ya existe.']);
        exit;
    }

    $sql = "INSERT INTO usuario (documento, nomb_usu, apell_usu, correo, celular) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->execute([$documento, $nomb_usu, $apell_usu, $correo, $celular]);

    echo json_encode(['message' => 'Usuario registrado exitosamente']);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    exit;
}

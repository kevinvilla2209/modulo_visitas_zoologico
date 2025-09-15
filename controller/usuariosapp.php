<?php
require_once("../database/conexion.php");
$db = new Database();
$con = $db->conectar();

try {
    $stmt = $con->prepare("SELECT documento, nomb_usu, apell_usu, correo, celular FROM usuario");
    $stmt->execute();
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($usuarios);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error en la base de datos']);
}

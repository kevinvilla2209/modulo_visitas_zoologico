<?php
require_once("../database/conexion.php");
$db = new Database();
$con = $db->conectar();

try {
    $stmt = $con->prepare("
    SELECT 
        visitas.documento_usu,
        tipo_visitante.nomb_tipo_visitante,
        visitas.fecha_visita,
        visitas.hora_entrada
    FROM visitas
    JOIN tipo_visitante ON visitas.id_tipo_visitante = tipo_visitante.id_tipo_visitante
    ORDER BY visitas.fecha_visita ASC
    ");
    $stmt->execute();
    $visitas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($visitas);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error en la base de datos']);
}

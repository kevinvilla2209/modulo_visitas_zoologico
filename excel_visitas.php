<?php
require('database/conexion.php');
$db = new Database();
$con = $db->conectar();


if (isset($_FILES['datosvis'])) {
    $tipo = $_FILES['datosvis']['type'];
    $tamano = $_FILES['datosvis']['size'];
    $archivotmp = $_FILES['datosvis']['tmp_name'];
    $lineas = file($archivotmp);

    $i = 0;

    foreach ($lineas as $i => $linea) {
        if ($i == 0) continue;

        $datos = explode(";", trim($linea));

        $documento = !empty($datos[0]) ? trim($datos[0]) : '';
        $tipo = !empty($datos[1]) ? trim($datos[1]) : '';
        $visita = !empty($datos[2]) ? trim($datos[2]) : '';
        $entrada = !empty($datos[3]) ? trim($datos[3]) : '';

        if (!empty($documento)) {
            $stmt = $con->prepare("SELECT COUNT(*) FROM usuario WHERE documento = ?");
            $stmt->execute([$documento]);
            $existe = $stmt->fetchColumn();

            if ($existe > 0) {
                $insert = $con->prepare("INSERT INTO visitas (documento_usu, id_tipo_visitante, fecha_visita, hora_entrada) VALUES (?, ?, ?, ?)");
                $insert->execute([$documento, $tipo, $visita, $entrada]);
            }
        }
    }

    echo "Importación Excel finalizada correctamente.";
} else {
    echo "No se recibió ningún archivo.";
}

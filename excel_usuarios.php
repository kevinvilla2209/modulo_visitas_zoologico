<?php
require('database/conexion.php');
$db = new Database();
$con = $db->conectar();


if (isset($_FILES['datosusu'])) {
    $tipo = $_FILES['datosusu']['type'];
    $tamano = $_FILES['datosusu']['size'];
    $archivotmp = $_FILES['datosusu']['tmp_name'];
    $lineas = file($archivotmp);

    $i = 0;

    foreach ($lineas as $i => $linea) {
        if ($i == 0) continue;

        $datos = explode(";", trim($linea));

        $documento = !empty($datos[0]) ? trim($datos[0]) : '';
        $nombre = !empty($datos[1]) ? trim($datos[1]) : '';
        $apellido = !empty($datos[2]) ? trim($datos[2]) : '';
        $correo = !empty($datos[3]) ? trim($datos[3]) : '';
        $celular = !empty($datos[4]) ? trim($datos[4]) : '';

        if (!empty($documento)) {
            $stmt = $con->prepare("SELECT COUNT(*) FROM usuario WHERE documento = ?");
            $stmt->execute([$documento]);
            $existe = $stmt->fetchColumn();

            if ($existe == 0) {
                $insert = $con->prepare("INSERT INTO usuario (documento, nomb_usu, apell_usu, correo, celular) VALUES (?, ?, ?, ?, ?)");
                $insert->execute([$documento, $nombre, $apellido, $correo, $celular]);
            } else {
                $update = $con->prepare("UPDATE usuario SET nomb_usu = ?, apell_usu = ?, correo = ?, celular = ? WHERE documento = ?");
                $update->execute([$nombre, $apellido, $correo, $celular, $documento]);
            }
        }
    }

    echo "Importación Excel finalizada correctamente.";
} else {
    echo "No se recibió ningún archivo.";
}

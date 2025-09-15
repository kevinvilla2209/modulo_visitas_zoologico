<?php
require_once("database/conexion.php");
$db = new Database();
$con = $db->conectar();

try {
    $stmt = $con->prepare("SELECT id_tipo_visitante, nomb_tipo_visitante FROM tipo_visitante");
    $stmt->execute();
    $tipos_visitante = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error al obtener tipos de visitante: " . $e->getMessage();
    $tipos_visitante = [];
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo de Visitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="controller/css/css1.css">
</head>

<body class="bg-light">

    <header>
        <img src="controller/image/tickets.png" alt="visitasicon">
        <div>
            <h1>Visitas</h1>
            <p>Registrar, cargar y consultar las visitas al Zoologico</p>
        </div>

        <a class="volver" href="modulo.php">
            <i class="bi bi-arrow-left-circle"></i> Volver
        </a>
    </header>

    <div class="container py-4">
        <div class="card shadow mb-4">
            <div class="card-header bg-success text-white">
                <i class="bi bi-ticket-perforated"></i> Registro Manual de Visitas
            </div>

            <div class="card-body">

                <form id="formvis" method="POST" autocomplete="off">

                    <div class="mb-3">
                        <select name="documento_usu" id="documento_usu" class="form-select" required>
                            <option value="">Seleccione un documento</option>
                            <?php
                            $usuarios = $con->query("SELECT documento, nomb_usu, apell_usu FROM usuario")->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($usuarios as $usuario) {
                                echo "<option value='{$usuario['documento']}'>{$usuario['documento']} - {$usuario['nomb_usu']} {$usuario['apell_usu']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="id_tipo_visitante" class="form-label">Tipo de Visitante</label>
                        <select class="form-control" name="id_tipo_visitante" id="id_tipo_visitante" required>
                            <option value="">Seleccione una opción</option>

                            <?php foreach ($tipos_visitante as $tipo): ?>
                                <option value="<?= htmlspecialchars($tipo['id_tipo_visitante']) ?>">
                                    <?= htmlspecialchars($tipo['nomb_tipo_visitante']) ?>
                                </option>
                            <?php endforeach; ?>

                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_visita" class="form-label"> Fecha Visita </label>
                        <input type="date" class="form-control" name="fecha_visita" id="fecha_visita" required>
                    </div>

                    <div class="mb-3">
                        <label for="hora_entrada" class="form-label"> Hora Entrada </label>
                        <input type="time" class="form-control" name="hora_entrada" id="hora_entrada" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Guardar</button>
                </form>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header bg-success text-white">
                <i class="bi bi-file-earmark-excel-fill"></i> Registro con archivo tipo Excel
            </div>

            <div class="card-body text-center">

                <form id="form-excel" enctype="multipart/form-data">
                    <div class="mb-3">
                        <input type="file" name="datosvis" id="excelvis" class="form-control" required>
                    </div>
                    <button type="submit" name="subir" class="btn btn-success">
                        Subir datos con Excel
                    </button>
                </form>

            </div>
        </div>

        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <i class="bi bi-geo-alt"></i> Lista de Visitas
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-success">
                        <tr>
                            <th>Documento</th>
                            <th>Tipo</th>
                            <th>Fecha Visita</th>
                            <th>Hora Entrada</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-visitas">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const form = document.getElementById('formvis');
        form.addEventListener('submit', async function(event) {
            event.preventDefault();

            const formData = new FormData();
            formData.append('documento_usu', document.getElementById('documento_usu').value);
            formData.append('id_tipo_visitante', document.getElementById('id_tipo_visitante').value);
            formData.append('fecha_visita', document.getElementById('fecha_visita').value);
            formData.append('hora_entrada', document.getElementById('hora_entrada').value);

            try {
                const response = await fetch('guardarvis.php', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();

                if (result.message) {
                    alert(result.message);
                    limpiarformulario();
                    location.reload();
                } else if (result.error) {
                    alert(result.error);
                }
            } catch (error) {
                console.error(error);
                alert('Error al conectar con el servidor');
            }

            function limpiarformulario() {
                document.getElementById('documento_usu').value = '';
                document.getElementById('id_tipo_visitante').value = '';
                document.getElementById('fecha_visita').value = '';
                document.getElementById('hora_entrada').value = '';
            }
        });



        async function cargarVisitas() {
            try {
                const response = await fetch('controller/visitasapp.php');
                const usuarios = await response.json();

                const tbody = document.getElementById('tabla-visitas');
                tbody.innerHTML = '';

                if (usuarios.length > 0) {
                    usuarios.forEach(usuario => {
                        const fila = `
                        <tr>
                            <td>${usuario.documento_usu}</td>
                            <td>${usuario.nomb_tipo_visitante}</td>
                            <td>${usuario.fecha_visita}</td>
                            <td>${usuario.hora_entrada}</td>
                        </tr>
                    `;
                        tbody.innerHTML += fila;
                    });
                } else {
                    tbody.innerHTML = `<tr><td colspan="5" class="text-center">No hay registros disponibles.</td></tr>`;
                }

            } catch (error) {
                console.error("Error cargando usuarios:", error);
            }
        }

        document.addEventListener('DOMContentLoaded', cargarVisitas);



        const formExcel = document.getElementById('form-excel');

        formExcel.addEventListener('submit', async function(event) {
            event.preventDefault();

            const archivo = document.getElementById('excelvis').files[0];
            if (!archivo) {
                alert('Por favor, seleccione un archivo.');
                return;
            }

            const formData = new FormData();
            formData.append('datosvis', archivo);

            try {
                const response = await fetch('excel_visitas.php', {
                    method: 'POST',
                    body: formData
                });

                const resultado = await response.text();
                alert(resultado);
                location.reload();
            } catch (error) {
                console.error('Error al subir el archivo:', error);
                alert('Hubo un error al subir el archivo.');
            }
        });
    </script>

</body>

</html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="controller/css/css1.css">
</head>

<body class="bg-light">

    <header>
        <img src="controller/image/usuario.png" alt="usuariosicon">
        <div>
            <h1>Usuarios</h1>
            <p>Registrar, cargar y consultar usuarios</p>
        </div>

        <a class="volver" href="modulo.php">
            <i class="bi bi-arrow-left-circle"></i> Volver
        </a>
    </header>

    <div class="container py-4">
        <div class="card shadow mb-4">
            <div class="card-header bg-success text-white">
                <i class="bi bi-person-plus-fill"></i> Registro Manual de Usuarios
            </div>

            <div class="card-body">

                <form id="form" method="POST" autocomplete="off">

                    <div class="mb-3">
                        <label for="documento" class="form-label"> Documento </label>
                        <input type="number" class="form-control" name="documento" id="documento" placeholder="Ingrese documento" required>
                    </div>

                    <div class="mb-3">
                        <label for="nombre" class="form-label"> Nombres </label>
                        <input type="text" class="form-control" name="nomb_usu" id="nomb_usu" placeholder="Ingrese nombre/s" required>
                    </div>

                    <div class="mb-3">
                        <label for="apellido" class="form-label"> Apellido </label>
                        <input type="text" class="form-control" name="apell_usu" id="apell_usu" placeholder="Ingrese apellido/s" required>
                    </div>

                    <div class="mb-3">
                        <label for="correo" class="form-label"> Correo </label>
                        <input type="email" class="form-control" name="correo" id="correo" placeholder="Ingrese correo" required>
                    </div>

                    <div class="mb-3">
                        <label for="celular" class="form-label"> Celular </label>
                        <input type="number" class="form-control" name="celular" id="celular" placeholder="Ingrese celular" required>
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
                        <input type="file" name="datosusu" id="excel" class="form-control" required>
                    </div>
                    <button type="submit" name="subir" class="btn btn-success">
                        Subir datos con Excel
                    </button>
                </form>

            </div>
        </div>

        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <i class="bi bi-people-fill"></i> Lista de Usuarios
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-success">
                        <tr>
                            <th>Documento</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Celular</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-usuarios">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const form = document.getElementById('form');
        form.addEventListener('submit', async function(event) {
            event.preventDefault();

            const formData = new FormData();
            formData.append('documento', document.getElementById('documento').value);
            formData.append('nomb_usu', document.getElementById('nomb_usu').value);
            formData.append('apell_usu', document.getElementById('apell_usu').value);
            formData.append('correo', document.getElementById('correo').value);
            formData.append('celular', document.getElementById('celular').value);

            try {
                const response = await fetch('guardarusu.php', {
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
                document.getElementById('documento').value = '';
                document.getElementById('nomb_usu').value = '';
                document.getElementById('apell_usu').value = '';
                document.getElementById('correo').value = '';
                document.getElementById('celular').value = '';
            }
        });



        async function cargarUsuarios() {
            try {
                const response = await fetch('controller/usuariosapp.php');
                const usuarios = await response.json();

                const tbody = document.getElementById('tabla-usuarios');
                tbody.innerHTML = '';

                if (usuarios.length > 0) {
                    usuarios.forEach(usuario => {
                        const fila = `
                        <tr>
                            <td>${usuario.documento}</td>
                            <td>${usuario.nomb_usu}</td>
                            <td>${usuario.apell_usu}</td>
                            <td>${usuario.correo}</td>
                            <td>${usuario.celular}</td>
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

        document.addEventListener('DOMContentLoaded', cargarUsuarios);



        const formExcel = document.getElementById('form-excel');

        formExcel.addEventListener('submit', async function(event) {
            event.preventDefault();

            const archivo = document.getElementById('excel').files[0];
            if (!archivo) {
                alert('Por favor, seleccione un archivo.');
                return;
            }

            const formData = new FormData();
            formData.append('datosusu', archivo);

            try {
                const response = await fetch('excel_usuarios.php', {
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
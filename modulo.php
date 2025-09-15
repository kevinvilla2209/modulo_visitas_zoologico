<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo de Visitas y Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="controller/css/css1.css">
</head>

<body>
    
    <header>
        <img src="controller/image/zoo.png" alt="animal-zoo">
        <h1>Bienvenido al Zoológico</h1>
        <p>Módulo de Visitas y Usuarios</p>
        
        <a class="volver" href="index.html">
            <i class="bi bi-box-arrow-left"></i> Salir
        </a>
    </header>

    <main class="container">
        <div class="row justify-content-center g-4">

            <div class="col-md-5">
                <div class="opcion">
                    <img src="controller/image/visitas.png" alt="visitas">
                    <h3>Registro de Visitas</h3>
                    <p>Ingresa nuevas visitas y revisa el historial completo.</p>
                    <a href="visitas.php" class="btn btn-zoo">Ingresar</a>
                </div>
            </div>

            <div class="col-md-5">
                <div class="opcion">
                    <img src="controller/image/usuario.png" alt="usuarios">
                    <h3>Registro de Usuarios</h3>
                    <p>Agrega nuevos usuarios y consulta el historial registrado.</p>
                    <a href="usuarios.php" class="btn btn-zoo">Ingresar</a>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
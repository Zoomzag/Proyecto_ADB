<!DOCTYPE html>
<!--http://localhost/PROYECTO/PHP/mostrar.php-->
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Películas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #141e30, #243b55);
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .table-container {
            background-color: rgba(255, 255, 255, 0.05);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
        }
        .form-control, .btn {
            border-radius: 10px;
        }
        .form-label {
            margin-bottom: 0.3rem;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="table-container">
            <h1 class="text-center mb-4">🎬 Listado de Películas</h1>

            <?php
            include("conexion.php");

            $sql = "SELECT p.id_pelicula, p.nombre AS titulo, p.puntuacion, p.fecha_estreno, p.recaudacion,
                           c.nombre AS categoria, i.nombre AS idioma
                    FROM pelicula p
                    LEFT JOIN categoria c ON p.id_categoria = c.id_categoria
                    LEFT JOIN idioma i ON p.id_idioma = i.id_idioma";

            $result = $conn->query($sql);
            ?>

            <table class="table table-dark table-hover table-bordered text-white">
                <thead>
                    <tr>
                        <th>ID</th><th>Nombre</th><th>Puntuación</th><th>Fecha de Estreno</th>
                        <th>Recaudación</th><th>Categoría</th><th>Idioma</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id_pelicula'] ?></td>
                        <td><?= $row['titulo'] ?></td>
                        <td><?= $row['puntuacion'] ?></td>
                        <td><?= $row['fecha_estreno'] ?></td>
                        <td>$<?= $row['recaudacion'] ?></td>
                        <td><?= $row['categoria'] ?></td>
                        <td><?= $row['idioma'] ?></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>

            <h3 class="mt-5">➕ Agregar Nueva Película</h3>
            <form method="POST" action="insertar.php" class="row g-3 mt-3">
                <div class="col-md-6">
                    <label class="form-label">Nombre:</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Puntuación:</label>
                    <input type="number" step="0.1" name="puntuacion" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Fecha estreno:</label>
                    <input type="date" name="fecha_estreno" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Recaudación:</label>
                    <input type="number" step="0.01" name="recaudacion" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Categoría:</label>
                    <input type="text" name="categoria" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Idioma:</label>
                    <input type="text" name="idioma" class="form-control" required>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-success px-5">Agregar Película</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<?php
require_once("C://laragon/www/CRUD_APRENDICES/views/head/header.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Aprendices</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4">Listado de Aprendices</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Documento</th>
                <th>Programa de Formación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $contador = 1; ?>
            <?php foreach ($aprendices as $aprendiz): ?>
                <tr>
                    <td><?= $contador++ ?></td>
                    <td><?= $aprendiz['primer_nombre'] . ' ' . $aprendiz['primer_apellido'] ?></td>
                    <td><?= $aprendiz['tipo_documento'] . ' ' . $aprendiz['documento'] ?></td>
                    <td><?= $aprendiz['nombre_programa'] ?></td>
                    <td>
                        <a href="ver_aprendiz.php?id=<?= $aprendiz['id_aprendiz'] ?>" class="btn btn-info btn-sm" title="Ver más">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="editar_aprendiz.php?id=<?= $aprendiz['id_aprendiz'] ?>" class="btn btn-warning btn-sm" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="eliminar_aprendiz.php?id=<?= $aprendiz['id_aprendiz'] ?>" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este aprendiz?')">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>   
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

</body>
</html>


<?php
require_once("C://laragon/www/CRUD_APRENDICES/views/head/footer.php");
?>
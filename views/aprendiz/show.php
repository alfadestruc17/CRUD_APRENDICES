<?php
require_once("C://laragon/www/CRUD_APRENDICES/views/head/header.php");
require_once __DIR__ . '/../../database/conexion.php';

$conexion = database::conexion();

$sql = "SELECT 
            a.id AS id_aprendiz,
            p.primer_nombre,
            p.primer_apellido,
            p.documento,
            pf.nombre
        FROM aprendices a
        INNER JOIN personas p ON a.id_persona = p.id
        INNER JOIN aprendiz_programa apf ON apf.id_aprendiz = a.id
        INNER JOIN programa_de_formacion pf ON apf.id_programa_ficha = pf.id";

$stmt = $conexion->prepare($sql);
$stmt->execute();
$aprendices = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                <?php
                $contador = 1;
                foreach ($aprendices as $row):
                    $id = $row['id_aprendiz'];
                    $nombre = $row['primer_nombre'] . " " . $row['primer_apellido'];
                    $documento = $row['documento'];
                    $programa = $row['nombre'];
                ?>
                    <tr>
                        <td><?= $contador++ ?></td>
                        <td><?= htmlspecialchars($nombre) ?></td>
                        <td><?= htmlspecialchars($documento) ?></td>
                        <td><?= htmlspecialchars($programa) ?></td>
                        <td>
                            <a href="ver.php?id=<?= $id ?>" class="btn btn-info btn-sm">
                            <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="edit.php?id=<?= $id ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> 
                            </a>
                            <a href="delete.php?id=<?= $id ?>" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> 
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
<?php if (isset($_GET['msg']) && $_GET['msg'] == 'actualizado'): ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    Swal.fire({
      icon: 'success',
      title: '¡Actualización exitosa!',
      showConfirmButton: false,
      timer: 2000
    });
  </script>
<?php endif; ?>

</html>

<?php
require_once("C://laragon/www/CRUD_APRENDICES/views/head/footer.php");
?>
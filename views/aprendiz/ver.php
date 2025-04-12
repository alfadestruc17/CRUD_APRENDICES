<?php
require_once("../../database/conexion.php");
require_once("../head/header.php");

$conexion = database::conexion();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<div class='alert alert-danger m-4'>ID de aprendiz no proporcionado.</div>";
    exit;
}

$id_aprendiz = $_GET['id'];

$sql = "SELECT 
            p.documento,
            p.primer_nombre,
            p.segundo_nombre,
            p.primer_apellido,
            p.segundo_apellido,
            td.nombre AS tipo_documento,
            g.tipo AS genero,
            gs.grupo AS grupo_sanguineo,
            fs.factor AS factor_sanguineo,
            pf.nombre
        FROM aprendices a
        INNER JOIN personas p ON a.id_persona = p.id
        INNER JOIN tipo_documento td ON p.id_tipo_documento = td.id
        INNER JOIN genero g ON p.id_genero = g.id
        INNER JOIN grupo_sanguineo gs ON p.id_grupo_sanguineo = gs.id
        INNER JOIN factor_sanguineo fs ON p.id_factor_sanguineo = fs.id
        INNER JOIN aprendiz_programa apf ON apf.id_aprendiz = a.id
        INNER JOIN programa_de_formacion pf ON apf.id_programa_ficha = pf.id
        WHERE a.id = :id";

$stmt = $conexion->prepare($sql);
$stmt->bindParam(':id', $id_aprendiz, PDO::PARAM_INT);
$stmt->execute();
$aprendiz = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$aprendiz) {
    echo "<div class='alert alert-warning m-4'>Aprendiz no encontrado.</div>";
    exit;
}
?>

<div class="container mt-5">
    <h2>Información del Aprendiz</h2>
    <table class="table table-bordered mt-3">
        <tr><th>Documento</th><td><?= htmlspecialchars($aprendiz['documento']) ?></td></tr>
        <tr><th>Tipo de documento</th><td><?= htmlspecialchars($aprendiz['tipo_documento']) ?></td></tr>
        <tr><th>Primer Nombre</th><td><?= htmlspecialchars($aprendiz['primer_nombre']) ?></td></tr>
        <tr><th>Segundo Nombre</th><td><?= htmlspecialchars($aprendiz['segundo_nombre']) ?></td></tr>
        <tr><th>Primer Apellido</th><td><?= htmlspecialchars($aprendiz['primer_apellido']) ?></td></tr>
        <tr><th>Segundo Apellido</th><td><?= htmlspecialchars($aprendiz['segundo_apellido']) ?></td></tr>
        <tr><th>Género</th><td><?= htmlspecialchars($aprendiz['genero']) ?></td></tr>
        <tr><th>Grupo Sanguíneo</th><td><?= htmlspecialchars($aprendiz['grupo_sanguineo']) ?></td></tr>
        <tr><th>Factor Sanguíneo</th><td><?= htmlspecialchars($aprendiz['factor_sanguineo']) ?></td></tr>
        <tr><th>Programa de Formación</th><td><?= htmlspecialchars($aprendiz['nombre']) ?></td></tr>
    </table>
    <div center>
    <a href="show.php" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Volver</a>
    </div>
</div>

<?php require_once("../head/footer.php"); ?>

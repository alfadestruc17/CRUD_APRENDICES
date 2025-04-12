<?php
require_once("../../database/conexion.php");
require_once("../head/header.php");

$conexion = database::conexion();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<div class='alert alert-danger m-4'>ID no proporcionado.</div>";
    exit;
}

$id_aprendiz = $_GET['id'];

$sql = "SELECT 
            a.id AS id_aprendiz,
            p.id AS id_persona,
            p.documento,
            p.primer_nombre,
            p.segundo_nombre,
            p.primer_apellido,
            p.segundo_apellido,
            p.id_tipo_documento,
            p.id_genero,
            p.id_grupo_sanguineo,
            p.id_factor_sanguineo
        FROM aprendices a
        INNER JOIN personas p ON a.id_persona = p.id
        WHERE a.id = :id";

$stmt = $conexion->prepare($sql);
$stmt->bindParam(":id", $id_aprendiz, PDO::PARAM_INT);
$stmt->execute();
$aprendiz = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$aprendiz) {
    echo "<div class='alert alert-warning m-4'>Aprendiz no encontrado.</div>";
    exit;
}


$tipos_documento = $conexion->query("SELECT * FROM tipo_documento")->fetchAll(PDO::FETCH_ASSOC);
$generos = $conexion->query("SELECT * FROM genero")->fetchAll(PDO::FETCH_ASSOC);
$grupos_sangre = $conexion->query("SELECT * FROM grupo_sanguineo")->fetchAll(PDO::FETCH_ASSOC);
$factores_sangre = $conexion->query("SELECT * FROM factor_sanguineo")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
    <h2>Editar información del aprendiz</h2>
    <form action="update.php" method="POST" class="mt-4">
        <input type="hidden" name="id_persona" value="<?= $aprendiz['id_persona'] ?>">

        <div class="mb-3">
            <label>Documento</label>
            <input type="number" class="form-control" value="<?= $aprendiz['documento'] ?>" disabled>
        </div>

        <div class="mb-3">
            <label>Primer Nombre</label>
            <input type="text" name="primer_nombre" class="form-control" value="<?= $aprendiz['primer_nombre'] ?>" required>
        </div>

        <div class="mb-3">
            <label>Segundo Nombre</label>
            <input type="text" name="segundo_nombre" class="form-control" value="<?= $aprendiz['segundo_nombre'] ?>">
        </div>

        <div class="mb-3">
            <label>Primer Apellido</label>
            <input type="text" name="primer_apellido" class="form-control" value="<?= $aprendiz['primer_apellido'] ?>" required>
        </div>

        <div class="mb-3">
            <label>Segundo Apellido</label>
            <input type="text" name="segundo_apellido" class="form-control" value="<?= $aprendiz['segundo_apellido'] ?>">
        </div>

        <div class="mb-3">
            <label>Tipo de Documento</label>
            <select name="id_tipo_documento" class="form-select" required>
                <option value="">Seleccione...</option>
                <?php foreach ($tipos_documento as $tipo): ?>
                    <option value="<?= $tipo['id'] ?>" <?= $aprendiz['id_tipo_documento'] == $tipo['id'] ? 'selected' : '' ?>>
                        <?= $tipo['nombre'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Sexo</label>
            <select name="id_genero" class="form-select" required>
                <option value="">Seleccione...</option>
                <?php foreach ($generos as $genero): ?>
                    <option value="<?= $genero['id'] ?>" <?= $aprendiz['id_genero'] == $genero['id'] ? 'selected' : '' ?>>
                        <?= $genero['tipo'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Grupo Sanguíneo</label>
            <select name="id_grupo_sanguineo" class="form-select" required>
                <option value="">Seleccione...</option>
                <?php foreach ($grupos_sangre as $grupo): ?>
                    <option value="<?= $grupo['id'] ?>" <?= $aprendiz['id_grupo_sanguineo'] == $grupo['id'] ? 'selected' : '' ?>>
                        <?= $grupo['grupo'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Factor Sanguíneo</label>
            <select name="id_factor_sanguineo" class="form-select" required>
                <option value="">Seleccione...</option>
                <?php foreach ($factores_sangre as $factor): ?>
                    <option value="<?= $factor['id'] ?>" <?= $aprendiz['id_factor_sanguineo'] == $factor['id'] ? 'selected' : '' ?>>
                        <?= $factor['factor'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar cambios</button>
        <a href="show.php" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Volver</a>
    </form>
</div>

<?php require_once("../head/footer.php"); ?>
<?php
require_once("C://laragon/www/CRUD_APRENDICES/views/head/header.php");
?>

<?php
require_once '../../model/Catalogos.php';
$catalogo = new Catalogos();

$tipos_documento = $catalogo->obtener('tipo_documento');
$generos = $catalogo->obtener('genero');
$grupos_sangre = $catalogo->obtener('grupo_sanguineo');
$factores_sangre = $catalogo->obtener('factor_sanguineo');
$programas = $catalogo->obtener('programa_de_formacion');
?>

<form action="../../controller/aprendiz_controller.php" method="POST">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<form id="formAprendiz" action="../../controller/aprendiz_controller.php" method="POST" class="container mt-4 needs-validation" novalidate>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Primer nombre</label>
            <input type="text" name="primer_nombre" class="form-control" required>
            <div class="invalid-feedback">Este campo es obligatorio.</div>
        </div>

    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Segundo nombre</label>
            <input type="text" name="segundo_nombre" class="form-control" required>
            <div class="invalid-feedback">Este campo es obligatorio.</div>
        </div>

    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Primer apellido</label>
            <input type="text" name="primer_apellido" class="form-control" required>
            <div class="invalid-feedback">Este campo es obligatorio.</div>
        </div>

    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">segundo apellido</label>
            <input type="text" name="segundo_apellido" class="form-control" required>
            <div class="invalid-feedback">Este campo es obligatorio.</div>
        </div>

    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Documento</label>
            <input type="number" name="documento" class="form-control" required>
            <div class="invalid-feedback">Este campo es obligatorio.</div>
        </div>

        <div class="col-md-6">
            <label class="form-label">Tipo de documento</label>
            <select name="id_tipo_documento" class="form-select" required>
                <option value="">Seleccione...</option>
                <?php foreach ($tipos_documento as $tipo): ?>
                    <option value="<?= $tipo['id'] ?>"><?= $tipo['nombre'] ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Seleccione un tipo de documento.</div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Sexo</label>
            <select name="id_genero" class="form-select" required>
                <option value="">Seleccione...</option>
                <?php foreach ($generos as $genero): ?>
                    <option value="<?= $genero['id'] ?>"><?= $genero['tipo'] ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Seleccione una opción.</div>
        </div>

        <div class="col-md-6">
            <label class="form-label">Grupo sanguíneo</label>
            <select name="id_grupo_sanguineo" class="form-select" required>
                <option value="">Seleccione...</option>
                <?php foreach ($grupos_sangre as $grupo): ?>
                    <option value="<?= $grupo['id'] ?>"><?= $grupo['grupo'] ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Seleccione un grupo sanguíneo.</div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Factor sanguíneo</label>
            <select name="id_factor_sanguineo" class="form-select" required>
                <option value="">Seleccione...</option>
                <?php foreach ($factores_sangre as $factor): ?>
                    <option value="<?= $factor['id'] ?>"><?= $factor['factor'] ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Seleccione un factor.</div>
        </div>

        <div class="col-md-6">
            <label class="form-label">Programa de formación</label>
            <select name="id_programa" class="form-select" required>
                <option value="">Seleccione...</option>
                <?php foreach ($programas as $programa): ?>
                    <option value="<?= $programa['id'] ?>"><?= $programa['nombre'] ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Seleccione un programa.</div>
        </div>
    </div>


    <div class="d-grid">
        <button type="submit" class="btn btn-primary">Crear</button>
    </div>
</form>

<?php
require_once "C://laragon/www/CRUD_APRENDICES/views/head/footer.php";
?>
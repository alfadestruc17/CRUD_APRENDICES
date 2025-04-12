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
  <div>
    <label >Primer nombre</label>
    <input type="text" name="primer_nombre" required>
  </div>
  <div>
    <label>Segundo nombre</label>
    <input type="text" name="segundo_nombre">
  </div>
  <div>
    <label>Primer apellido</label>
    <input type="text" name="primer_apellido" required>
  </div>
  <div>
    <label>Segundo apellido</label>
    <input type="text" name="segundo_apellido">
  </div>
  <div>
    <label>Documento</label>
    <input type="number" name="documento" required>
  </div>

  <div>
    <label>Tipo de documento</label>
    <select name="id_tipo_documento" required>
      <option value="">Seleccione...</option>
      <?php foreach ($tipos_documento as $tipo): ?>
        <option value="<?= $tipo['id'] ?>"><?= $tipo['nombre'] ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div>
    <label>Sexo</label>
    <select name="id_genero" required>
      <option value="">Seleccione...</option>
      <?php foreach ($generos as $genero): ?>
        <option value="<?= $genero['id'] ?>"><?= $genero['tipo'] ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div>
    <label>Grupo sanguíneo</label>
    <select name="id_grupo_sanguineo" required>
      <option value="">Seleccione...</option>
      <?php foreach ($grupos_sangre as $grupo): ?>
        <option value="<?= $grupo['id'] ?>"><?= $grupo['grupo'] ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div>
    <label>Factor sanguíneo</label>
    <select name="id_factor_sanguineo" required>
      <option value="">Seleccione...</option>
      <?php foreach ($factores_sangre as $factor): ?>
        <option value="<?= $factor['id'] ?>"><?= $factor['factor'] ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div>
    <label>Programa de formación</label>
    <select name="id_programa" required>
      <option value="">Seleccione...</option>
      <?php foreach ($programas as $programa): ?>
        <option value="<?= $programa['id'] ?>"><?= $programa['nombre'] ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <button type="submit">Guardar</button>
</form>





<?php
require_once "C://laragon/www/CRUD_APRENDICES/views/head/footer.php";
?>
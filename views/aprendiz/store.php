<?php
require_once '../model/aprendiz.php'; // Asegúrate de que la ruta sea correcta

$aprendiz = new Aprendiz();

// Validación básica
if (
    isset($_POST['primer_nombre']) &&
    isset($_POST['primer_apellido']) &&
    isset($_POST['documento']) &&
    isset($_POST['id_tipo_documento']) &&
    isset($_POST['id_genero']) &&
    isset($_POST['id_grupo_sanguineo']) &&
    isset($_POST['id_factor_sanguineo']) &&
    isset($_POST['id_programa'])
) {
    $datosPersona = [
        'primer_nombre'      => $_POST['primer_nombre'],
        'segundo_nombre'     => $_POST['segundo_nombre'] ?? null,
        'primer_apellido'    => $_POST['primer_apellido'],
        'segundo_apellido'   => $_POST['segundo_apellido'] ?? null,
        'documento'          => $_POST['documento'],
        'id_tipo_documento'  => $_POST['id_tipo_documento'],
        'id_genero'          => $_POST['id_genero'],
        'id_grupo_sanguineo' => $_POST['id_grupo_sanguineo'],
        'id_factor_sanguineo'=> $_POST['id_factor_sanguineo']
    ];

    $id_persona = $aprendiz->insertarPersona($datosPersona);

    if ($id_persona) {

        $id_aprendiz = $aprendiz->insertarAprendiz($id_persona);

        if ($id_aprendiz) {

            $aprendiz->asociarPrograma($id_aprendiz, $_POST['id_programa']);

            header('Location: c:/laragon/www/CRUD_APRENDICES/index.php');
        } else {
            echo "Error al guardar aprendiz.";
        }
    } else {
        echo "Error al guardar persona.";
    }
} else {
    echo "Faltan campos obligatorios.";
}
?>

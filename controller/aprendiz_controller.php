<?php
require_once '../model/Aprendiz.php';
require_once '../../views/aprendiz/show.php'; 

$aprendiz = new Aprendiz();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['primer_nombre']) && !empty($_POST['documento']) && isset($_POST['id_programa'])) {
        $datosPersona = [
            'primer_nombre'      => $_POST['primer_nombre'],
            'segundo_nombre'     => $_POST['segundo_nombre'] ?? null,
            'primer_apellido'    => $_POST['primer_apellido'],
            'segundo_apellido'   => $_POST['segundo_apellido'] ?? null,
            'documento'          => $_POST['documento'],
            'id_tipo_documento'  => $_POST['id_tipo_documento'],
            'id_grupo_sanguineo' => $_POST['id_grupo_sanguineo'],
            'id_factor_sanguineo'=> $_POST['id_factor_sanguineo'],
            'id_genero'          => $_POST['id_genero']
        ];

        $id_persona = $aprendiz->insertarPersona($datosPersona);
        $id_aprendiz = $aprendiz->insertarAprendiz($id_persona);
        $aprendiz->asociarPrograma($id_aprendiz, $_POST['id_programa']);

        header('Location: /CRUD_APRENDICES/views/aprendiz/show.php');
    } else {
        echo "Todos los campos son obligatorios.";
    }
}

$aprendiz = new Aprendiz();
$aprendices = $aprendiz->obtenerAprendices(); 





<?php
require_once("../../database/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_persona = $_POST["id_persona"];
    $primer_nombre = $_POST["primer_nombre"];
    $segundo_nombre = $_POST["segundo_nombre"];
    $primer_apellido = $_POST["primer_apellido"];
    $segundo_apellido = $_POST["segundo_apellido"];
    $id_tipo_documento = $_POST["id_tipo_documento"];
    $id_genero = $_POST["id_genero"];
    $id_grupo_sanguineo = $_POST["id_grupo_sanguineo"];
    $id_factor_sanguineo = $_POST["id_factor_sanguineo"];

    try {
        $conexion = database::conexion();

        $sql = "UPDATE personas SET 
                    primer_nombre = :primer_nombre,
                    segundo_nombre = :segundo_nombre,
                    primer_apellido = :primer_apellido,
                    segundo_apellido = :segundo_apellido,
                    id_tipo_documento = :id_tipo_documento,
                    id_genero = :id_genero,
                    id_grupo_sanguineo = :id_grupo_sanguineo,
                    id_factor_sanguineo = :id_factor_sanguineo
                WHERE id = :id_persona";

        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':primer_nombre', $primer_nombre);
        $stmt->bindParam(':segundo_nombre', $segundo_nombre);
        $stmt->bindParam(':primer_apellido', $primer_apellido);
        $stmt->bindParam(':segundo_apellido', $segundo_apellido);
        $stmt->bindParam(':id_tipo_documento', $id_tipo_documento);
        $stmt->bindParam(':id_genero', $id_genero);
        $stmt->bindParam(':id_grupo_sanguineo', $id_grupo_sanguineo);
        $stmt->bindParam(':id_factor_sanguineo', $id_factor_sanguineo);
        $stmt->bindParam(':id_persona', $id_persona);

        $stmt->execute();

        // Redirigir con éxito
        header("Location: show.php?msg=actualizado");
        exit;

    } catch (PDOException $e) {
        echo "<div class='alert alert-danger m-4'>Error al actualizar: " . $e->getMessage() . "</div>";
    }

} else {
    echo "<div class='alert alert-warning m-4'>Acceso inválido.</div>";
}
header("Location: show.php?msg=actualizado");
exit;

?>

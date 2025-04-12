<?php
echo __DIR__;
exit;

require_once dirname(__DIR__) . '/database/conexion.php';



class Aprendiz {
    private $pdo;

    public function __construct() {
        $this->pdo = database::conexion();
    }

    public function insertarPersona($data) {
        $sql = "INSERT INTO personas 
            (primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, documento, id_tipo_documento, id_grupo_sanguineo, id_factor_sanguineo, id_genero) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['primer_nombre'],
            $data['segundo_nombre'],
            $data['primer_apellido'],
            $data['segundo_apellido'],
            $data['documento'],
            $data['id_tipo_documento'],
            $data['id_grupo_sanguineo'],
            $data['id_factor_sanguineo'],
            $data['id_genero']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function insertarAprendiz($id_persona) {
        $sql = "INSERT INTO aprendices (id_persona) VALUES (?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_persona]);
        return $this->pdo->lastInsertId();
    }

    public function asociarPrograma($id_aprendiz, $id_programa) {
        $sql = "INSERT INTO aprendiz_programa (id_aprendiz, id_programa_formacion) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_aprendiz, $id_programa]);
    }
}

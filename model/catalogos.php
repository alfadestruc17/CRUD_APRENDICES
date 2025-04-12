<?php
require_once 'c:/laragon/www/CRUD_APRENDICES/database/conexion.php';

class Catalogos {
    private $pdo;

    public function __construct() {
        $this->pdo = database::conexion();
    }

    public function obtener($tabla) {
        $stmt = $this->pdo->prepare("SELECT * FROM $tabla");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

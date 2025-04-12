<?php


class database {
    
    public static function conexion() {
        try {
            $conexion = new PDO("mysql:host=localhost;dbname=aprendices", "root", "");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}

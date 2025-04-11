<?php

class database {
    private string $host = "localhost";
    private string $db = "aprendices";
    private string $user = "root";
    private string $pass = "";
    private PDO $conexion;


    public function conexion() : PDO {
        try {
            $this->conexion = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conexion;
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            exit;
        }
        
    }
}

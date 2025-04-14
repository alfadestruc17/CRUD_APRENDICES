<?php


require_once dirname(__DIR__) . '/database/conexion.php';



class Aprendiz
{
    private $pdo;

    public function __construct()
    {


        $this->pdo = database::conexion();
    }

    public function insertarPersona($data)
    {
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

    public function insertarAprendiz($id_persona)
    {
        $sql = "INSERT INTO aprendices (id_persona) VALUES (?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_persona]);
        return $this->pdo->lastInsertId();
    }

    public function asociarPrograma($id_aprendiz, $id_programa)
    {
        $sql = "INSERT INTO aprendiz_programa (id_aprendiz, id_programa_ficha) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_aprendiz, $id_programa]);
    }
    public function obtenerAprendices()
    {
        $sql = "SELECT 
                    a.id AS id_aprendiz,
                    p.primer_nombre,
                    p.primer_apellido,
                    p.documento,
                    td.tipo_documento,
                    pf.nombre_programa
                FROM aprendices a
                INNER JOIN personas p ON a.id_persona = p.id
                INNER JOIN tipo_documento td ON p.id_tipo_documento = td.id
                INNER JOIN aprendiz_programa apf ON apf.id_aprendiz = a.id
                INNER JOIN programa_formacion pf ON apf.id_programa_formacion = pf.id";

        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function actualizar_aprendiz($aprendiz)
    {
        $sql = "UPDATE personas SET 
                    primer_nombre = ?,
                    segundo_nombre = ?,
                    primer_apellido = ?,
                    segundo_apellido = ?,
                    id_tipo_documento = ?,
                    id_grupo_sanguineo = ?,
                    id_factor_sanguineo = ?,
                    id_genero = ?
                WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $aprendiz['primer_nombre'],
            $aprendiz['segundo_nombre'],
            $aprendiz['primer_apellido'],
            $aprendiz['segundo_apellido'],
            $aprendiz['id_tipo_documento'],
            $aprendiz['id_grupo_sanguineo'],
            $aprendiz['id_factor_sanguineo'],
            $aprendiz['id_genero'],
            $aprendiz['id_persona']
        ]);
    }
    public function eliminarAprendiz($id_aprendiz)
    {
        $sql = "SELECT id_persona FROM aprendices WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_aprendiz]);

        $id_persona = $stmt->fetchColumn();
        $sql = "DELETE FROM aprendiz_programa WHERE id_aprendiz = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_aprendiz]);
        
        $sql = "DELETE FROM aprendices WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_aprendiz]);

        $sql = "DELETE FROM personas WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_persona]);
    }
}

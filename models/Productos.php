<?php
class Productos
{
    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    public function listar()
    {
        $stmt = $this->db->query("SELECT * FROM productos ORDER BY id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar($texto)
    {
        $sql = "SELECT * FROM productos WHERE id = :id OR nombre LIKE :nombre ORDER BY id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ":id"     => is_numeric($texto) ? (int)$texto : 0,
            ":nombre" => "%" . $texto . "%"
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtener($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM productos WHERE id = :id");
        $stmt->execute([":id" => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertar($nombre, $categoria, $precio)
    {
        $sql = "INSERT INTO productos (nombre, categoria, precio) VALUES (:n, :c, :p)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([":n" => $nombre, ":c" => $categoria, ":p" => $precio]);
    }

    public function actualizar($id, $nombre, $categoria, $precio)
    {
        $sql = "UPDATE productos SET nombre = :n, categoria = :c, precio = :p WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([":n" => $nombre, ":c" => $categoria, ":p" => $precio, ":id" => $id]);
    }

    public function eliminar($id)
    {
        $stmt = $this->db->prepare("DELETE FROM productos WHERE id = :id");
        return $stmt->execute([":id" => $id]);
    }
}
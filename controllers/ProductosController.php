<?php
require_once __DIR__ . "/../models/Productos.php";

class ProductosController
{
    private Productos $modelo;

    public function __construct($conexion)
    {
        $this->modelo = new Productos($conexion);
    }

    private function avisar($tipo, $texto)
    {
        $_SESSION["mensaje"] = ["tipo" => $tipo, "texto" => $texto];
        header("Location: index.php");
        exit;
}

    private function validar($nombre, $categoria, $precio)
    {
        if ($nombre === "" || $categoria === "" || $precio === "") {
            return "Todos los campos son obligatorios";
        }
        if (!is_numeric($precio) || $precio <= 0) {
            return "El precio debe ser un número mayor que cero";
        }
        return null;
    }

    public function index()
    {
        $busqueda  = trim($_GET["q"] ?? "");
        $productos = $busqueda !== ""
            ? $this->modelo->buscar($busqueda)
            : $this->modelo->listar();
        $mensaje = $_SESSION["mensaje"] ?? null;
        unset($_SESSION["mensaje"]);
        require __DIR__ . "/../views/listar.php";
    }

    public function crear()
    {
        $producto = ["id" => "", "nombre" => "", "categoria" => "", "precio" => ""];
        $error = null;
        require __DIR__ . "/../views/formulario.php";
    }

    public function guardar()
    {
        $nombre    = trim($_POST["nombre"] ?? "");
        $categoria = trim($_POST["categoria"] ?? "");
        $precio    = trim($_POST["precio"] ?? "");

        $error = $this->validar($nombre, $categoria, $precio);
        if ($error) {
            $producto = ["id" => "", "nombre" => $nombre, "categoria" => $categoria, "precio" => $precio];
            require __DIR__ . "/../views/formulario.php";
            return;
        }
        $this->modelo->insertar($nombre, $categoria, $precio);
        $this->avisar("exito", "Producto registrado correctamente");
    }

    public function editar()
    {
        $id = filter_var($_GET["id"] ?? "", FILTER_VALIDATE_INT);
        if (!$id || $id <= 0) {
            $this->avisar("error", "Identificador no válido");
        }
        $producto = $this->modelo->obtener($id);
        if (!$producto) {
            $this->avisar("error", "El producto no existe");
        }
        $error = null;
        require __DIR__ . "/../views/formulario.php";
    }

    public function actualizar()
    {
        $id  = filter_var($_POST["id"] ?? "", FILTER_VALIDATE_INT);
        $nombre    = trim($_POST["nombre"] ?? "");
        $categoria = trim($_POST["categoria"] ?? "");
        $precio    = trim($_POST["precio"] ?? "");

        if (!$id || $id <= 0) {
            $this->avisar("error", "Identificador no válido");
        }
        $error = $this->validar($nombre, $categoria, $precio);
        if ($error) {
            $producto = ["id" => $id, "nombre" => $nombre, "categoria" => $categoria, "precio" => $precio];
            require __DIR__ . "/../views/formulario.php";
            return;
        }
        $this->modelo->actualizar($id, $nombre, $categoria, $precio);
        $this->avisar("exito", "Producto actualizado correctamente");
    }

    public function eliminar()
    {
        $id = filter_var($_POST["id"] ?? "", FILTER_VALIDATE_INT);
        if (!$id || $id <= 0) {
            $this->avisar("error", "Identificador no válido");
        }
        $this->modelo->eliminar($id);
        $this->avisar("exito", "Producto eliminado correctamente");
    }
}
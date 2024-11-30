<?php
require_once '../../../db/Database.php';

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tipo = trim($_POST["tipo"]);
    $nombre = trim($_POST["nombre"]);
    $cantidad = trim($_POST["cantidad"]);
    $precio = trim($_POST["precio"]);

    if (empty($tipo) || empty($nombre) || empty($precio) || empty($cantidad)) {
        die("Rellene todos los campos");
    }

    try {
        $query = "INSERT INTO medicamentos (tipo, nombre, cantidad, precio) VALUES (:tipo, :nombre, :cantidad, :precio)";
        $stmt = $conn->prepare($query);

        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':cantidad', $cantidad);
        $stmt->bindParam(':precio', $precio);

        if ($stmt->execute()) {
            echo $nombre . " agregado";
        } else {
            echo "Error al agregar " . $nombre;
        }
    } catch (PDOException $exception) {
        echo "Error en db: " . $exception->getMessage();
    }

    $stmt = null;
    $conn = null;
}

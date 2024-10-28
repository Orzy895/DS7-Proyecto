<?php
require_once '../../../db/Database.php';

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = trim($_POST["nombre"]);
    $precio = trim($_POST["precio"]);

    if (empty($nombre) || empty($precio)) {
        die("Rellene todos los campos");
    }

    try {
        $query = "INSERT INTO servicios (nombre, precio) VALUES (:nombre, :precio)";
        $stmt = $conn->prepare($query);

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':precio', $precio);

        if ($stmt->execute()) {
            echo "Servicio agregado";
        } else {
            echo "Error al agregar servicio";
        }
    } catch (PDOException $exception) {
        echo "Error en db: " . $exception->getMessage();
    }

    $stmt = null;
    $conn = null;
}

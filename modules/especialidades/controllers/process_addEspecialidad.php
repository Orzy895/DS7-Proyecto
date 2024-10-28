<?php
require_once '../../../db/Database.php';

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = trim($_POST["nombre"]);
    $desc = trim($_POST["desc"]);

    if (empty($nombre) || empty($desc)) {
        die("Rellene todos los campos");
    }

    try {
        $query = "INSERT INTO especialidadesmedicas (nombre, descripcion) VALUES (:nombre, :desc)";
        $stmt = $conn->prepare($query);

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':desc', $desc);

        if ($stmt->execute()) {
            echo "Especialidad agregado";
        } else {
            echo "Error al agregar especialidad";
        }
    } catch (PDOException $exception) {
        echo "Error en db: " . $exception->getMessage();
    }

    $stmt = null;
    $conn = null;
}

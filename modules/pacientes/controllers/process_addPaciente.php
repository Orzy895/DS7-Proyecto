<?php
require_once '../../../db/Database.php';

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = trim($_POST["nombre"]);
    $cedula = trim($_POST["cedula"]);
    $dob = trim($_POST["dob"]);
    $historial = trim($_POST["historial"]);
    $seguro = trim($_POST["seguro"]);

    if (empty($nombre) || empty($cedula) || empty($dob)) {
        die("Rellene todos los campos");
    }

    try {
        $query = "INSERT INTO pacientes (nombre, cedula, dob, historial, seguro) VALUES (:nombre, :cedula, :dob, :historial, :seguro)";
        $stmt = $conn->prepare($query);

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':cedula', $cedula);
        $stmt->bindParam(':dob', $dob);
        $stmt->bindParam(':historial', $historial);
        $stmt->bindParam(':seguro', $seguro);

        if ($stmt->execute()) {
            echo "paciente agregado";
        } else {
            echo "Error al agregar paciente";
        }
    } catch (PDOException $exception) {
        echo "Error en db: " . $exception->getMessage();
    }

    $stmt = null;
    $conn = null;
}

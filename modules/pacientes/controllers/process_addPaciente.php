<?php
require_once '../../../db/Database.php';

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = trim($_POST["nombre"]);
    $cedula = trim($_POST["cedula"]);
    $dob = trim($_POST["dob"]);
    $seguro = trim($_POST["seguro"]);
    $correo = trim($_POST["correo"]);

    if (empty($nombre) || empty($cedula) || empty($dob) || empty($correo)) {
        die("Rellene todos los campos");
    }

    try {
        $query = "INSERT INTO pacientes (nombre, cedula, dob, seguro, correo) VALUES (:nombre, :cedula, :dob, :seguro, :correo)";
        $stmt = $conn->prepare($query);

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':cedula', $cedula);
        $stmt->bindParam(':dob', $dob);
        $stmt->bindParam(':seguro', $seguro);
        $stmt->bindParam(':correo', $correo);

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

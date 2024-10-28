<?php
require_once '../../../db/Database.php';

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tiempo = trim($_POST["tiempo"]);
    $lugar = trim($_POST["lugar"]);
    $paciente = trim($_POST["paciente"]);
    $medico = trim($_POST["medico"]);
    $servicio = trim($_POST["servicio"]);

    if (empty($tiempo) || empty($lugar) || empty($paciente) || empty($medico) || empty($servicio)) {
        die("Rellene todos los campos");
    }

    try {
        $query = "INSERT INTO citas (tiempo, lugar, paciente_id, medico_id, servicio_id) VALUES (:tiempo, :lugar, :paciente, :medico, :servicio)";
        $stmt = $conn->prepare($query);

        $stmt->bindParam(':tiempo', $tiempo);
        $stmt->bindParam(':lugar', $lugar);
        $stmt->bindParam(':paciente', $paciente);
        $stmt->bindParam(':medico', $medico);
        $stmt->bindParam(':servicio', $servicio);

        if ($stmt->execute()) {
            echo "cita agregado";
        } else {
            echo "Error al agregar cita";
        }
    } catch (PDOException $exception) {
        echo "Error en db: " . $exception->getMessage();
    }

    $stmt = null;
    $conn = null;
}

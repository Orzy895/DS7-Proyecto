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
        echo json_encode(['success' => false, 'message' => 'Rellene todos los campos']);
        exit;
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
            echo json_encode(['success' => true, 'message' => 'Cita agendada correctamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al agendar cita.']);
        }
    } catch (PDOException $exception) {
        echo json_encode(['success' => false, 'message' => 'Error al agendar cita.']);
    }

    $stmt = null;
    $conn = null;
}

<?php
require_once '../../../db/Database.php';

$database = new Database();
$conn = $database->getConnection();

header('Content-Type: application/json');

$cita_id = isset($_GET['cita_id']) ? intval($_GET['cita_id']) : 0;

if ($cita_id > 0) {
    try {
        $query = "
            SELECT 
                c.id AS cita_id, c.tiempo, c.lugar, 
                p.nombre AS paciente_nombre, p.cedula AS paciente_cedula, 
                u.nombre AS medico_nombre,
                GROUP_CONCAT(s.nombre ORDER BY s.nombre ASC SEPARATOR ', ') AS servicios_nombre,
                c.diagnostico
            FROM citas c
            JOIN pacientes p ON c.paciente_id = p.id
            JOIN personales m ON c.medico_id = m.id
            JOIN usuarios u ON m.usuario_id = u.id
            JOIN citas_servicios cs ON c.id = cs.cita_id
            JOIN servicios s ON cs.servicio_id = s.id
            WHERE c.id = :cita_id
        ";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':cita_id', $cita_id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $cita = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode(['success' => true, 'data' => $cita]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Cita no encontrada.']);
        }
    } catch (PDOException $exception) {
        echo json_encode(['success' => false, 'message' => 'Error en db: ' . $exception->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID de cita inválido.']);
}

$conn = null;

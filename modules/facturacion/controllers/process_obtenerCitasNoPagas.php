<?php
require_once '../../../db/Database.php';

$database = new Database();
$conn = $database->getConnection();

header('Content-Type: application/json');

try {
    $query = "
        SELECT 
            c.id AS cita_id, 
            c.tiempo, 
            c.lugar, 
            p.nombre AS paciente_nombre, 
            p.cedula AS paciente_cedula, 
            u.nombre AS medico_nombre
        FROM citas c
        JOIN pacientes p ON c.paciente_id = p.id
        JOIN personales m ON c.medico_id = m.id
        JOIN usuarios u ON m.usuario_id = u.id
        WHERE c.pagado = 0
    ";

    $stmt = $conn->prepare($query);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $citas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(['success' => true, 'data' => $citas]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No hay citas pendientes de pago.']);
    }
} catch (PDOException $exception) {
    echo json_encode(['success' => false, 'message' => 'Error en db: ' . $exception->getMessage()]);
}

$conn = null;

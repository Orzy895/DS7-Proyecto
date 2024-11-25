<?php
require_once '../../../db/Database.php';

$database = new Database();
$conn = $database->getConnection();

try {
    $query = "
        SELECT 
            c.id AS cita_id,
            c.tiempo,
            c.lugar,
            p.nombre AS paciente_nombre,
            p.cedula AS paciente_cedula,
            u.nombre AS medico_nombre
        FROM 
            Citas c
        INNER JOIN Pacientes p ON c.paciente_id = p.id
        INNER JOIN Personales m ON c.medico_id = m.id
        INNER JOIN Usuarios u ON m.id = u.id
        ORDER BY c.tiempo ASC
    ";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return JSON response
    echo json_encode(['success' => true, 'data' => $result]);
} catch (PDOException $exception) {
    echo json_encode([
        'success' => false,
        'message' => 'Error obteniendo citas: ' . $exception->getMessage(),
    ]);
}

$conn = null;
?>

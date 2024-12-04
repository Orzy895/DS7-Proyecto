<?php
require_once '../../../db/Database.php';

header('Content-Type: application/json');

$cita_id = isset($_GET['cita_id']) ? intval($_GET['cita_id']) : 0;

if ($cita_id > 0) {
    $database = new Database();
    $conn = $database->getConnection();

    try {
        $queryCita = "
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
            GROUP BY c.id, p.nombre, p.cedula, u.nombre, c.tiempo, c.lugar, c.diagnostico
        ";

        $stmtCita = $conn->prepare($queryCita);
        $stmtCita->bindParam(':cita_id', $cita_id, PDO::PARAM_INT);
        $stmtCita->execute();

        if ($stmtCita->rowCount() > 0) {
            $cita = $stmtCita->fetch(PDO::FETCH_ASSOC);

            $queryRecetas = "
                SELECT 
                    m.nombre AS medicamento_nombre,
                    mr.cantidad AS cantidad
                FROM recetas r
                JOIN MedicamentosReceetas mr ON r.id = mr.receta_id
                JOIN medicamentos m ON mr.medicamento_id = m.id
                WHERE r.cita_id = :cita_id
            ";

            $stmtRecetas = $conn->prepare($queryRecetas);
            $stmtRecetas->bindParam(':cita_id', $cita_id, PDO::PARAM_INT);
            $stmtRecetas->execute();

            $recetas = $stmtRecetas->fetchAll(PDO::FETCH_ASSOC);

            $response = [
                'success' => true,
                'data' => [
                    'cita' => $cita,
                    'recetas' => $recetas
                ]
            ];

            echo json_encode($response);
        } else {
            echo json_encode(['success' => false, 'message' => 'Cita no encontrada.']);
        }
    } catch (PDOException $exception) {
        echo json_encode(['success' => false, 'message' => 'Error en db: ' . $exception->getMessage()]);
    } finally {
        $conn = null;
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID de cita inválido.']);
}
?>

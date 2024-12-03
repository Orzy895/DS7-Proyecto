<?php
require_once '../../../db/Database.php';

$database = new Database();
$conn = $database->getConnection();

header('Content-Type: application/json');

try {
    $query = "
        SELECT 
            nombre,
            SUM(costo) AS costo_unitario,
            SUM(COALESCE(cantidad, 1)) AS cantidad,
            SUM(costo * COALESCE(cantidad, 1)) AS total
        FROM (
            SELECT 
                c.id AS cita_id,
                'Servicio' AS tipo,
                s.nombre AS nombre,
                s.precio AS costo,
                NULL AS cantidad
            FROM 
                Citas c
            INNER JOIN 
                Citas_Servicios cs ON c.id = cs.cita_id
            INNER JOIN 
                Servicios s ON cs.servicio_id = s.id

            UNION ALL

            SELECT 
                c.id AS cita_id,
                'Medicamento' AS tipo,
                m.nombre AS nombre,
                m.precio AS costo,
                mr.cantidad AS cantidad
            FROM 
                Citas c
            INNER JOIN 
                Recetas r ON c.id = r.cita_id
            INNER JOIN 
                MedicamentosReceetas mr ON r.id = mr.receta_id
            INNER JOIN 
                Medicamentos m ON mr.medicamento_id = m.id
        ) AS detalle
        WHERE cita_id = ?
        GROUP BY 
            cita_id, tipo, nombre
        ORDER BY 
            cita_id, tipo, nombre
    ";

    $citaId = isset($_GET['cita_id']) ? intval($_GET['cita_id']) : null;

    if ($citaId === null) {
        echo json_encode(['success' => false, 'message' => 'ID de cita no proporcionado.']);
        exit;
    }


    $stmt = $conn->prepare($query);
    $stmt->execute([$citaId]);

    if ($stmt->rowCount() > 0) {
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(['success' => true, 'data' => $resultados]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontraron resultados para la cita especificada.']);
    }
} catch (PDOException $exception) {
    echo json_encode(['success' => false, 'message' => 'Error en la base de datos: ' . $exception->getMessage()]);
}

$conn = null;

<?php
require_once '../../../db/Database.php';

if (!isset($_GET['cita_id'])) {
    echo "ID de Cita no proporcionado.";
    exit;
}

$cita_id = $_GET['cita_id'];

$db = new Database();
$conn = $db->getConnection();

try {
    $sql = "
        SELECT 
            m.nombre AS medicamento_nombre,
            mr.cantidad AS cantidad
        FROM Recetas r
        JOIN MedicamentosReceetas mr ON r.id = mr.receta_id
        JOIN Medicamentos m ON mr.medicamento_id = m.id
        WHERE r.cita_id = :cita_id
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':cita_id', $cita_id, PDO::PARAM_INT);
    $stmt->execute();

    $recetas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($recetas) {
        echo json_encode($recetas);
    } else {
        echo json_encode([]);
    }

} catch (PDOException $e) {
    echo json_encode(['error' => 'Error al obtener las recetas: ' . $e->getMessage()]);
}
?>

<?php

require_once '../../../db/Database.php';

$database = new Database();
$conn = $database->getConnection();

$citaId = isset($_GET['cita_id']) ? $_GET['cita_id'] : null;

if (!$citaId) {
    echo json_encode(["error" => "No se proporcionó un ID de cita."]);
    exit;
}

try {
    $query = "
        SELECT p.nombre, p.correo
        FROM Citas c
        JOIN Pacientes p ON c.paciente_id = p.id
        WHERE c.id = :cita_id
    ";
    
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':cita_id', $citaId, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($data);
    } else {
        echo json_encode(["message" => "No se encontró la cita con el ID proporcionado."]);
    }
} catch (PDOException $exception) {
    echo json_encode(["error" => "Error en db: " . $exception->getMessage()]);
}

$stmt = null;
$conn = null;
?>

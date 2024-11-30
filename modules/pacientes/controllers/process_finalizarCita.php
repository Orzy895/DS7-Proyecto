<?php
require_once '../../../db/Database.php';

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cita_id = $_POST["cita_id"];

    if (empty($cita_id)) {
        die(json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']));
    }

    try {
        $queryActualizarDiagnostico = "UPDATE citas 
                                      SET estado = false 
                                      WHERE id = :cita_id";

        $stmtActualizarDiagnostico = $conn->prepare($queryActualizarDiagnostico);

        $stmtActualizarDiagnostico->bindParam(":cita_id", $cita_id, PDO::PARAM_INT);

        $stmtActualizarDiagnostico->execute();

        echo json_encode(['success' => true, 'message' => 'Cita finalizado con éxito.']);
    } catch (PDOException $exception) {
        echo json_encode([
            'success' => false,
            'message' => 'Error en la base de datos: ' . $exception->getMessage(),
            'error_info' => $exception->errorInfo
        ]);
    }

    $conn = null;
}

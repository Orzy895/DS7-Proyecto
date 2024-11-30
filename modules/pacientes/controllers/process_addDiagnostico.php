<?php
require_once '../../../db/Database.php';

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cita_id = $_POST["cita_id"];
    $diagnostico = $_POST["diagnostico"];

    if (empty($cita_id) || empty($diagnostico)) {
        die(json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']));
    }

    try {
        $queryActualizarDiagnostico = "UPDATE citas 
                                      SET diagnostico = :diagnostico 
                                      WHERE id = :cita_id";

        $stmtActualizarDiagnostico = $conn->prepare($queryActualizarDiagnostico);

        $stmtActualizarDiagnostico->bindParam(":cita_id", $cita_id, PDO::PARAM_INT);
        $stmtActualizarDiagnostico->bindParam(":diagnostico", $diagnostico, PDO::PARAM_STR);

        $stmtActualizarDiagnostico->execute();

        echo json_encode(['success' => true, 'message' => 'Diagnóstico actualizado con éxito.']);
    } catch (PDOException $exception) {
        echo json_encode([
            'success' => false,
            'message' => 'Error en la base de datos: ' . $exception->getMessage(),
            'error_info' => $exception->errorInfo
        ]);
    }

    $conn = null;
}

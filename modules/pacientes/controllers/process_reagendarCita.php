<?php
require_once '../../../db/Database.php';

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cita_id = $_POST["cita_id"];
    $tiempo = $_POST["nueva_fecha"];

    if (empty($cita_id) || empty($tiempo)) {
        die(json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']));
    }

    try {
        $queryActualizarCita = "UPDATE Citas 
                                SET tiempo = :tiempo 
                                WHERE id = :cita_id";
        $stmtActualizarCita = $conn->prepare($queryActualizarCita);
        $stmtActualizarCita->bindParam(":tiempo", $tiempo);
        $stmtActualizarCita->bindParam(":cita_id", $cita_id);
        $stmtActualizarCita->execute();

        echo json_encode(['success' => true, 'message' => 'Cita reagendada con éxito.']);
    } catch (PDOException $exception) {
        echo json_encode([
            'success' => false,
            'message' => 'Error en la base de datos: ' . $exception->getMessage(),
            'error_info' => $exception->errorInfo
        ]);
    }

    $conn = null;
}

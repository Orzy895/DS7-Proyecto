<?php
require_once '../../../db/Database.php';

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cita_id = $_POST["cita_id"];
    $servicio_id = $_POST["servicio_id"];

    if (empty($cita_id) || empty($servicio_id)) {
        die(json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']));
    }

    try {
        $queryAgregarServicio = "INSERT INTO citas_servicios (cita_id, servicio_id) 
                                 VALUES (:cita_id, :servicio_id)";
        
        $stmtAgregarServicio = $conn->prepare($queryAgregarServicio);

        $stmtAgregarServicio->bindParam(":cita_id", $cita_id, PDO::PARAM_INT);
        $stmtAgregarServicio->bindParam(":servicio_id", $servicio_id, PDO::PARAM_INT);

        $stmtAgregarServicio->execute();

        echo json_encode(['success' => true, 'message' => 'Servicio agregado a la cita con éxito.']);
    } catch (PDOException $exception) {
        echo json_encode([
            'success' => false,
            'message' => 'Error en la base de datos: ' . $exception->getMessage(),
            'error_info' => $exception->errorInfo
        ]);
    }

    $conn = null;
}
?>

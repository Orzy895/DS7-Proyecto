<?php
require_once '../../../db/Database.php';

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST["usuario"]);
    $horario = $_POST["horario"];
    $max_citas = trim($_POST["max_citas"]);

    if (empty($usuario) || empty($horario) || empty($max_citas)) {
        die("Rellene todos los campos.");
    }

    try {
        $values = [];
        foreach ($horario as $timeSlot) {
            $values[] = "(:usuario, :dia_{$timeSlot['day']}, :hora_inicio_{$timeSlot['day']}, :hora_fin_{$timeSlot['day']}, :max_citas)";
        }
        
        $query = "INSERT INTO horariomedico (usuario_id, dia_semana, hora_inicio, hora_fin, max_citas) 
                  VALUES " . implode(",", $values);
        
        $stmt = $conn->prepare($query);

        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':max_citas', $max_citas);
        
        foreach ($horario as $timeSlot) {
            $stmt->bindParam(":dia_{$timeSlot['day']}", $timeSlot['day']);
            $stmt->bindParam(":hora_inicio_{$timeSlot['day']}", $timeSlot['start_time']);
            $stmt->bindParam(":hora_fin_{$timeSlot['day']}", $timeSlot['end_time']);
        }

        $stmt->execute();

        echo json_encode(['success' => true, 'message' => 'Horario añadido correctamente.']);
    } catch (PDOException $exception) {
        echo json_encode([
            'success' => false, 
            'message' => 'Error en db: ' . $exception->getMessage(),
            'error_info' => $exception->errorInfo
        ]);
    }

    $stmt = null;
    $conn = null;
}
?>

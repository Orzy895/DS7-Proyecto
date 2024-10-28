<?php
require_once '../../../db/Database.php';

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = isset($_POST["usuario"]) ? trim($_POST["usuario"]) : null;
    $especialidades = isset($_POST["especialidades"]) ? $_POST["especialidades"] : [];

    if (empty($usuario) || empty($especialidades)) {
        echo json_encode(['success' => false, 'message' => 'Rellene todos los campos' . $usuario]);
        exit;
    }

    try {
        $query = "INSERT INTO medicoespecialidad (medico_id, especialidad_id) VALUES (:usuario, :especialidad)";
        $stmt = $conn->prepare($query);

        $conn->beginTransaction();

        foreach ($especialidades as $especialidad) {
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':especialidad', $especialidad);

            if (!$stmt->execute()) {
                $conn->rollBack();
                echo json_encode(['success' => false, 'message' => 'Error al agregar especialidad.']);
                exit;
            }
        }

        $conn->commit();
        echo json_encode(['success' => true, 'message' => 'Especialidades agregadas correctamente.']);
    } catch (PDOException $exception) {
        $conn->rollBack();
        echo json_encode(['success' => false, 'message' => 'Error en db: ' . $exception->getMessage()]);
    }

    $stmt = null;
    $conn = null;
}

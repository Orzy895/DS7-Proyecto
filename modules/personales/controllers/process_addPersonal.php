<?php
require_once '../../../db/Database.php';

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = trim($_POST["usuario"]);
    $posicion = trim($_POST["posicion"]);
    $departamento = trim($_POST["departamento"]);

    if (empty($usuario) || empty($posicion) || empty($departamento)) {
        die("Rellene todos los campos");
    }

    try {
        $query = "INSERT INTO personales (usuario_id, posicion, departamento_id ) VALUES (:usuario, :posicion, :departamento)";
        $stmt = $conn->prepare($query);

        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':posicion', $posicion);
        $stmt->bindParam(':departamento', $departamento);

        if ($stmt->execute()) {
            $userId = $conn->lastInsertId();
            echo json_encode(['success' => true, 'userId' => $userId, 'message' => 'Personal agregado correctamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al agregar personal.']);
        }
    } catch (PDOException $exception) {
        echo json_encode(['success' => false, 'message' => 'Error en db: ' . $exception->getMessage()]);
    }

    $stmt = null;
    $conn = null;
}

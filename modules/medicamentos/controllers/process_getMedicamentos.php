<?php

require_once '../../../db/Database.php';

$database = new Database();
$conn = $database->getConnection();

try {
    $query = "
        SELECT id, tipo, nombre, cantidad, precio FROM medicamentos
    ";
    $stmt = $conn->prepare($query);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    } else {
        echo json_encode(["message" => "No hay medicamentos en la base de datos."]);
    }
} catch (PDOException $exception) {
    echo json_encode(["error" => "Error en db: " . $exception->getMessage()]);
}

$stmt = null;
$conn = null;

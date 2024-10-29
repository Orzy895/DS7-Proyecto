<?php

require_once '../../../db/Database.php';

$database = new Database();
$conn = $database->getConnection();

try {
    $query = "
        SELECT Usuarios.id, Usuarios.nombre 
        FROM Personales
        JOIN Usuarios ON Personales.usuario_id = Usuarios.id
        WHERE Personales.departamento_id NOT IN (1, 13)
    ";
    $stmt = $conn->prepare($query);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    } else {
        echo json_encode(["message" => "No hay departamentos en la base de datos."]);
    }
} catch (PDOException $exception) {
    echo json_encode(["error" => "Error en db: " . $exception->getMessage()]);
}

$stmt = null;
$conn = null;

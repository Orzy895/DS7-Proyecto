<?php

require_once '../../db/Database.php';

$database = new Database();
$conn = $database->getConnection();

$user = isset($_GET['id']) ? $_GET['id'] : null;

if ($user === null) {
    echo json_encode(["error" => "No user ID provided."]);
    exit;
}

try {
    $query = "
    SELECT usuarios.nombre as nombre, usuarios.cedula as cedula, usuarios.email as email, usuarios.role_id
    FROM usuarios
    JOIN roles ON usuarios.role_id = roles.id
    WHERE usuarios.id = :user
";

    $stmt = $conn->prepare($query);

    $stmt->bindParam(':user', $user, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($data);
    } else {
        echo json_encode(["error" => "El usuario no existe en la base de datos" . $user]);
    }
} catch (PDOException $exception) {
    echo json_encode(["error" => "Error en db: " . $exception->getMessage()]);
}

$stmt = null;
$conn = null;

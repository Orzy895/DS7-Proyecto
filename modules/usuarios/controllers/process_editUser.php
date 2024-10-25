<?php
session_start();
require_once '../../../db/Database.php';

if (!isset($_SESSION['user'])) {
    die(json_encode(['success' => false, 'message' => 'No hay sesión activa']));
}

$database = new Database();
$conn = $database->getConnection();

try {
    $userId = $POST['userList'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $cedula = $_POST['cedula'];
    $roleId = $_POST['role'];

    $query = "
        UPDATE usuarios 
        SET nombre = :nombre, email = :email, cedula = :cedula, role_id = :roleId
        WHERE id = :userId
    ";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':cedula', $cedula, PDO::PARAM_STR);
    $stmt->bindParam(':roleId', $roleId, PDO::PARAM_INT);
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Perfil actualizado correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el perfil.']);
    }
} catch (PDOException $exception) {
    echo json_encode(['success' => false, 'message' => 'Error en db: ' . $exception->getMessage()]);
}

$stmt = null;
$conn = null;

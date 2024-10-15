<?php
session_start();

require_once '../../../db/Database.php';

if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'ADMIN') {
    die("No tienes permisos para realizar esta acción." . ($_SESSION['user'] . $_SESSION['role']));
}

$database = new Database();
$conn = $database->getConnection();

try {
    $userId = $_POST['id'];

    $query = "DELETE FROM usuarios WHERE id = :userId";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => "Error al eliminar el usuario."]);
    }
} catch (PDOException $exception) {
    echo json_encode(['success' => false, 'message' => "Error en db: " . $exception->getMessage()]);
}

$stmt = null;
$conn = null;

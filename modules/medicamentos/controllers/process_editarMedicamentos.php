<?php

require_once '../../../db/Database.php';

$database = new Database();
$conn = $database->getConnection();

$response = ['success' => false];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $tipo = $_POST['tipo'];
    $nombre = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];

    try {
        $query = "
            UPDATE medicamentos
            SET tipo = :tipo, nombre = :nombre, cantidad = :cantidad, precio = :precio
            WHERE id = :id
        ";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':cantidad', $cantidad);
        $stmt->bindParam(':precio', $precio);

        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['error'] = 'Error al actualizar el medicamento.';
        }
    } catch (PDOException $exception) {
        $response['error'] = 'Error en db: ' . $exception->getMessage();
    }

    $stmt = null;
    $conn = null;
}

echo json_encode($response);

<?php
session_start();
require_once '../../../db/Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!isset($_POST['cliente_id']) || !isset($_POST['total']) || !isset($_POST['detalles'])) {
        echo "Datos de la factura no proporcionados.";
        exit;
    }


    $cliente_id = $_POST['cliente_id'];
    $total = $_POST['total'];
    $detalles = $_POST['detalles']; 
    $cajero_id = $_SESSION['user'];

    $db = new Database();
    $conn = $db->getConnection();

    try {

        $conn->beginTransaction();

        $sql_factura = "INSERT INTO Facturas (detalles, total, cliente_id, cajero_id) VALUES (:detalles, :total, :cliente_id, :cajero_id)";
        $stmt_factura = $conn->prepare($sql_factura);
        $stmt_factura->execute([
            ':detalles' => json_encode($detalles),
            ':total' => $total,
            ':cliente_id' => $cliente_id,
            ':cajero_id' => $cajero_id
        ]);

        $conn->commit();

        echo "Factura guardada con éxito.";
        exit;
    } catch (PDOException $e) {

        $conn->rollBack();
        echo "Error al guardar la factura: " . $e->getMessage();
        exit;
    }
}
?>

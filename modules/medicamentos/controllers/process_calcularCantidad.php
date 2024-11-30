<?php
require_once '../../../db/Database.php';

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = trim($_POST["id"]);
    $cantidad = trim($_POST["cantidad"]);

    if (empty($id) || empty($cantidad)) {
        die("Rellene todos los campos");
    }

    try {
        $query = "SELECT cantidad FROM medicamentos WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $cantidadMedicamento = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = null;

        if ($cantidadMedicamento['cantidad'] < $cantidad) {
            die("La cantidad ingresada es mayor que la disponible");
        }

        $cantidad = $cantidadMedicamento['cantidad'] - $cantidad;

        $query = "UPDATE medicamentos SET cantidad = :cantidad WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':cantidad', $cantidad);

        if ($stmt->execute()) {
            echo "Medicamento actualizado";
        } else {
            echo "Error al actualizar el medicamento.";
        }

        $stmt = null;
        $conn = null;
    } catch (PDOException $exception) {
        echo "Error en db: " . $exception->getMessage();
    }
}

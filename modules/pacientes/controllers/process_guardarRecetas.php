<?php
require_once '../../../db/Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!isset($_POST['cita_id'])) {
        echo "Cita ID no proporcionado.";
        exit;
    }

    $cita_id = $_POST['cita_id'];
    $medicamentos = $_POST['medicamentos'];

    $db = new Database();
    $conn = $db->getConnection();

    try {
        $conn->beginTransaction();

        $descripcion = "Receta para cita $cita_id";
        $sql_receta = "INSERT INTO Recetas (cita_id, descripcion) VALUES (:cita_id, :descripcion)";
        $stmt_receta = $conn->prepare($sql_receta);
        $stmt_receta->execute([':cita_id' => $cita_id, ':descripcion' => $descripcion]);
        $receta_id = $conn->lastInsertId();

        foreach ($medicamentos as $medicamento_id => $cantidad) {

            if ($cantidad > 0) {

                $sql_medicamento_receta = "INSERT INTO MedicamentosReceetas (receta_id, medicamento_id, cantidad) VALUES (:receta_id, :medicamento_id, :cantidad)";
                $stmt_medicamento_receta = $conn->prepare($sql_medicamento_receta);
                $stmt_medicamento_receta->execute([
                    ':receta_id' => $receta_id,
                    ':medicamento_id' => $medicamento_id,
                    ':cantidad' => $cantidad
                ]);


                $query = "SELECT cantidad FROM Medicamentos WHERE id = :medicamento_id";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':medicamento_id', $medicamento_id);
                $stmt->execute();
                $cantidadMedicamento = $stmt->fetch(PDO::FETCH_ASSOC);


                if ($cantidadMedicamento['cantidad'] < $cantidad) {
                    die("La cantidad ingresada es mayor que la disponible.");
                }


                $nueva_cantidad = $cantidadMedicamento['cantidad'] - $cantidad;
                $query = "UPDATE Medicamentos SET cantidad = :nueva_cantidad WHERE id = :medicamento_id";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':medicamento_id', $medicamento_id);
                $stmt->bindParam(':nueva_cantidad', $nueva_cantidad);
                $stmt->execute();
            }
        }

        $conn->commit();

        echo "Receta guardada con éxito.";
        header("Location: ../views/citas.php");
        exit;
    } catch (PDOException $e) {
        $conn->rollBack();
        echo "Error al guardar la receta: " . $e->getMessage();
        exit;
    }
}

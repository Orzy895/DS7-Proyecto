<?php
require_once '../db/Database.php';

$database = new Database();
$conn = $database->getConnection();

try {
    $query = "SELECT * FROM permisos";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    $permisos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($permisos) {
        echo "<ul>";
        foreach ($permisos as $permiso) {
            echo "<li><strong>Nombre:</strong> " . htmlspecialchars($permiso['nombre']) . " - <strong>Descripción:</strong> " . htmlspecialchars($permiso['descripcion']) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "No hay permisos disponibles.";
    }
} catch (PDOException $exception) {
    echo "Error en db: " . $exception->getMessage();
}

$stmt = null;
$conn = null;

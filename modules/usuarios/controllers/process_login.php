<?php
require_once '../../../db/Database.php';
include '../../../template/head_template.php';

session_start();

if (isset($_SESSION['user'])) {
    echo "Ya has iniciado sesión.";
    exit();
}

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $passw = $_POST["passw"];

    if (empty($email) || empty($passw)) {
        die("Rellene todos los campos");
    }

    try {
        $query = "SELECT usuarios.nombre, usuarios.id, roles.nombre as role, usuarios.contraseña FROM usuarios JOIN roles on usuarios.role_id = roles.id WHERE email = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($passw, $row['contraseña'])) {
                $_SESSION['user'] = $row['id'];
                $_SESSION['role'] = $row['role'];
                echo "Inicio de sesión exitoso, " . htmlspecialchars($row['nombre']);
            } else {
                die("Contraseña incorrecta");
            }
        } else {
            echo "Error al iniciar sesión";
        }
    } catch (PDOException $exception) {
        echo "Error en db: " . $exception->getMessage();
    }

    $stmt = null;
    $conn = null;
}

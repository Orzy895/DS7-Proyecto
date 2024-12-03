<?php
require_once '../../../db/Database.php';
include_once '../../../template/head_template.php';

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = trim($_POST["nombre"]);
    $cedula = trim($_POST["cedula"]);
    $email = trim($_POST["email"]);
    $passw = $_POST["passw"];
    $passwConf = $_POST["passwConf"];

    if (empty($nombre) || empty($cedula) || empty($email) || empty($passw) || empty($passwConf)) {
        die("Rellene todos los campos");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Formato de correo inválido");
    }

    if ($passw !== $passwConf) {
        die("Las contraseñas no coinciden");
    }

    $hashed_password = password_hash($passw, PASSWORD_DEFAULT);

    try {
        $query = "INSERT INTO usuarios (nombre, cedula, email, contraseña, role_id) VALUES (:nombre, :cedula, :email, :password, 2)";
        $stmt = $conn->prepare($query);

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':cedula', $cedula);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);

        if ($stmt->execute()) {
            header("Location: ../../../index.php");
        } else {
            echo "Error al crear el usuario";
        }
    } catch (PDOException $exception) {
        echo "Error en db: " . $exception->getMessage();
    }

    $stmt = null;
    $conn = null;
}
?>
<br>
<a href="/ds7-Proyecto/index.php" class="underline text-[-webkit-link]">Volver a la página de inicio</a>
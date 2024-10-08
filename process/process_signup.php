<?php
require_once '../includes/Database.php';

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nombre = trim($_POST["nombre"]);
    $celula = trim($_POST["celula"]);
    $email = trim($_POST["email"]);
    $passw = $_POST["passw"];
    $passwConf = $_POST["passwConf"];

    if (empty($nombre) || empty($celula) || empty($email) || empty($passw) || empty($passwConf)) {
        die("Rellene todos los campos");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Formato de correo inválido");
    }

    if ($passw !== $passwConf) {
        die("Las contraseñas no coinciden");
    }

    $hashed_password = password_hash($passw, PASSWORD_DEFAULT);

    try{
        $query = "INSERT INTO usuarios (nombre, celula, email, contraseña, role_id) VALUES (:nombre, :celula, :email, :password, 1)";
        $stmt = $conn->prepare($query);

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':celula', $celula);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);

        if ($stmt->execute()) {
            echo "Usuario creado";
        } else {
            echo "Error al crear el usuario";
        }
    } catch(PDOException $exception){
        echo "Error en db: " . $exception->getMessage();
    }

    $stmt = null;
    $conn = null;
}
?>

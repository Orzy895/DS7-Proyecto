<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración de Usuarios</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../scripts/userAdmin.js"></script>
</head>

<body>
    <a href="../process/module_users/process_logout.php">
        <button>Logout</button>
    </a>
    <h1>Panel de Administración de Usuarios</h1>
    <p id="message"></p>

    <!-- User combo box for selection -->
    <div>
        <label for="userList"><strong>Seleccionar Usuario:</strong></label>
        <select id="userList" name="userList">
            <option value="">Seleccione un usuario</option>
        </select>
    </div>

    <form id="updateProfileForm">
        <div>
            <label for="nombre"><strong>Nombre:</strong></label>
            <input type="text" id="nombre" name="nombre" required>
        </div>
        <div>
            <label for="email"><strong>Email:</strong></label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="cedula"><strong>Cédula:</strong></label>
            <input type="text" id="cedula" name="cedula" required>
        </div>
        <div>
            <label for="role"><strong>Role:</strong></label>
            <select id="role" name="role" required></select>
        </div>
        <button type="submit">Actualizar Usuario</button>
    </form>
    <button id="deleteUserButton">Eliminar Usuario</button>
</body>

</html>

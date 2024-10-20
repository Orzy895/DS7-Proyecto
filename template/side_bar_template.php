<style>
    body {
        display: flex;
        font-family: Arial, sans-serif;
    }

    .sidebar {
        width: 200px;
        height: 100vh;
        background-color: #333;
        padding-top: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .sidebar a {
        text-decoration: none;
        color: white;
        background-color: #444;
        padding: 10px 20px;
        margin: 5px 0;
        width: 80%;
        text-align: center;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .sidebar a:hover {
        background-color: #555;
    }

    .content {
        padding: 20px;
        flex-grow: 1;
        background-color: #f4f4f4;
        min-height: 100vh;
    }
</style>

<div class="sidebar">
    <a href="modules/usuarios/index.php" class="btn">Usuarios</a>
    <a href="modules/roles/index.php" class="btn">Roles</a>
    <a href="modules/inventario/index.php" class="btn">Inventario</a>
    <a href="modules/facturacion/index.php" class="btn">Facturación</a>
    <a href="modules/servicios/index.php" class="btn">Servicios</a>
    <a href="modules/permisos/index.php" class="btn">Permisos</a>
    <a href="modules/personal/index.php" class="btn">Personal</a>
    <a href="modules/pacientes/index.php" class="btn">Pacientes</a>
</div>

<div class="content">
    <!-- Main content goes here -->
</div>
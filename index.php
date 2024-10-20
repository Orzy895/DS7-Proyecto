<?php
include_once "template/head_template.php";

if (isset($_SESSION['user'])) {
?>
    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
        <a href="modules/usuarios/index.php" class="btn">Usuarios</a>
        <a href="modules/roles/index.php" class="btn">Roles</a>
        <a href="modules/roles/index.php" class="btn">Inventario</a>
        <a href="modules/roles/index.php" class="btn">Facturacion</a>
        <a href="modules/roles/index.php" class="btn">Servicios</a>
        <a href="modules/roles/index.php" class="btn">Permisos</a>
        <a href="modules/roles/index.php" class="btn">Personal</a>
        <a href="modules/roles/index.php" class="btn">Pacientes</a>
        <a href="template/side_bar_template.php" class="btn">sidebar</a>

    </div>
<?php
} else {
    header("Location: modules/usuarios/views/login.php");
    exit();
}

include_once "template/foot_template.php"
?>
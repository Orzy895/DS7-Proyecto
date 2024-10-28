<?php
include_once "template/head_template.php";

if (isset($_SESSION['user'])) {
?>
    <div class="flex flex-col items-center justify-center">
        <a href="modules/usuarios/index" class="btn">Usuarios</a>
        <a href="modules/roles/index.php" class="btn">Roles</a>
        <a href="modules/inventario/index.php" class="btn">Inventario</a>
        <a href="modules/facturacion/index.php" class="btn">Facturación</a>
        <a href="modules/servicios/index.php" class="btn">Servicios</a>
        <a href="modules/permisos/index.php" class="btn">Permisos</a>
        <a href="modules/personales/index.php" class="btn">Personales</a>
        <a href="modules/pacientes/index.php" class="btn">Pacientes</a>
        <a href="modules/departamentos/index.php" class="btn">Departamentos</a>
    </div>
<?php
} else {
    header("Location: modules/usuarios/views/login.php");
    exit();
}

include_once "template/foot_template.php";
?>
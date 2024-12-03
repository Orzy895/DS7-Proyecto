<?php
include_once "template/head_template.php";

if (isset($_SESSION['user'])) {
?>
    <div class="flex flex-row flex-wrap items-center justify-center">
        <div class="seccion bg-sky-600">
            <img class="img" src="assets/Usuario.png" alt="Ejemplo">
            <a href="modules/usuarios/index.php" class="btn">Usuarios</a>
        </div>
        <div class="seccion bg-sky-600">
            <img class="img" src="assets/Roles.jpeg" alt="Ejemplo">
            <a href="modules/roles/index.php" class="btn">Roles</a>
        </div>
        <!-- <div class="seccion bg-sky-600">
            <img class="img" src="assets/Inventario.jpeg" alt="Ejemplo">
            <a href="modules/inventario/index.php" class="btn">Inventario</a>
        </div> -->
        <div class="seccion bg-sky-600">
            <img class="img" src="assets/Facturacion.jpeg" alt="Ejemplo">
            <a href="modules/facturacion/index.php" class="btn">Facturación</a>
        </div>
        <div class="seccion bg-sky-600">
            <img class="img" src="assets/Servicios.jpeg" alt="Ejemplo">
            <a href="modules/servicios/index.php" class="btn">Servicios</a>
        </div>
        <div class="seccion bg-sky-600">
            <img class="img" src="assets/Personal.jpeg" alt="Ejemplo">
            <a href="modules/personales/index.php" class="btn">Personales</a>
        </div>
        <div class="seccion bg-sky-600">
            <img class="img" src="assets/Pacientes.jpeg" alt="Ejemplo">
            <a href="modules/pacientes/index.php" class="btn">Pacientes</a>
        </div>
        <div class="seccion bg-sky-600">
            <img class="img" src="assets/Departamentos.png" alt="Ejemplo">
            <a href="modules/departamentos/index.php" class="btn">Departamentos</a>
        </div>
        <div class="seccion bg-sky-600">
            <img class="img" src="assets/especialidades.png" alt="Ejemplo">
            <a href="modules/especialidades/index.php" class="btn">Especialidades</a>
        </div>
        <div class="seccion bg-sky-600">
            <img class="img" src="assets/medicamentos.png" alt="Ejemplo">
            <a href="modules/medicamentos/index.php" class="btn">Medicamentos</a>
        </div>
    </div>
<?php
} else {
    header("Location: modules/usuarios/views/login.php");
    exit();
}

include_once "template/foot_template.php";
?>
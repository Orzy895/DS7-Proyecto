<?php
include_once "template/head_template.php";

if (isset($_SESSION['user'])) {
    
    $modulosPorRol = [
        'admin' => ['usuarios', 'roles', 'facturacion', 'servicios', 'personales', 'pacientes', 'departamentos', 'especialidades', 'medicamentos'],
        'medico' => ['pacientes'],
        'recepcionista' => ['facturacion', 'pacientes'],
        'farmacia' => ['medicamentos', 'facturacion'],
    ];

    $rolUsuario = $_SESSION['role'] ?? null;

    $modulos = [
        "usuarios" => ["label" => "Usuarios", "img" => "assets/Usuario.png"],
        "roles" => ["label" => "Roles", "img" => "assets/Roles.jpeg"],
        "facturacion" => ["label" => "Facturación", "img" => "assets/Facturacion.jpeg"],
        "servicios" => ["label" => "Servicios", "img" => "assets/Servicios.jpeg"],
        "personales" => ["label" => "Personales", "img" => "assets/Personal.jpeg"],
        "pacientes" => ["label" => "Pacientes", "img" => "assets/Pacientes.jpeg"],
        "departamentos" => ["label" => "Departamentos", "img" => "assets/Departamentos.png"],
        "especialidades" => ["label" => "Especialidades", "img" => "assets/especialidades.png"],
        "medicamentos" => ["label" => "Medicamentos", "img" => "assets/medicamentos.png"],
    ];
?>
    <div class="flex flex-row flex-wrap items-center justify-center">
        <?php
        foreach ($modulos as $modulo => $datos) {
            if (in_array($modulo, $modulosPorRol[$rolUsuario] ?? [])) {
                echo "
                <div class='seccion bg-sky-600'>
                    <img class='img' src='{$datos['img']}' alt='{$datos['label']}'>
                    <a href='modules/$modulo/index.php' class='btn'>{$datos['label']}</a>
                </div>
                ";
            }
        }
        ?>
    </div>
<?php
} else {
    header("Location: modules/usuarios/views/login.php");
    exit();
}

include_once "template/foot_template.php";
?>

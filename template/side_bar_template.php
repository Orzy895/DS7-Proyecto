<div class="w-56 h-screen bg-gray-900 pt-5 flex flex-col items-center flex-shrink-0">
    <?php
    $links = [
        "usuarios" => "Usuarios",
        "roles" => "Roles",
        "inventario" => "Inventario",
        "facturacion" => "Facturación",
        "servicios" => "Servicios",
        "personales" => "Personales",
        "pacientes" => "Pacientes",
        "departamentos" => "Departamentos",
        "especialidades" => "Especialidades"
    ];

    foreach ($links as $module => $label) {
        $activeClass = strpos($_SERVER["REQUEST_URI"], "/ds7-Proyecto/modules/$module/") !== false ? "bg-blue-900 text-white" : "text-gray-300 hover:bg-gray-700";
        echo "<a href='/ds7-Proyecto/modules/$module/index.php' class='px-4 py-2 rounded my-2 w-3/4 text-center $activeClass'>$label</a>";
    }
    ?>
</div>
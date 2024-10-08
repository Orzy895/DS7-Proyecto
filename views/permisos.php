<?php
include "../template/head_template.php"
?>
<form action="../process/process_perm.php" method="post" novalidate>
    <h2>Registro de Permisos</h2>

    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="desc">Descripción</label>
    <input type="text" id="desc" name="desc" required>

    <button type="submit">Agregar permiso</button>
</form>

<div id="permisos">
    <?php
    include '../process/process_get_perms.php';
    ?>
</div>
<?php
include "../template/foot_template.php"
?>
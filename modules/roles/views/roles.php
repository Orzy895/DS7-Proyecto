<?php
include_once "../../../template/head_template.php"
?>

<form action="../controllers/process_role.php" method="post" novalidate>
    <h2 class="text-center text-2xl font-bold mb-4">Roles</h2>

    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="desc">Descripción</label>
    <input type="text" id="desc" name="desc" required>

    <button type="submit" class="mt-4">Agregar rol</button>
</form>
<?php
include_once "../../../template/foot_template.php"

?>
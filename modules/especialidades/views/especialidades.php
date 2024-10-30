<?php
include "../../../template/head_template.php"
?>

<form action="../controllers/process_addEspecialidad.php" method="post" novalidate>
    <h2 class="text-center text-2xl font-bold mb-4">Agregar Especialidad Médica</h2>

    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="desc">Descripción</label>
    <input type="text" id="desc" name="desc" required>

    <button type="submit">Agregar especialidad</button>
</form>
<?php
include "../../../template/foot_template.php"

?>
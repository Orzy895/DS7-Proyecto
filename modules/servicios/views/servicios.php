<?php
include "../../../template/head_template.php"
?>

<form action="../controllers/process_addServicio.php" method="post" novalidate>
    <h2>Agregar Servicio</h2>

    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="precio">precio</label>
    <input type="number" id="precio" name="precio" step="0.01" min="0" required placeholder="0.00" required>

    <button type="submit">Agregar servicio</button>
</form>
<?php
include "../../../template/foot_template.php"

?>
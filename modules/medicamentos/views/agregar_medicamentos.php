<?php
include "../../../template/head_template.php"
?>

<form action="../controllers/process_agregarMedicamentos.php" method="post" novalidate>
    <h2 class="text-center text-2xl font-bold mb-4">Agregar Medicamento</h2>

    <label for="tipo">Tipo</label>
    <input type="text" id="tipo" name="tipo" required>

    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="cantidad">Cantidad</label>
    <input type="number" id="cantidad" name="cantidad" min="0" required placeholder="0" required>

    <label for="precio">precio</label>
    <input type="number" id="precio" name="precio" step="0.01" min="0" required placeholder="0.00" required>

    <button type="submit" class="mt-4">Agregar medicamento</button>
</form>
<?php
include "../../../template/foot_template.php"

?>
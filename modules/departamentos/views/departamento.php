<?php
include_once "../../../template/head_template.php"
?>

<form action="../controllers/process_addDepartamento.php" method="post" novalidate>
    <h2>Agregar Departamento</h2>

    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="desc">Descripción</label>
    <input type="text" id="desc" name="desc" required>

    <button type="submit">Agregar departamento</button>
</form>
<?php
include_once "../../../template/foot_template.php"

?>
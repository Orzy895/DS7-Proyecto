<?php
include "../../../template/head_template.php"
?>

<form action="../controllers/process_addPaciente.php" method="post" novalidate>
    <h2>Agregar Paciente</h2>

    <label for="nombre">Nombre: </label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="desc">Cédula: </label>
    <input type="text" id="cedula" name="cedula" required>

    <label for="dob">Fecha de Nacimiento:</label>
    <input type="date" id="dob" name="dob" required>

    <label for="historial">Historial: </label>
    <textarea name="historial" id="historial" rows="4" cols="50"></textarea>

    <label for="seguro">Seguro: </label>
    <input type="text" id="seguro" name="seguro">

    <button type="submit">Agregar paciente</button>
</form>
<?php
include "../../../template/foot_template.php"

?>
<?php
include_once "../template/head_template.php"
?>

<head>
    <title>Panel de Administración de Personal</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../scripts/personalAdmin.js"></script>
</head>

<h1 style="margin-bottom: 8%;">Panel de Administración de Personal</h1>

<div>
    <label for="usuario"><strong>Seleccionar Usuario:</strong></label>
    <select id="usuario" name="usuario">
        <option value="">Seleccione un usuario</option>
    </select>
</div>

<form id="addPersonal">
    <div>
        <label for="posicion"><strong>Posición:</strong></label>
        <input type="text" id="posicion" name="posicion" required>
    </div>
    <div>
        <label for="departamento"><strong>Departamento:</strong></label>
        <select id="departamento" name="departamento" required></select>
    </div>
    <button type="submit">Agregar Personal</button>
</form>
<p id="message"></p>

<?php
include_once '../template/foot_template.php'
?>
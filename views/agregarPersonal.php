<?php
include_once "../template/head_template.php"
?>

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../scripts/agregarPersonal.js"></script>
</head>

<h2 class="text-center text-2xl font-bold mb-4">Agregar Personal</h2>

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
    <div class="especialidades-container" style="display: none;">
        <label for="especialidades"><strong>Especialidades Médicas:</strong></label>
        <div id="especialidades">

        </div>
    </div>
    <button type="submit">Agregar Personal</button>
</form>
<p id="message"></p>

<?php
include_once '../template/foot_template.php'
?>
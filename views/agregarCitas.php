<?php
include_once "../template/head_template.php"
?>

<head>
    <title>Panel de Agendación de Cita Médica</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../scripts/agregarCita.js"></script>
</head>

<form id="form">
    <h2>Agregar Cita Médica</h2>

    <label for="servicio">Servicio: </label>
    <select id="servicio" name="servicio" required></select>

    <label for="paciente">Paciente: </label>
    <select id="paciente" name="paciente" required></select>

    <label for="medico">Médico: </label>
    <select id="medico" name="medico" required></select>

    <label for="tiempo">Fecha de Cita:</label>
    <input type="date" id="tiempo" name="tiempo" required>

    <label for="lugar">Lugar: </label>
    <input type="text" id="lugar" name="lugar">

    <button type="submit">Agregar cita</button>
</form>
<p id="message"></p>
<?php
include "../template/foot_template.php"

?>
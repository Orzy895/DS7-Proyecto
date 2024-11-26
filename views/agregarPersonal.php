<?php
include_once "../template/head_template.php"
?>

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../scripts/agregarPersonal.js"></script>
</head>

<h2 class="text-center text-2xl font-bold mb-4">Agregar Personal</h2>

<form id="addPersonal">
    <div class="mb-4">
        <label for="usuario"><strong>Seleccionar Usuario:</strong></label>
        <select id="usuario" name="usuario" class="">
            <option value="">Seleccione un usuario</option>
        </select>
    </div>
    <div class="mb-4">
        <label for="posicion"><strong>Posición:</strong></label>
        <input type="text" id="posicion" name="posicion" required>
    </div>
    <div class="mb-4">
        <label for="departamento"><strong>Departamento:</strong></label>
        <select id="departamento" name="departamento" required></select>
    </div>
    <div class="especialidades-container hidden mb-4">
        <label for="especialidades" class="mb-2"><strong>Especialidades Médicas:</strong></label>
        <div id="especialidades" class="grid grid-cols-3">
        </div>
    </div>
    <div class="mt-4">
        <label><strong>Horario:</strong></label>
        <div id="horario">
            <div class="flex mt-2 flex-col">
                <div>
                    <label>Selecciona los días:</label><br>
                    <div id="days-container" class="grid grid-cols-3">
                        <label class="day-item">
                            <input type="checkbox" name="days[]" value="Lunes"> Lunes
                        </label>
                        <label class="day-item">
                            <input type="checkbox" name="days[]" value="Martes"> Martes
                        </label>
                        <label class="day-item">
                            <input type="checkbox" name="days[]" value="Miercoles"> Miércoles
                        </label>
                        <label class="day-item">
                            <input type="checkbox" name="days[]" value="Jueves"> Jueves
                        </label>
                        <label class="day-item">
                            <input type="checkbox" name="days[]" value="Viernes"> Viernes
                        </label>
                        <label class="day-item">
                            <input type="checkbox" name="days[]" value="Sabado"> Sábado
                        </label>
                        <label class="day-item">
                            <input type="checkbox" name="days[]" value="Domingo"> Domingo
                        </label>
                    </div>
                </div>
                <div id="times-container">
                    <label>Hora de Entrada: </label>
                    <input type="time" name="start_time[]" class="mr-2">
                    <label>Hora de Salida: </label>
                    <input type="time" name="end_time[]" class="mr-2">
                </div>
            </div>
        </div>
    </div>


    <div class="mb-4 cant-container">
        <label for="max_citas"><strong>Máximo de Citas por Día:</strong></label>
        <input type="number" id="max_citas" name="max_citas" min="0">
    </div>

    <div class="flex justify-center mt-6">
        <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">Agregar Personal</button>
    </div>

</form>
<p id="message"></p>

<?php
include_once '../template/foot_template.php'
?>
<?php include "../../../template/head_template.php"; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/cita_detalle.js"></script>

<div class="container mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-4">Detalles de la Cita</h2>

    <div id="citaDetalle" class="bg-white shadow-md rounded-lg p-6 border border-gray-300">
        <p class="text-gray-700 mb-2" id="citaID"><strong>ID de Cita:</strong> Cargando...</p>
        <p class="text-gray-700 mb-2" id="citaTiempo"><strong>Fecha y Hora:</strong> Cargando...</p>
        <p class="text-gray-700 mb-2" id="citaLugar"><strong>Lugar:</strong> Cargando...</p>
        <p class="text-gray-700 mb-2" id="pacienteNombre"><strong>Paciente:</strong> Cargando...</p>
        <p class="text-gray-700 mb-2" id="medicoNombre"><strong>Médico:</strong> Cargando...</p>
        <p class="text-gray-700 mb-2" id="servicioNombre"><strong>Servicio:</strong> Cargando...</p>
        <div class="mb-4">
            <label for="citaDiagnostico" class="text-gray-700"><strong>Diagnóstico:</strong></label>
            <textarea id="citaDiagnostico" class="w-full mt-2 p-2 border border-gray-300 rounded" rows="4" placeholder="Escriba el diagnóstico aquí..."></textarea>
        </div>
        <div class="mb-4 flex gap-x-2 justify-end">
            <button id="btnGuardarDiagnostico" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
                Guardar Diagnóstico
            </button>
            <button id="btnAgregarReceta" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-700 transition">
                Agregar Receta
            </button>
        </div>
    </div>

    <div class="m-4 flex justify-between">
        <button id="btnReagendar" class="bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-700 transition">
            Reagendar Cita
        </button>
        <button id="btnAgregarServicio" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
            Agregar Servicio
        </button>
        <button id="btnFinalizar" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-700 transition">
            Finalizar Cita
        </button>
        <a href="../views/citas.php" class="inline-block bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-700 transition">
            Volver a la lista
        </a>
    </div>
</div>

<!--Reagendar cita-->
<div id="modalReagendar" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-md w-96">
        <h3 class="text-xl font-semibold mb-4">Reagendar Cita</h3>
        <label for="nuevaFecha" class="block mb-2">Nueva Fecha :</label>
        <input type="date" id="nuevaFecha" class="w-full border border-gray-300 p-2 rounded mb-4">
        <div class="flex justify-end gap-4">
            <button id="btnGuardarReagendar" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-700 transition">
                Guardar
            </button>
            <button id="btnCerrarReagendar" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-700 transition">
                Cancelar
            </button>
        </div>
    </div>
</div>

<!--Agregar servicio extra-->
<div id="modalAgregarServicio" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-md w-96">
        <h3 class="text-xl font-semibold mb-4">Agregar Servicio</h3>
        <label for="servicioSelect" class="block mb-2">Seleccione un Servicio:</label>
        <select id="servicioSelect" class="w-full border border-gray-300 p-2 rounded mb-4">
        </select>
        <div class="flex justify-end gap-4">
            <button id="btnGuardarServicio" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
                Guardar
            </button>
            <button id="btnCerrarAgregarServicio" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-700 transition">
                Cancelar
            </button>
        </div>
    </div>
</div>

<?php include "../../../template/foot_template.php"; ?>
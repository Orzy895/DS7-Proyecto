<?php include "../../../template/head_template.php"; ?>

<div class="container mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-4">Detalles de la Cita</h2>

    <div id="citaDetalle" class="bg-white shadow-md rounded-lg p-6 border border-gray-300">
        <p class="text-gray-700 mb-2" id="citaID"><strong>ID de Cita:</strong> Cargando...</p>
        <p class="text-gray-700 mb-2" id="citaTiempo"><strong>Fecha y Hora:</strong> Cargando...</p>
        <p class="text-gray-700 mb-2" id="citaLugar"><strong>Lugar:</strong> Cargando...</p>
        <p class="text-gray-700 mb-2" id="pacienteNombre"><strong>Paciente:</strong> Cargando...</p>
        <p class="text-gray-700 mb-2" id="medicoNombre"><strong>Médico:</strong> Cargando...</p>
        <p class="text-gray-700 mb-2" id="servicioNombre"><strong>Servicio:</strong> Cargando...</p>
        <p class="text-gray-700 mb-2" id="citaDiagnostico"><strong>Diagnóstico:</strong> Cargando...</p>
    </div>

    <a href="../views/citas.php" class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
        Volver a la lista
    </a>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        const urlParams = new URLSearchParams(window.location.search);
        const citaId = urlParams.get('cita_id');

        if (citaId) {
            $("#citaDetalle").addClass("opacity-50");

            $.ajax({
                url: "../controllers/process_getCita.php",
                type: "GET",
                data: { cita_id: citaId },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        const cita = response.data;
                        $("#citaID").html(`<strong>ID de Cita:</strong> ${cita.cita_id}`);
                        $("#citaTiempo").html(`<strong>Fecha y Hora:</strong> ${cita.tiempo}`);
                        $("#citaLugar").html(`<strong>Lugar:</strong> ${cita.lugar}`);
                        $("#pacienteNombre").html(`<strong>Paciente:</strong> ${cita.paciente_nombre} (${cita.paciente_cedula})`);
                        $("#medicoNombre").html(`<strong>Médico:</strong> ${cita.medico_nombre}`);
                        $("#servicioNombre").html(`<strong>Servicio:</strong> ${cita.servicio_nombre}`);
                        $("#citaDiagnostico").html(`<strong>Diagnóstico:</strong> ${cita.diagnostico || ""}`);
                        $("#citaDetalle").removeClass("opacity-50");
                    } else {
                        $("#citaDetalle").html(`<p class="text-red-500">${response.message}</p>`);
                    }
                },
                error: function () {
                    $("#citaDetalle").html(`<p class="text-red-500">Error al cargar los detalles de la cita.</p>`);
                }
            });
        } else {
            $("#citaDetalle").html(`<p class="text-red-500">ID de cita no proporcionado.</p>`);
        }
    });
</script>

<?php include "../../../template/foot_template.php"; ?>

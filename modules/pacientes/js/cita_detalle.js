$(document).ready(function () {
    const urlParams = new URLSearchParams(window.location.search);
    const citaId = urlParams.get('cita_id');
    setMinDate();

    //Cargar detalles de cita
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
                    console.log(cita);
                    $("#citaID").html(`<strong>ID de Cita:</strong> ${cita.cita_id}`);
                    $("#citaTiempo").html(`<strong>Fecha y Hora:</strong> ${cita.tiempo}`);
                    $("#citaLugar").html(`<strong>Lugar:</strong> ${cita.lugar}`);
                    $("#pacienteNombre").html(`<strong>Paciente:</strong> ${cita.paciente_nombre} (${cita.paciente_cedula})`);
                    $("#medicoNombre").html(`<strong>Médico:</strong> ${cita.medico_nombre}`);
                    $("#servicioNombre").html(`<strong>Servicio:</strong> ${cita.servicios_nombre}`);
                    $("#citaDiagnostico").val(cita.diagnostico || "");
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

    //Reagendar cita
    $("#btnReagendar").click(function () {
        $("#modalReagendar").removeClass("hidden");
    });
    $("#btnCerrarReagendar").click(function () {
        $("#modalReagendar").addClass("hidden");
    });
    $("#btnGuardarReagendar").click(function () {
        const nuevaFecha = $("#nuevaFecha").val();
        if (nuevaFecha) {
            $.ajax({
                url: "../controllers/process_reagendarCita.php",
                type: "POST",
                data: { cita_id: citaId, nueva_fecha: nuevaFecha },
                success: function (response) {
                    alert("Cita reagendada exitosamente.");
                    location.reload();
                },
                error: function () {
                    alert(response.message);
                }
            });
        } else {
            alert("Debe seleccionar una nueva fecha.");
        }
    });

    //Finalizar cita
    $("#btnFinalizar").click(function () {
        const confirmar = confirm("¿Está seguro de que desea finalizar esta cita?");
        if (confirmar) {
            $.ajax({
                url: "../controllers/process_finalizarCita.php",
                type: "POST",
                data: { cita_id: citaId },
                success: function () {
                    alert("Cita finalizada exitosamente.");
                },
                error: function () {
                    alert("Error al finalizar la cita.");
                }
            });
        }
    });

    //Obtener servicios
    $("#btnAgregarServicio").click(function () {
        $("#modalAgregarServicio").removeClass("hidden");
        $("#servicioSelect").empty();

        $.ajax({
            url: "../../servicios/controllers/process_getServicios.php",
            type: "GET",
            dataType: "json",
            success: function (response) {
                if (response.length > 0) {
                    response.forEach(servicio => {
                        if (servicio.id && servicio.nombre) {
                            $("#servicioSelect").append(
                                `<option value="${servicio.id}">${servicio.nombre}</option>`
                            );
                        }
                    });
                } else {
                    alert("No se encontraron servicios.");
                }
            },
            error: function () {
                alert("Error al cargar los servicios.");
            }
        });
    });

    $("#btnCerrarAgregarServicio").click(function () {
        $("#modalAgregarServicio").addClass("hidden");
    });

    //Guardar nuevo servicio
    $("#btnGuardarServicio").click(function () {
        const servicioId = $("#servicioSelect").val();
        if (servicioId) {
            $.ajax({
                url: "../controllers/process_addCitaServicio.php",
                type: "POST",
                data: { cita_id: citaId, servicio_id: servicioId },
                success: function () {
                    alert("Servicio agregado exitosamente.");
                    location.reload();
                },
                error: function () {
                    alert("Error al agregar el servicio.");
                }
            });
        } else {
            alert("Debe seleccionar un servicio y especificar una cantidad válida.");
        }
    });

    //Guardar diagnostico
    $("#btnGuardarDiagnostico").click(function () {
        const diagnostico = $("#citaDiagnostico").val();
        $.ajax({
            url: "../controllers/process_addDiagnostico.php",
            type: "POST",
            data: { cita_id: citaId, diagnostico: diagnostico },
            success: function () {
                alert("Diagnostico agregado");
            },
            error: function () {
                alert("Error al agregar diagnóstico.")
            }
        })
    });

    function setMinDate() {
        var hoy = new Date();
        var dd = String(hoy.getDate()).padStart(2, '0');
        var mm = String(hoy.getMonth() + 1).padStart(2, '0');
        var yyyy = hoy.getFullYear();
        hoy = yyyy + '-' + mm + '-' + dd;
        $('#nuevaFecha').attr('min', hoy);
    }

});
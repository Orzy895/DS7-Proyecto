$(document).ready(function () {
    const facturaContainer = $("#facturaContainer");
    const facturaTableBody = $("#facturaTableBody");
    const totalFactura = $("#totalFactura");
    const loadingMessage = $("#loadingMessage");
    const errorMessage = $("#errorMessage");
    const proceedToPayButton = $("#proceedToPay");

    const citaId = new URLSearchParams(window.location.search).get("cita_id");

    let pacienteNombre = '';
    let pacienteCorreo = '';
    let facturaDetalles = [];

    if (!citaId) {
        errorMessage.removeClass("hidden").text("No se proporcionó un ID de cita.");
        return;
    }

    function loadFacturaDetails() {
        loadingMessage.removeClass("hidden");
        facturaContainer.addClass("hidden");
        errorMessage.addClass("hidden");

        $.ajax({
            url: "../../pacientes/controllers/process_getPaciente.php",
            type: "GET",
            data: { cita_id: citaId },
            dataType: "json",
            success: function (response) {
                pacienteNombre = response.nombre;
                pacienteCorreo = response.correo;
            },
            error: function () {
                loadingMessage.addClass("hidden");
                errorMessage.removeClass("hidden").text("Error al cargar los datos del paciente.");
            },
        });

        $.ajax({
            url: "../controllers/process_obtenerTotalCita.php",
            type: "GET",
            data: { cita_id: citaId },
            dataType: "json",
            success: function (response) {
                loadingMessage.addClass("hidden");

                if (response.success) {
                    let total = 0;
                    facturaTableBody.empty();
                    facturaDetalles = response.data;

                    response.data.forEach((detalle) => {
                        const row = `
                            <tr>
                                <td class="px-4 py-2">${detalle.nombre}</td>
                                <td class="px-4 py-2 text-right">${detalle.costo_unitario}$</td>
                                <td class="px-4 py-2 text-right">${detalle.cantidad}</td>
                                <td class="px-4 py-2 text-right">${detalle.total}$</td>
                            </tr>
                        `;
                        total += parseFloat(detalle.total);
                        facturaTableBody.append(row);
                    });

                    totalFactura.text(`${total.toFixed(2)}$`);
                    facturaContainer.removeClass("hidden");
                } else {
                    errorMessage.removeClass("hidden").text(response.message || "No se encontraron datos.");
                }
            },
            error: function () {
                loadingMessage.addClass("hidden");
                errorMessage.removeClass("hidden").text("Error al cargar los detalles de la factura.");
            },
        });
    }

    proceedToPayButton.on("click", function () {

        $.ajax({
            url: "../controllers/process_addFactura.php",
            type: "POST",
            data: {
                cliente_id: citaId,
                total: totalFactura.text().replace('$', ''),
                detalles: JSON.stringify(facturaDetalles),
            },
            success: function (response) {
                if (response) {
                    $.ajax({
                        url: "../controllers/process_cambioCitaPago.php",
                        type: "POST",
                        data: { cita_id: citaId },
                        success: function () {
                            $.ajax({
                                url: "../../../phpmailer-testing/phpmailer.controller.php",
                                type: "POST",
                                data: {
                                    nombre: pacienteNombre,
                                    correo: pacienteCorreo,
                                    factura: facturaDetalles,
                                },
                                success: function (response) {
                                    alert("Pago realizado.");
                                },
                                error: function () {
                                    alert("Error al enviar la factura por correo.");
                                },
                            });
                        },
                        error: function () {
                            alert("Error al finalizar la cita.");
                        }
                    });
                }
            },
            error: function (xhr, status, error) {
                alert("Hubo un error al guardar la factura: " + error);
            }
        });
    });

    loadFacturaDetails();
});

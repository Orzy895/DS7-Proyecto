$(document).ready(function() {
    $.ajax({
        url: "../../medicamentos/controllers/process_getMedicamentos.php",
        method: "GET",
        dataType: "json",
        success: function(data) {
            let tableBody = $("#medicamentosTable tbody");
            tableBody.empty();
            data.forEach(medicamento => {
                tableBody.append(`
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">${medicamento.nombre}</td>
                        <td class="border border-gray-300 px-4 py-2">${medicamento.tipo}</td>
                        <td class="border border-gray-300 px-4 py-2">${medicamento.cantidad}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <input type="number" name="medicamentos[${medicamento.id}]" min="0" max="${medicamento.cantidad}" value="0" class="border border-gray-300 rounded px-2 py-1 w-20">
                        </td>
                    </tr>
                `);
            });
        },
        error: function(xhr, status, error) {
            console.error("Error al obtener medicamentos:", error);
        }
    });

    $("#formReceta").submit(function(event) {
        $("#medicamentosTable input[type='number']").each(function() {
            let input = $(this);
            let quantity = parseInt(input.val());

            if (quantity <= 0) {
                input.prop("disabled", true);
            } else {
                input.prop("disabled", false);
            }
        });
    });
});

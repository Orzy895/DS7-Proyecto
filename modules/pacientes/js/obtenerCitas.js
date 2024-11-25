$(document).ready(function () {
  loadCitas();

  function loadCitas() {
    $.ajax({
      url: "../controllers/process_getCitas.php",
      type: "GET",
      dataType: "json",
      success: function (response) {
        if (response.success) {
          const citasTable = $("#citasTable tbody");
          citasTable.empty();

          response.data.forEach(function (cita) {
            const row = `
              <tr>
                <td>${cita.tiempo}</td>
                <td>${cita.lugar}</td>
                <td>${cita.paciente_nombre} (${cita.paciente_cedula})</td>
                <td>${cita.medico_nombre}</td>
                <td class="px-4 py-2 text-center">
                  <a href="cita_detalle.php?cita_id=${cita.cita_id}" 
                     class="bg-blue-500 text-white text-xs font-semibold py-1 px-3 rounded hover:bg-blue-700 transition">
                    Ver Detalles
                  </a>
                </td>
              </tr>
            `;
            citasTable.append(row);
          });
        } else {
          alert(response.message);
        }
      },
      error: function () {
        alert("Error al cargar las citas.");
      },
    });
  }
});

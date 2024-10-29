$(document).ready(function () {
  loadMedics();
  loadPatients();
  loadServices();
  setMinDate();

  $("#form").on("submit", function (e) {
    e.preventDefault();

    var userData = {
      servicio: $("#servicio").val(),
      paciente: $("#paciente").val(),
      medico: $("#medico").val(),
      tiempo: $("#tiempo").val(),
      lugar: $("#lugar").val()
    };

    $.ajax({
      url: "../modules/pacientes/controllers/process_addCitas.php",
      type: "POST",
      data: userData,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          $("#message").text("Cita agendada con éxito.");
        } else {
          $("#message").text("Error al agendar la cita.");
        }
      },
      error: function () {
        $("#message").text("Error en la solicitud de creación de la cita.");
      }
    });
  });

  function loadMedics() {
    $.ajax({
      url: "../modules/personales/controllers/process_getMedicos.php",
      type: "GET",
      dataType: "json",
      success: function (data) {
        $("#medico")
          .empty()
          .append('<option value="">Seleccione un médico</option>');
        if (data && data.length > 0) {
          data.forEach(function (medico) {
            $("#medico").append(
              `<option value="${medico.id}">${medico.nombre}</option>`
            );
          });
        } else {
          $("#usuario").append("<option>No se encontraron médicos.</option>");
        }
      },
      error: function () {
        $("#message").text("Error en la solicitud de médicos.");
      },
    });
  }

  function loadPatients() {
    $.ajax({
      url: "../modules/pacientes/controllers/process_getPacientes.php",
      type: "GET",
      dataType: "json",
      success: function (data) {
        $("#paciente")
          .empty()
          .append('<option value="">Seleccione un paciente</option>');
        if (data && data.length > 0) {
          data.forEach(function (paciente) {
            $("#paciente").append(
              `<option value="${paciente.id}">${paciente.nombre}</option>`
            );
          });
        } else {
          $("#paciente").append("<option>No se encontraron pacientes.</option>");
        }
      },
      error: function () {
        $("#message").text("Error en la solicitud de pacientes.");
      },
    });
  }

  function loadServices() {
    $.ajax({
      url: "../modules/servicios/controllers/process_getServicios.php",
      type: "GET",
      dataType: "json",
      success: function (data) {
        $("#servicio")
          .empty()
          .append('<option value="">Seleccione un servicio</option>');
        if (data && data.length > 0) {
          data.forEach(function (service) {
            $("#servicio").append(
              `<option value="${service.id}">${service.nombre}</option>`
            );
          });
        } else {
          $("#servicio").append("<option>No se encontraron servicios.</option>");
        }
      },
      error: function () {
        $("#message").text("Error en la solicitud de servicios.");
      },
    });
  }

  function setMinDate() {
    var hoy = new Date();
    var dd = String(hoy.getDate()).padStart(2, '0');
    var mm = String(hoy.getMonth() + 1).padStart(2, '0');
    var yyyy = hoy.getFullYear();
    hoy = yyyy + '-' + mm + '-' + dd;
    $('#tiempo').attr('min', hoy);
  }
});

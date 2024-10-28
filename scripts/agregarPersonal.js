$(document).ready(function () {
  $(".especialidades-container").hide();
  loadUsers();
  loadDepartamentos();
  loadEspecialidades();

  $("#userList").on("change", function () {
    var userId = $(this).val();
    if (userId) {
      fetchUserDetails(userId);
    } else {
      clearUserDetails();
    }
  });

  function loadUsers() {
    $.ajax({
      url: "../modules/usuarios/controllers/process_getUsers.php",
      type: "GET",
      dataType: "json",
      success: function (data) {
        $("#usuario")
          .empty()
          .append('<option value="">Seleccione un usuario</option>');
        if (data && data.length > 0) {
          data.forEach(function (user) {
            $("#usuario").append(
              `<option value="${user.id}">${user.nombre} - ${user.email}</option>`
            );
          });
        } else {
          $("#usuario").append("<option>No se encontraron usuarios.</option>");
        }
      },
      error: function () {
        $("#message").text("Error en la solicitud de usuarios.");
      },
    });
  }

  function loadDepartamentos() {
    $.ajax({
      url: "../modules/departamentos/controllers/process_getDepartamentos.php",
      type: "GET",
      dataType: "json",
      success: function (departamentos) {
        if (departamentos && !departamentos.error) {
          departamentos.forEach(function (departamento) {
            $("#departamento").append(new Option(departamento.nombre, departamento.id));
          });
          $("#departamento").on("change", toggleEspecialidades);
        } else {
          $("#message").text("Error al obtener los departamentos.");
        }
      },
      error: function () {
        $("#message").text("Error en la solicitud de departamentos.");
      },
    });
  }

  function loadEspecialidades() {
    $.ajax({
      url: "../modules/especialidades/controllers/process_getEspecialidades.php",
      type: "GET",
      dataType: "json",
      success: function (especialidades) {
        if (especialidades && !especialidades.error) {
          $("#especialidades").empty();
          especialidades.forEach(function (especialidad) {
            $("#especialidades").append(`
                          <label>
                              <input type="checkbox" name="especialidades[]" value="${especialidad.id}"> ${especialidad.nombre}
                          </label><br>
                      `);
          });
        } else {
          $("#message").text("Error al obtener las especialidades.");
        }
      },
      error: function () {
        $("#message").text("Error en la solicitud de especialidades.");
      },
    });
  }

  function toggleEspecialidades() {
    const selectedDept = $("#departamento option:selected").text();
    if (selectedDept === "Ventas" || selectedDept === "Farmacia") {
      $(".especialidades-container").hide();
    } else {
      $(".especialidades-container").show();
    }
  }

  $("#addPersonal").on("submit", function (e) {
    e.preventDefault();

    var userData = {
      posicion: $("#posicion").val(),
      departamento: $("#departamento").val(),
      usuario: $("#usuario").val(),
    };

    $.ajax({
      url: "../modules/personales/controllers/process_addPersonal.php",
      type: "POST",
      data: userData,
      dataType: "json",
      success: function (response) {
        if (response.success && response.userId) {
          $("#message").text("Usuario creado con éxito.");

          var especialidades = [];
          $("input[name='especialidades[]']:checked").each(function () {
            especialidades.push($(this).val());
          });

          $.ajax({
            url: "../modules/personales/controllers/process_addEspecialidadesMedicas.php",
            type: "POST",
            data: {
              usuario: response.userId,
              especialidades: especialidades
            },
            dataType: "json",
            success: function (especialidadResponse) {
              if (especialidadResponse.success) {
                $("#message").text("Especialidades añadidas con éxito.");
              } else {
                $("#message").text("Error al añadir especialidades.");
              }
            },
            error: function () {
              $("#message").text("Error en la solicitud de especialidades.");
            }
          });
        } else {
          $("#message").text("Error al crear el usuario.");
        }
      },
      error: function () {
        $("#message").text("Error en la solicitud de creación del usuario.");
      }
    });
  });

  toggleEspecialidades();
});

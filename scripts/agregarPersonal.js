$(document).ready(function () {
  $(".especialidades-container").hide();
  $(".cant-container").hide()
  loadUsers();
  loadDepartamentos();
  loadEspecialidades();
  let medico = false;

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
        alert("Error en la solicitud de usuarios.");
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
          alert("Error al obtener los departamentos.")
        }
      },
      error: function () {
        alert("Error en la solicitud de departamentos.");
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
              <label class="especialidad-item">
                <input type="checkbox" name="especialidades[]" value="${especialidad.id}"> ${especialidad.nombre}
              </label>
            `);
          });
        } else {
          alert("Error al obtener las especialidades.");
        }
      },
      error: function () {
        alert("Error en la solicitud de especialidades.");
      },
    });
  }

  function toggleEspecialidades() {
    const selectedDept = $("#departamento option:selected").text();
    if (selectedDept === "Ventas" || selectedDept === "Farmacia") {
      $(".especialidades-container").hide();
      $(".cant-container").hide()
      $(".times-container").hide();
      medico = false;
    } else {
      $(".cant-container").show()
      $(".especialidades-container").show();
      $(".times-container").show();
      medico = true;
    }
  }

  $("#addPersonal").on("submit", function (e) {
    e.preventDefault();

    var userData = {
      posicion: $("#posicion").val(),
      departamento: $("#departamento").val(),
      usuario: $("#usuario").val(),
      horario: [],
      max_citas: $("#max_citas").val()
    };

    var startTime = $("input[name='start_time[]']").val();
    var endTime = $("input[name='end_time[]']").val();

    $("input[name='days[]']:checked").each(function () {
      var day = $(this).val();

      userData.horario.push({
        day: day,
        start_time: startTime,
        end_time: endTime
      });
    });

    $.ajax({
      url: "../modules/personales/controllers/process_addPersonal.php",
      type: "POST",
      data: userData,
      dataType: "json",
      success: function (response) {
        if (response.success && response.userId) {
          alert("Usuario creado con éxito.");

          var especialidades = [];
          $("input[name='especialidades[]']:checked").each(function () {
            especialidades.push($(this).val());
          });

          if (medico) {
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

                } else {
                  alert("Error al añadir especialidades.");
                }
              },
              error: function () {
                alert("Error en la agregación de especialidades.");
              }
            });

            $.ajax({
              url: "../modules/personales/controllers/process_addHorario.php",
              type: "POST",
              data: {
                usuario: response.userId,
                horario: userData.horario,
                max_citas: userData.max_citas
              },
              dataType: "json",
              success: function (horarioResponse) {
                if (horarioResponse.success) {

                } else {
                  alert("Error al añadir horario.");
                }
              },
              error: function () {
                alert("Error en la agregación de horario.");
              }
            });
          }
          alert("Usuario creado con éxito")
        } else {
          alert("Error al crear el usuario.");
        }
      },
      error: function () {
        alert("Error en la solicitud de creación del usuario.");
      }
    });
  });


});

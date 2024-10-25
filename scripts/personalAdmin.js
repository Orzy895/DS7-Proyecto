$(document).ready(function () {
    loadUsers();
    loadDepartamentos();
  
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
          } else {
            $("#message").text("Error al obtener los departamentos.");
          }
        },
        error: function () {
          $("#message").text("Error en la solicitud de departamentos.");
        },
      });
    }
  
    $("#addPersonal").on("submit", function (e) {
      e.preventDefault();
  
      var formData = {
        posicion: $("#posicion").val(),
        departamento: $("#departamento").val(),
        usuario: $("#usuario").val(),
      };

      console.log(formData);
      
      $.ajax({
        url: "../modules/personales/controllers/process_addPersonal.php",
        type: "POST",
        data: formData,
        dataType: "json",
        success: function (response) {
          if (response.success) {
            $("#message").text("Personal añadido.");
          } else {
            $("#message").text("Error al añadir personal.");
          }
        },
        error: function () {
          $("#message").text("Error en la solicitud.");
        },
      });
    });
  
  });
  
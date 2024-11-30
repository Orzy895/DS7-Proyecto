$(document).ready(function () {
  loadUsers();
  loadRoles();

  $("#userList").on("change", function () {
    var userId = $(this).val();
    if (userId) {
      fetchUserDetails(userId);
    } else {
      clearUserDetails();
    }
  });

  function fetchUserDetails(userId) {
    $.ajax({
      url: "../../usuarios/controllers/process_getUser.php",
      type: "GET",
      data: { id: userId },
      dataType: "json",
      success: function (data) {
        if (data && !data.error) {
          $("#nombre").val(data.nombre);
          $("#email").val(data.email);
          $("#cedula").val(data.cedula);
          $("#role").val(data.role_id);
        } else {
          alert("Error al obtener los datos del usuario.");
        }
      },
      error: function () {
        alert("Error en la solicitud de datos.");
      },
    });
  }

  function clearUserDetails() {
    $("#nombre").val("");
    $("#email").val("");
    $("#cedula").val("");
    $("#role").val("");
  }

  function loadUsers() {
    $.ajax({
      url: "../../usuarios/controllers/process_getUsers.php",
      type: "GET",
      dataType: "json",
      success: function (data) {
        $("#userList")
          .empty()
          .append('<option value="">Seleccione un usuario</option>');
        if (data && data.length > 0) {
          data.forEach(function (user) {
            $("#userList").append(
              `<option value="${user.id}">${user.nombre} - ${user.email}</option>`
            );
          });
        } else {
          $("#userList").append("<option>No se encontraron usuarios.</option>");
        }
      },
      error: function () {
        alert("Error en la solicitud de usuarios.");
      },
    });
  }

  function loadRoles() {
    $.ajax({
      url: "/ds7-Proyecto/modules/roles/controllers/process_getRoles.php",
      type: "GET",
      dataType: "json",
      success: function (roles) {
        if (roles && !roles.error) {
          roles.forEach(function (role) {
            $("#role").append(new Option(role.nombre, role.id));
          });
        } else {
          alert("Error al obtener los roles.");
        }
      },
      error: function () {
        alert("Error en la solicitud de roles.");
      },
    });
  }

  $("#updateProfileForm").on("submit", function (e) {
    e.preventDefault();

    var formData = {
      nombre: $("#nombre").val(),
      email: $("#email").val(),
      cedula: $("#cedula").val(),
      role: $("#role").val(),
      userId: $("#userList").val(),
    };

    $.ajax({
      url: "../../usuarios/controllers/process_editUser.php",
      type: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          alert("Perfil actualizado.");
        } else {
          alert("Error al actualizar el perfil.");
        }
      },
      error: function () {
        alert("Error en la solicitud.");
      },
    });
  });

  $("#deleteUserButton").on("click", function () {
    var userId = $("#userList").val();
    if (userId) {
      deleteUser(userId);
    } else {
      alert("Seleccione un usuario para eliminar.");
    }
  });

  function deleteUser(userId) {
    $.ajax({
      url: "../../usuarios/controllers/process_deleteUser.php",
      type: "POST",
      data: { id: userId },
      dataType: "json",
      success: function (response) {
        if (response.success) {
          alert("Usuario eliminado.");
          loadUsers();
          clearUserDetails();
        } else {
          alert("Error al eliminar el usuario.");
        }
      },
      error: function () {
        alert("Error en la solicitud de eliminación.");
      },
    });
  }
});

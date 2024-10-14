$(document).ready(function () {

    loadUsers();
    loadRoles();

    $('#userList').on('change', function () {
        var userId = $(this).val();
        if (userId) {
            fetchUserDetails(userId);
        } else {
            clearUserDetails();
        }
    });

    function fetchUserDetails(userId) {
        $.ajax({
            url: '../process/module_users/process_getUser.php',
            type: 'GET',
            data: { id: userId },
            dataType: 'json',
            success: function (data) {
                if (data && !data.error) {
                    $('#nombre').val(data.nombre);
                    $('#email').val(data.email);
                    $('#cedula').val(data.cedula);
                    $('#role').val(data.role_id);
                } else {
                    $('#message').text("Error al obtener los datos del usuario.");
                }
            },
            error: function () {
                $('#message').text("Error en la solicitud de datos.");
            }
        });
    }

    function clearUserDetails() {
        $('#nombre').val('');
        $('#email').val('');
        $('#cedula').val('');
        $('#role').val('');
    }

    function loadUsers() {
        $.ajax({
            url: '../process/module_users/process_getUsers.php',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                $('#userList').empty().append('<option value="">Seleccione un usuario</option>');
                if (data && data.length > 0) {
                    data.forEach(function (user) {
                        $('#userList').append(`<option value="${user.id}">${user.nombre} - ${user.email}</option>`);
                    });
                } else {
                    $('#userList').append('<option>No se encontraron usuarios.</option>');
                }
            },
            error: function () {
                $('#message').text("Error en la solicitud de usuarios.");
            }
        });
    }

    function loadRoles() {
        $.ajax({
            url: '../process/process_getRoles.php',
            type: 'GET',
            dataType: 'json',
            success: function (roles) {
                if (roles && !roles.error) {
                    roles.forEach(function (role) {
                        $('#role').append(new Option(role.nombre, role.id));
                    });
                } else {
                    $('#message').text("Error al obtener los roles.");
                }
            },
            error: function () {
                $('#message').text("Error en la solicitud de roles.");
            }
        });
    }

    $('#updateProfileForm').on('submit', function (e) {
        e.preventDefault();

        var formData = {
            nombre: $('#nombre').val(),
            email: $('#email').val(),
            cedula: $('#cedula').val(),
            role: $('#role').val(),
            userId: $('#userList').val()
        };

        $.ajax({
            url: '../process/module_users/process_editUser.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    $('#message').text("Perfil actualizado.");
                } else {
                    $('#message').text("Error al actualizar el perfil.");
                }
            },
            error: function () {
                $('#message').text("Error en la solicitud.");
            }
        });
    });

    $('#deleteUserButton').on('click', function () {
        var userId = $('#userList').val();
        if (userId) {
            deleteUser(userId);
        } else {
            $('#message').text("Seleccione un usuario para eliminar.");
        }
    });

    function deleteUser(userId) {
        $.ajax({
            url: '../process/module_users/process_deleteUser.php',
            type: 'POST',
            data: { id: userId },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    $('#message').text("Usuario eliminado.");
                    loadUsers();
                    clearUserDetails();
                } else {
                    $('#message').text("Error al eliminar el usuario.");
                }
            },
            error: function () {
                $('#message').text("Error en la solicitud de eliminación.");
            }
        });
    }
});

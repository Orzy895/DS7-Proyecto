<?php
include_once "../template/head_template.php";
?>

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../scripts/userAdmin.js"></script>
</head>

<body class="bg-gray-100">

    <div class="container mx-auto p-6">
        <h2 class="text-center text-3xl font-bold text-gray-800 mb-6">Panel de Administración de Usuario</h2>

        <div class="mb-6 max-w-xl mx-auto">
            <label for="userList" class="block text-lg font-semibold text-gray-700"><strong>Seleccionar Usuario:</strong></label>
            <select id="userList" name="userList" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                <option value="">Seleccione un usuario</option>
            </select>
        </div>

        <form id="updateProfileForm" class="space-y-6 max-w-xl mx-auto bg-white p-6 rounded-lg shadow-lg">
            <div>
                <label for="nombre" class="block font-semibold text-gray-700">Nombre</label>
                <input type="text" id="nombre" name="nombre" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="email" class="block font-semibold text-gray-700">Email</label>
                <input type="email" id="email" name="email" readonly class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed">
            </div>

            <div>
                <label for="cedula" class="block font-semibold text-gray-700">Cédula</label>
                <input type="text" id="cedula" name="cedula" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="role" class="block font-semibold text-gray-700">Role</label>
                <select id="role" name="role" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"></select>
            </div>

            <div class="flex justify-between mt-6">
                <button type="button" id="deleteUserButton" class="bg-red-500 text-white py-2 px-6 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400">Eliminar Usuario</button>

                <button type="submit" class="bg-blue-500 text-white py-2 px-6 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">Actualizar Usuario</button>
            </div>
        </form>
        <p id="message" class="mt-4 text-center text-green-500"></p>
    </div>

</body>

<?php
include_once '../template/foot_template.php';
?>
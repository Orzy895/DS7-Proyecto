<?php
include "../../../template/head_template.php";
?>

<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Lista de Medicamentos</h2>
    <div id="message" class="text-red-500 mb-4"></div>
    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2 px-4 border">ID</th>
                <th class="py-2 px-4 border">Tipo</th>
                <th class="py-2 px-4 border">Nombre</th>
                <th class="py-2 px-4 border">Cantidad</th>
                <th class="py-2 px-4 border">Precio</th>
                <th class="py-2 px-4 border">Acciones</th>
            </tr>
        </thead>
        <tbody id="medicamentosTableBody">
            <!-- Medicamentos data will be inserted here -->
        </tbody>
    </table>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded shadow-md w-full max-w-md">
        <form id="editMedicamentoForm">
            <h2 class="text-center text-2xl font-bold mb-4">Editar Medicamento</h2>

            <input type="hidden" id="editId">
            <label for="editTipo">Tipo</label>
            <input type="text" id="editTipo" name="tipo" required>

            <label for="editNombre">Nombre</label>
            <input type="text" id="editNombre" name="nombre" required>

            <label for="editCantidad">Cantidad</label>
            <input type="number" id="editCantidad" name="cantidad" required>

            <label for="editPrecio">Precio</label>
            <input type="number" id="editPrecio" name="precio" step="0.01" min="0" required>

            <div class="flex items-center justify-between mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700">Guardar</button>
                <button type="button" id="cancelEditButton" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-700">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('../controllers/process_getMedicamentos.php')
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    document.getElementById('message').textContent = data.error;
                } else if (data.message) {
                    document.getElementById('message').textContent = data.message;
                } else {
                    const tableBody = document.getElementById('medicamentosTableBody');
                    data.forEach(medicamento => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                        <td class="py-2 px-4 border">${medicamento.id}</td>
                        <td class="py-2 px-4 border">${medicamento.tipo}</td>
                        <td class="py-2 px-4 border">${medicamento.nombre}</td>
                        <td class="py-2 px-4 border">${medicamento.cantidad}</td>
                        <td class="py-2 px-4 border">${medicamento.precio}</td>
                        <td class="py-2 px-4 border">
                            <button class="bg-blue-500 text-white px-2 py-1 rounded-md hover:bg-blue-700 w-full" onclick="editMedicamento(${medicamento.id}, '${medicamento.tipo}', '${medicamento.nombre}', ${medicamento.cantidad}, ${medicamento.precio})">Editar</button>
                        </td>
                    `;
                        tableBody.appendChild(row);
                    });
                }
            })
            .catch(error => {
                document.getElementById('message').textContent = 'Error en la solicitud de datos.';
            });
    });

    function editMedicamento(id, tipo, nombre, cantidad, precio) {
        document.getElementById('editId').value = id;
        document.getElementById('editTipo').value = tipo;
        document.getElementById('editNombre').value = nombre;
        document.getElementById('editCantidad').value = cantidad;
        document.getElementById('editPrecio').value = precio;
        document.getElementById('editModal').classList.remove('hidden');
    }

    document.getElementById('editMedicamentoForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        formData.append('id', document.getElementById('editId').value);
        fetch('../controllers/process_editarMedicamentos.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('message').textContent = 'Medicamento actualizado.';
                    document.getElementById('editModal').classList.add('hidden');
                    location.reload(); // Reload the page to see the updated data
                } else {
                    document.getElementById('message').textContent = 'Error al actualizar el medicamento.';
                }
            })
            .catch(() => {
                document.getElementById('message').textContent = 'Error en la solicitud.';
            });
    });

    document.getElementById('cancelEditButton').addEventListener('click', function() {
        document.getElementById('editModal').classList.add('hidden');
    });
</script>

<?php
include "../../../template/foot_template.php";
?>
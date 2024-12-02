<?php
include "../../../template/head_template.php";

$cita_id = isset($_GET['cita_id']) ? $_GET['cita_id'] : null;

if (!$cita_id) {
    echo "No se proporcionó el ID de la cita.";
    exit;
}
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/recetas.js"></script>

<div class="container mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-4">Agregar Receta para Cita ID: <?php echo $cita_id; ?></h2>
    <form id="formReceta" method="POST" action="../controllers/process_guardarRecetas.php">
        <input type="hidden" name="cita_id" value="<?php echo $cita_id; ?>">
        <table id="medicamentosTable" class="w-full table-auto border-collapse border border-gray-300 mb-4">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">Medicamento</th>
                    <th class="border border-gray-300 px-4 py-2">Tipo</th>
                    <th class="border border-gray-300 px-4 py-2">Disponible</th>
                    <th class="border border-gray-300 px-4 py-2">Cantidad</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <div class="flex justify-end">
            <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-700 transition">
                Guardar Receta
            </button>
        </div>
    </form>
</div>

<?php include "../../../template/foot_template.php"; ?>
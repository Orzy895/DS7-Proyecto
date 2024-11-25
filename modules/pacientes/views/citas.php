<?php
include "../../../template/head_template.php";
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/obtenerCitas.js"></script>

<div class="container mx-auto p-6">
  <h2 class="text-2xl font-semibold mb-4">Listado de Citas Médicas</h2>

  <table id="citasTable" class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
    <thead class="bg-gray-100">
      <tr>
        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Tiempo</th>
        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Lugar</th>
        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Paciente</th>
        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Médico</th>
        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700"></th>
      </tr>
    </thead>
    <tbody class="text-sm text-gray-700">

    </tbody>
  </table>
</div>

<?php
include "../../../template/foot_template.php";
?>

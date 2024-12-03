<?php
include "../../../template/head_template.php";
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/pagoCita.js"></script>

<div class="container mx-auto p-6">
  <h2 class="text-2xl font-semibold mb-4">Detalles de la Factura</h2>

  <div id="facturaContainer" class="hidden">
    <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md mb-4">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Nombre</th>
          <th class="px-4 py-2 text-right text-sm font-semibold text-gray-700">Costo Unitario</th>
          <th class="px-4 py-2 text-right text-sm font-semibold text-gray-700">Cantidad</th>
          <th class="px-4 py-2 text-right text-sm font-semibold text-gray-700">Total</th>
        </tr>
      </thead>
      <tbody id="facturaTableBody" class="text-sm text-gray-700"></tbody>
    </table>

    <div class="flex justify-end">
      <div class="text-right">
        <p class="text-lg font-semibold">Total: <span id="totalFactura" class="text-blue-600"></span></p>
        <button id="proceedToPay" class="bg-green-500 text-white px-4 py-2 mt-4 rounded hover:bg-green-700 transition">
          Realizar Pago
        </button>
      </div>
    </div>
  </div>

  <div id="loadingMessage" class="text-center text-gray-600 hidden">
    <p>Cargando detalles de la factura...</p>
  </div>

  <div id="errorMessage" class="text-center text-red-500 hidden">
    <p>Error al cargar los detalles de la factura.</p>
  </div>
</div>

<?php
include "../../../template/foot_template.php";
?>

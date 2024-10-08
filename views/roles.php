<?php
include "../template/head_template.php"
?>

<form action="../process/process_role.php" method="post" novalidate>
    <h2>Role</h2>

    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="desc">Descripción</label>
    <input type="text" id="desc" name="desc" required>

    <button type="submit">role</button>
</form>
<?php
include "../template/foot_template.php"
?>
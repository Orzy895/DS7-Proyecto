<?php
include "../template/head_template.php"
?>
<form action="../process/module_users/process_login.php" method="post">
    <h2>Inicio de Sesión</h2>

    <label for="email">Correo</label>
    <input type="email" id="email" name="email" required>

    <label for="passw">Contraseña</label>
    <input type="password" id="passw" name="passw" required>

    <button type="submit">Iniciar Sesión</button>
</form>
<?php
include "../template/foot_template.php"
?>
<?php
include_once "../../../template/head_template.php"

?>
<form action="../controllers/process_login.php" method="post">
    <h2>Inicio de Sesión</h2>

    <label for="email">Correo</label>
    <input type="email" id="email" name="email" required>

    <label for="passw">Contraseña</label>
    <input type="password" id="passw" name="passw" required>

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <button type="submit">Iniciar Sesión</button>
        <a href="signup.php" style="padding-right: 5%;" class="account-link">¿No tienes cuenta?</a>
    </div>
</form>
<?php
include "../../../template/foot_template.php"

?>
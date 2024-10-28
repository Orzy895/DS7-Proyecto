<?php
include_once "../../../template/head_template.php"

?>
<form action="../controllers/process_login.php" method="post">
    <h2 class="text-center text-2xl font-bold mb-4">Inicio de Sesión</h2>

    <label for="email">Correo</label>
    <input type="email" id="email" name="email" required>

    <label for="passw">Contraseña</label>
    <input type="password" id="passw" name="passw" required>

    <div class="flex items-center justify-between">
        <button type="submit">Iniciar Sesión</button>
        <a href="signup.php" class="pr-5">¿No tienes cuenta?</a>
    </div>
</form>
<?php
include_once "../../../template/foot_template.php"

?>
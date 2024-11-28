<?php
include_once "../../../template/head_template.php"

?>

<form action="../controllers/process_signup.php" method="post" novalidate>
    <h2 class=" text-center text-2xl font-bold mb-4">Registro de Usuario</h2>

    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="cedula">Cédula</label>
    <input type="text" id="cedula" name="cedula" required>

    <label for="email">Correo</label>
    <input type="email" id="email" name="email" required>

    <label for="passw">Contraseña</label>
    <input type="password" id="passw" name="passw" required>

    <label for="passwConf">Confirmar Contraseña</label>
    <input type="password" id="passwConf" name="passwConf" required>

    <div class="flex items-center justify-between mt-4">
        <button type="submit">Crear Usuario</button>
        <a href="login.php" class="pr-5">¿Ya tienes cuenta?</a>
    </div>
</form>
<?php
include_once "../../../template/foot_template.php"

?>
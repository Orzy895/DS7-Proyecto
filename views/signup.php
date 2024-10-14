<?php
include "../template/head_template.php"
?>

<form action="../process/module_users/process_signup.php" method="post" novalidate>
    <h2>Registro de Usuario</h2>

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

    <button type="submit">Crear usuario</button>
</form>
<?php
include "../template/foot_template.php"
?>
<?php
include_once "template/head_template.php"
?>
<div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
    <a href="modules/usuarios/views/login.php" class="btn">Login</a>
    <a href="modules/usuarios/views/signup.php" class="btn">Signup</a>
    <a href="modules/roles/views/roles.php" class="btn">Roles</a>
    <a href="views/userAdmin.php" class="btn">Admin de Usuarios</a>
    <a class="btn" href="modules/usuarios/controllers/process_logout.php">
        Logout
    </a>
</div>
<?php
include_once "template/foot_template.php"
?>
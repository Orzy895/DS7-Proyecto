<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="../process/process_perm.php" method="post" novalidate>
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="desc">Descripción</label>
        <input type="text" id="desc" name="desc" required>

        <button>Agregar permiso</button>
    </form>

    <div id="permisos">
        <?php
        include '../process/process_get_perms.php';
        ?>
    </div>
</body>

</html>
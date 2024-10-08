<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="../process/process_role.php" method="post" novalidate>
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="desc">Descripción</label>
        <input type="text" id="desc" name="desc" required>

        <button>Agregar role</button>
    </form>
</body>

</html>
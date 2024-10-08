<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="../process/process_signup.php" method="post" novalidate>
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="celula">Celula</label>
        <input type="text" id="celula" name="celula" required>

        <label for="email">Correo</label>
        <input type="email" id="email" name="email" required>

        <label for="passw">Contraseña</label>
        <input type="password" id="passw" name="passw" required>

        <label for="passwConf">Confirmar Contraseña</label>
        <input type="password" id="passwConf" name="passwConf" required>

        <button>Crear usuario</button>
    </form>
</body>
</html>
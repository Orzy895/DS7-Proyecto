<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Automóviles</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background-color: #1F2937;
            color: white;
            text-align: center;
            padding: 10px 0;
        }

        main {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #F3F4F6;
        }

        .btn {
            padding: 10px 20px;
            background-color: #3B82F6;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px;
            width: 100%;
            text-align: center;
        }

        .btn:hover {
            background-color: #1D4ED8;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            width: 50%;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="tel"],
        input[type="number"],
        input[type="email"],
        input[type="password"],
        select {
            width: 95%;
            display: block;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button[type="submit"] {
            display: block;
            padding: 10px;
            background-color: #3B82F6;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #1D4ED8;
        }

        footer {
            background-color: #1F2937;
            color: white;
            padding: 10px 0;
        }

        ul {
            list-style: none;
            display: flex;
            justify-content: space-around;
        }
    </style>
</head>

<body>
    <header>
        <a style="text-decoration: none; color: white;" href="/DS7-Proyecto/index.php">
            <h1>Clínica Hospital</h1>

        </a>
    </header>

    <main>
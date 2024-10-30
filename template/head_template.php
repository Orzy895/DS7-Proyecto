<?php
ob_start();  // Start output buffering
session_start();  // Ensure sessions are started before accessing $_SESSION
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Clínica Hospital</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .seccion {
            display: flex;
            padding: 15px;
            border-radius: 5px;
            margin: 10px;
            width: 30%;
            flex-direction: column;
            align-items: center;
        }

        .seccion a {
            display: flex;
            justify-content: center;
            width: 100%;
            margin-top: 0px;
            border-radius: 0px 0px 5px 5px;
        }

        .img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            object-position: 30% 0%;
            border-radius: 5px 5px 0px 0px;
            background-color: white;
        }

        .btn {
            padding: 15px;
            background-color: #3B82F6;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px;
            width: 30%;
            text-align: center;
        }

        .btn:hover {
            background-color: #1D4ED8;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            margin: 2% 30%;
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
            margin-bottom: 15px !important;
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
    </style>
</head>

<body class="flex flex-col h-screen overflow-hidden">
    <header class="bg-gray-900 text-white flex justify-between items-center px-12 py-4 relative">
        <a href="/ds7-Proyecto/index.php" class="flex items-center text-white no-underline">
            <img src="/ds7-Proyecto/assets/favicon.svg" alt="Logo" width="100" height="auto" class="mr-2">
            <h2 class="m-0">Clínica Hospital</h2>
        </a>
        <?php
        $a = require_once 'auth_template.php';
        ?>
        <h1 class="absolute left-1/2 transform -translate-x-1/2 text-2xl font-bold"><?php echo $a['userName']; ?></h1>
        <div>
            <?php
            echo $a['link'];
            ?>
        </div>
    </header>

    <main class="flex flex-row flex-grow overflow-hidden">
        <div>
            <?php
            if (isset($_SESSION['user'])) {
                require_once 'side_bar_template.php';
            }
            ?>
        </div>
        <div class="flex-grow p-5 bg-gray-100 overflow-y-auto">
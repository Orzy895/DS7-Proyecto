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
            overflow: hidden;
        }

        header {
            background-color: #1F2937;
            color: white;
            text-align: center;
            flex-shrink: 0;
        }

        main {
            flex-grow: 1;
            display: flex;
            background-color: #F3F4F6;
            overflow: hidden;
        }

        .btn {
            padding: 10px 20px;
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

        a.account-link:hover {
            color: #1D4ED8;
            text-decoration: none;
        }

        .sidebar {
            width: 220px;
            height: 100vh;
            background-color: #333;
            padding-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex-shrink: 0;
        }

        .sidebar a {
            text-decoration: none;
            color: white;
            background-color: #444;
            padding: 10px 20px;
            margin: 5px 0;
            width: 80%;
            text-align: center;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #555;
        }

        .content {
            padding: 20px;
            flex-grow: 1;
            overflow-y: auto;
        }
    </style>
</head>

<body>
    <header style="display: flex; justify-content: space-between; align-items: center; padding-right: 50px; padding-left: 50px; position: relative;">
        <a style="text-decoration: none; color: white; display: flex; align-items: center;" href="../index.php">
            <img src="../assets/favicon.svg" alt="Logo" width="100" height="auto">
            <h2 style="margin-bottom: 0;">Clínica Hospital</h2>
        </a>
        <?php
        $a = require_once 'auth_template.php';
        ?>
        <h1 style="position: absolute; left: 50%; transform: translateX(-50%);"><?php echo $a['userName']; ?></h1>
        <div>
            <?php
            echo $a['link'];
            ?>
        </div>
    </header>

    <main style="display: flex; flex-direction: row;">
        <div class="sidebar">
            <?php
            if (isset($_SESSION['user'])) {
                require_once 'side_bar_template.php';
            }
            ?>
        </div>
        <div class="content">
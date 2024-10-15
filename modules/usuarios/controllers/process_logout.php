<?php
include '../../../template/head_template.php';

session_start();

if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    session_destroy();
    echo "Sesión cerrada";
} else {
    echo "No hay sesión activa";
}

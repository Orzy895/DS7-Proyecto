<?php
include '../../../template/head_template.php';


if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    session_destroy();
    header("Location: ../../../index.php");
    exit();
} else {
    echo "No hay sesión activa";
}

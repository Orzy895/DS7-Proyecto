<?php
if (isset($_SESSION['user'])) {
    $link = '/DS7-Proyecto/modules/usuarios/controllers/process_logout.php';
    $text = "Logout";
    $userName = $_SESSION['userName'];
} else {
    $link = "/DS7-Proyecto/modules/usuarios/views/login.php";
    $text = "Login";
    $userName = "Bienvenido";
}
return [
    "link" => "<a href='$link' class='btn'>$text</a>",
    "userName" => $userName
];

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "../phpmailer/src/PHPMailer.php";
require "../phpmailer/src/SMTP.php";
require "../phpmailer/src/Exception.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $factura = $_POST['factura'];

    $mail = new PHPMailer();

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = 'clinicahospital123@gmail.com';
        $mail->Password = 'klkr vfbw yhba obvu';
        $mail->setFrom('clinicahospital123@gmail.com', 'Mailer');
        $mail->addAddress($correo, $nombre);
        $mail->isHTML(true);
        $mail->Subject = 'Detalles de la Factura';

        $bodyContent = "<h2>Detalles de la Factura</h2>";
        $bodyContent .= "<p>Paciente: {$nombre}</p>";
        $bodyContent .= "<p>Correo: {$correo}</p>";
        $bodyContent .= "<table border='1' cellpadding='5' cellspacing='0' style='border-collapse: collapse; width: 100%;'>";
        $bodyContent .= "<tr><th>Nombre</th><th>Costo Unitario</th><th>Cantidad</th><th>Total</th></tr>";

        $total = 0;
        foreach ($factura as $detalle) {
            $bodyContent .= "<tr>";
            $bodyContent .= "<td>{$detalle['nombre']}</td>";
            $bodyContent .= "<td>{$detalle['costo_unitario']}$</td>";
            $bodyContent .= "<td>{$detalle['cantidad']}</td>";
            $bodyContent .= "<td>{$detalle['total']}$</td>";
            $bodyContent .= "</tr>";
            $total += $detalle['total'];
        }

        $bodyContent .= "</table>";
        $bodyContent .= "<p><strong>Total: {$total}$</strong></p>";

        $mail->Body = $bodyContent;

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

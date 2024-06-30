<?php
require_once('PHPMailer.php');
require_once('SMTP.php');
require_once('Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Validar el correo electrónico
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP de Gmail
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'jakephp4@gmail.com';  // Tu correo
            $mail->Password = 'jbhx qcey ceuc vjlk'; // Contraseña de aplicación
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Remitente y destinatario
            $mail->setFrom('jakephp4@gmail.com', 'jake16062007');
            $mail->addAddress($email);

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Mensaje de prueba en 2024';

            // Carregue o conteúdo do template
            $emailTemplate = file_get_contents('template_email.html');
            $mail->Body = $emailTemplate;
            $mail->AltBody = 'Este es un mensaje de prueba enviado en el año 2024.';

            if ($mail->send()) {
                echo 'Correo enviado exitosamente a ' . $email;
            } else {
                echo 'Correo no enviado';
            }
        } catch (Exception $e) {
            echo "Error al enviar el correo: {$mail->ErrorInfo}";
        }
    } else {
        echo 'Correo electrónico no válido.';
    }
} else {
    echo 'Método de solicitud no válido.';
}
?>

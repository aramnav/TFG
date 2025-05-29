<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mail/src/Exception.php';
require 'mail/src/PHPMailer.php';
require 'mail/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);

    if ($correo) {
        $mail = new PHPMailer(true);

        try {
            // Configurar servidor SMTP (Gmail en este caso)
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'kindergest@gmail.com'; // ← Tu dirección Gmail
            $mail->Password = 'oglikyljgpgnrjgb'; // ← Tu contraseña de aplicación de Gmail
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Configuración del mensaje
            $mail->setFrom('kindergest@gmail.com', 'KinderGest');
            $mail->addAddress($correo);
            $mail->isHTML(true);
            $mail->Subject = 'Gracias por contactar con KinderGest';
            $mail->Body = '
                <div>
                    <p>Hola,</p>
                    <p>Gracias por ponerte en contacto con <strong>KinderGest</strong>.<br>
                    Hemos recibido tu mensaje correctamente y uno de nuestros especialistas se pondrá en contacto contigo lo antes posible.</p>
                    <p>Nos alegra que estés interesado/a en conocer cómo nuestra plataforma puede ayudarte a gestionar tu guardería de forma más eficiente y sencilla.</p>
                    <p>Gracias por confiar en nosotros.</p>
                    <p>Un cordial saludo,<br>
                    <strong>El equipo de KinderGest.</strong></p>
                </div>';

            $mail->send();
            echo "ok"; // Mensaje para JavaScript
        } catch (Exception $e) {
            echo "error: {$mail->ErrorInfo}";
        }
    } else {
        echo "error: Correo no válido.";
    }
}

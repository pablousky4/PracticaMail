<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require('PHPMailer-master/src/PHPMailer.php');
require('PHPMailer-master/src/SMTP.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imagenSeleccionada = $_POST["imagen"];
    $contactosSeleccionados = $_POST["contactos"];
    $asunto = $_POST["asunto"];
    $cuerpo = $_POST["cuerpo"];

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Mailer = "SMTP";
    $mail->SMTPAutoTLS = true;
    $mail->isHTML(true);
    $mail->Port = 25;
    $mail->CharSet = 'UTF-8';
    $mail->Host = "localhost";
    $mail->SMTPAuth = true;
    $mail->Username = "pablo@domenico.es";
    $mail->Password = "pablo";
    $mail->From = "pablo@domenico.es";
    $mail->FromName = "pablo";

    $cid = $mail->addEmbeddedImage($imagenSeleccionada, 'imagen');

    foreach ($contactosSeleccionados as $destinatario) {
        $mail->AddAddress($destinatario);
    }

    $mail->Subject = $asunto;
    $mail->Body = $cuerpo;
    $mail->AltBody = $cuerpo;

    $exito = $mail->Send();
    $intentos = 1;

    while ((!$exito) && ($intentos < 5)) {
        sleep(5);
        $exito = $mail->Send();
        $intentos = $intentos + 1;
    }

    if (!$exito) {
        echo "Problemas enviando correo electrónico";
        echo "<br/>" . $mail->ErrorInfo;
    } else {
        echo "Mensaje enviado correctamente";
        echo "<a href='index.php'>Volver</a>";
    }
} else {
    echo "Error en la solicitud.";
}
?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
?>

<?php
	/*require('PHPMailer-master/src/PHPMailer.php');
    require('PHPMailer-master/src/SMTP.php');

  $mail = new PHPMailer();
  $mail -> isSMTP();
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
  $mail->Timeout=30;
  $mail->AddAddress("justin@domenico.es");
  $mail->Subject = "Prueba de phpmailer";
  $mail->Body = "<b>Mensaje de prueba mandado con phpmailer en formato html</b>";
  $mail->AltBody = "Mensaje de prueba mandado con phpmailer en formato solo texto";
  ////////////////////////////////////////////////////////////////*/

echo '
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Carpeta</title>
</head>
<body>
    <form action="procesar.php" method="post">
        <label for="carpetas">Selecciona una carpeta:</label>
        <select name="carpeta" id="carpetas">';

$directorios = array_filter(scandir('.'), 'is_dir');

foreach ($directorios as $directorio) {
    if ($directorio != "." && $directorio != ".." && $directorio != "PHPMailer-master") {
        echo "<option value=\"$directorio\">$directorio</option>";
    }
}

echo '
        </select>
        <br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>
';

/*
  $exito = $mail->Send();
  $intentos=1; 
  while ((!$exito) && ($intentos < 5)) {
	sleep(5);
     	//echo $mail->ErrorInfo;
     	$exito = $mail->Send();
     	$intentos=$intentos+1;	
	
   }
 
		
   if(!$exito)
   {
	echo "Problemas enviando correo electr nico a ".$valor;
	echo "<br/>".$mail->ErrorInfo;	
   }
   else
   {
	echo "Mensaje enviado correctamente";
   } */
?>
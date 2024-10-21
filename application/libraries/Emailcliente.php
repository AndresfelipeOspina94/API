<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

class Emailcliente {

  var $html;

  public function send_mail($datos = NULL, $html) {
      $mail = new PHPMailer();
      $mail->IsSMTP(); // establecemos que utilizaremos SMTP
      $mail->SMTPAuth   = true; // habilitamos la autenticación SMTP
      $mail->SMTPSecure = "ssl";  // establecemos el prefijo del protocolo seguro de comunicación con el servidor
      $mail->Host       = "smtp.gmail.com";      // establecemos GMail como nuestro servidor SMTP
      $mail->Port       = 465;                   // establecemos el puerto SMTP en el servidor de GMail
      $mail->Username   = "rm@programarte.com.co";  // la cuenta de correo GMail
      $mail->Password   = "1107069186";            // password de la cuenta GMail
      $mail->SetFrom('info@tudominio.com', 'BTraining Test');  //Quien envía el correo
      $mail->AddReplyTo("response@tudominio.com","BTraining");  //A quien debe ir dirigida la respuesta
      $mail->Subject    = "Nuevo formulario";  //Asunto del mensaje
      $mail->Body      = $html;
      $mail->AltBody    = "Cuerpo en texto plano";

      $destino = $datos->cliente['emailprincipal'];
      $mail->AddAddress($destino);
      //$mail->AddAttachment("images/phpmailer.gif");      // añadimos archivos adjuntos si es necesario
      //$mail->AddAttachment("images/phpmailer_mini.gif"); // tantos como queramos

      if(!$mail->Send()) {
          $data["message"] = "Error en el envío: " . $mail->ErrorInfo;
      } else {
          $data["message"] = "¡Mensaje enviado correctamente!";
      }
      //$this->load->view('emailformulario',$data);
  }

}

/* End of file Html2pdf.php */

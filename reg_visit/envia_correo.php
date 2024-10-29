<?php
// Incluir el archivo de conexión
include '../connectDB/connect.php';
include '../reg_visit/model.php';

date_default_timezone_set("America/Lima");
ini_set('memory_limit', '1024M');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../lib/PHPMailer/src/Exception.php';
require '../lib/PHPMailer/src/PHPMailer.php';
require '../lib/PHPMailer/src/SMTP.php';

$db = new Database();

$xgetData = getData($db);
//echo '<pre>';print_r($xgetData);echo '</pre>';die;
if($xgetData){
    foreach ($xgetData as $key => $val) {
        $cia = $val['Empresa']; 
        $rs = $val['Razón Social'];
        $Nomcli = $val['Nombre'];
        $Correo = $val['Correo'];
        $Vendedor = $val['Vendedor'];
        $Celular = $val['Celular'];
        $mailVend = $val['Correo Vendedor'];
        $idReg= $val['id'];
        $tip_even=$val['tip_even'];
        $coment=$val['coment'];

        // Definir el nombre de la imagen y la compañía
        $imgPath = ($cia == 'ih') ? '../img/IGARDI.png' : '../img/equipos.png';
        $nameCia = ($cia == 'eyh') ? 'Equipos y Herramientas SAC' : 'Igardi Herramientas SAC';
        $webcia = ($cia == 'eyh') ? 'https://www.equiposperu.com/' : 'https://www.igardi.com/';
        $redCia = ($cia == 'eyh') ? 'https://www.facebook.com/eqyhperu' : 'https://www.facebook.com/igardiherramientassa/';
        // Enviar el correo
        setCorreo($db,$imgPath, $Nomcli, $Vendedor, $Celular, $mailVend, $nameCia, $Correo,$webcia,$redCia,$idReg,$tip_even,$coment);
    }
}
//setCorreo($db,$imgPath, $Nomcli, $Vendedor, $Celular, $mailVend, $nameCia, $Correo,$webcia,$redCia,$idReg,$tip_even,$coment);

function setCorreo($db,$imgPath, $Nomcli, $Vendedor, $Celular, $mailVend, $nameCia, $Correo,$webcia,$redCia,$idReg,$tip_even,$coment) {
    //print_r($Correo);die;
    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';
    
    $Correo="gestordedatos@igardi.com";
    // Configuración del servidor
    $mail->IsSMTP();
    $mail->Host = 'mail.igardi.com';
    $mail->Mailer = "smtp";
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = 'igardimailing@igardi.com';
    $mail->Password = 'IM20200629';
    $mail->SetFrom("igardimailing@igardi.com", "$nameCia");
    $mail->Subject = "Gracias por visitarnos en ".$tip_even."!!!";
    
    // Añadir direcciones de destinatarios
    //$mail->AddAddress("$Correo");
    $mail->AddBCC("$mailVend");
    $mail->AddBCC("gestordedatos@igardi.com");

    // Cuerpo del correo en HTML
    $body = body($Nomcli, $Vendedor, $Celular, $mailVend, $nameCia,$webcia,$redCia,$tip_even,$coment);
    $mail->MsgHTML($body);

    // Insertar imagen incrustada
    $mail->addEmbeddedImage($imgPath, 'logoimg'); // Incrustar la imagen con CID 'logoimg'

    // Enviar el correo
    if (!$mail->send()) {
        echo 'Error al enviar el correo: ' . $mail->ErrorInfo . '<br>';
        
    } else {
        echo 'Correo enviado correctamente<br>';
        updateReg($db,$idReg);
    }
}

function body($Nomcli, $Vendedor, $Celular, $mailVend, $nameCia, $webcia, $redCia,$tip_even,$coment) {
    return "<!DOCTYPE html>
            <html lang='es'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Gracias por Visitarnos en Expomina 2024</title>
                    <style>
                        body {
                            font-family: 'Helvetica Neue', Arial, sans-serif;
                            background-color: #f4f4f4;
                            margin: 0;
                            padding: 0;
                        }
                        .container {
                            max-width: 700px;
                            margin: 0 auto;
                            background-color: #ffffff;
                            padding: 20px;
                            border: 1px solid #e0e0e0;
                            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
                        }
                        .header {
                            background-color: rgba(255,255,255,1);
                            padding: 20px;
                            text-align: center;
                        }
                        .header img {
                            max-width: 150px;
                        }
                        .header h1 {
                            color: #000;
                            margin-top: 10px;
                            font-size: 28px;
                        }
                        .content {
                            padding: 30px;
                            color: #333333;
                        }
                        .content p {
                            font-size: 18px;
                            line-height: 1.6;
                        }
                        .sales-contact {
                            background-color: #f9f9f9;
                            padding: 20px;
                            margin-top: 40px;
                            text-align: center;
                            border-top: 2px solid #00264d;
                        }
                        .sales-contact h3 {
                            margin-bottom: 5px;
                            font-size: 20px;
                            color: #00264d;
                        }
                        .sales-contact p {
                            margin: 0;
                            font-size: 16px;
                        }
                        .catalog-button {
                                display: block;
                                text-align: center;
                                margin-top: 30px;
                        }
                        .catalog-button a {
                            background-color: #00264d;
                            color: #ffffff;
                            padding: 15px 30px;
                            text-decoration: none;
                            border-radius: 5px;
                            font-size: 18px;
                            display: inline-block;
                        }    
                        .footer {
                            text-align: center;
                            font-size: 14px;
                            color: #777777;
                            padding: 30px 0;
                            border-top: 1px solid #e0e0e0;
                        }
                        .footer a {
                            color: #00264d;
                            text-decoration: none;
                        }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <div class='header'>
                            <img src='cid:logoimg' alt='Igardi Herramientas'>
                            <h1>¡Gracias por Visitarnos en $tip_even!</h1>
                        </div>
                        <div class='content'>
                            <p>Estimado/a $Nomcli,</p>
                            <p>En <strong>$nameCia</strong>, queremos agradecerle sinceramente por habernos visitado en nuestro stand durante $tip_even. Fue un honor presentarte nuestras soluciones y herramientas.</p> 
                            <p>Nos complace saber que te interesa el equipo <strong>$coment</strong> y queremos asegurarte que uno de nuestros especialistas se pondrá en contacto contigo muy pronto para brindarte más información al respecto.</p>
                            <p>Si tienes alguna consulta, no dudes en contactarnos. Queremos asegurarnos de que tengas todas las herramientas necesarias para hacer crecer tu negocio.</p>
                        </div>
                        <div class='catalog-button'>
                                <a href='http://143.0.250.67/comercial/catalogos/catalogos.php' target='_blank'>Ver Catálogo de Productos</a>  
                        </div>
                        <div class='sales-contact'>
                            <h3>Datos del asesor</h3>
                            <p><strong>$Vendedor</strong></p>
                            <p>Teléfono: $Celular</p>
                            <p>Email: <a href='mailto:$mailVend'>$mailVend</a></p>
                        </div>
                    </div>
                    <div class='footer'>
                        <p>&copy; 2024 $nameCia - Todos los derechos reservados.</p>
                        <p><a href='$webcia'>Visita nuesta Web</a> | <a href='$redCia' target='_blank'>Síguenos en redes sociales</a></p>
                    </div>
                </body>
                
            </html>";
}
?>

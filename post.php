<?php
    // Comment out the above line if not using Composer
    // https://github.com/sendgrid/sendgrid-php/releases
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require 'PHPMailer-master/src/Exception.php';
    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';
    
if(isset($_POST)){
  

$data = json_decode(file_get_contents('php://input'), true);
//var_dump($data[0]['Cliente']);
$Nombre_plan_default='Plan Basico';
$item=0;
$contenido='
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link rel="stylesheet" href="../css/tiket.css">
        </head>
        <body>
        <div align="center"  width="180px" height="180px" style="border-style: solid; border-radius: 25px" >
            <img src="https://logos-marcas.com/wp-content/uploads/2020/04/PayPal-s%C3%ADmbolo.png" >
            <h2>Compra: #'.$data[0]['id'].' <br> Cliente: '.$data[0]['Cliente'].'</h2>
            <h2>Email: '.$data[0]['email'].'</h2>
            <h3>Estatus: '.$data[0]['status'].'</h3>

            <table border="1">
            <tr>
                <th><strong>Descripción</strong></th>
                <th><strong>Importe</strong></th>               
            </tr>            
            ';

            foreach($data[1][1] as $key=> $recordsets)
            { 
            $item=$item+1;
           }

           if($item==0){
$contenido .='
              <tr>
                <td>'.$Nombre_plan_default. '</td>
                <td><b>'.$data[0]['importe']. '</b></td>                
             </tr>
             <tr>
                <td><b>Total</b></td>
                <td><b>$'.$data[0]['importe']. '</b></td>                
             </tr>';
           }else{

$contenido .='<tr>
              <td colspan="2"><b>'.$Nombre_plan_default. ' + </b></td>                                
             </tr>'; 
            foreach($data[1][1] as $key=> $recordsets)
            { 
           
$contenido .='<tr>
                <td>' . $recordsets['title']. '</td>
                <td><b>$' . $recordsets['precio']. '</b></td>                
             </tr>';
           }
$contenido .='<tr>
                <td><b>Total</b></td>
                <td><b>$'.$data[0]['importe']. '</b></td>                
             </tr>';
           }

$contenido .='  
                </table>
                <p class="centrado">¡GRACIAS POR SU COMPRA!</p>
                </div>
                </body>
               </html>';


     $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = '';    // SMTP username
        $mail->Password   = '';                         // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    
        //Recipients
        $mail->setFrom('', 'Comerciante Digital');
        $mail->addAddress('');                               // Add a recipient
        $mail->addReplyTo('', 'venta');
    
    
        // Content
        $mail->isHTML(true);                                           // Set email format to HTML
        $mail->Subject = 'Pago Realizado';
        $mail->Body    = $contenido;
        $mail->AltBody = 'Gracias por su compra';
    
        $mail->send();
        //echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }



    // foreach($data as $key=> $recordsets)
 	// { 
    //     echo $recordsets['title'];

    //  }

    // $respuesta=[
    //     "titulo" => "hola",
    // ];

    // $repuetaCodificada=json_encode($respuesta);
    // echo $repuetaCodificada;
}

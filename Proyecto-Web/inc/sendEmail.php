<?php

    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    session_start();
    $unipass = md5('password');
    $response = array();
    $idRem = $_SESSION["IdUser"];
    $emailRem = $_SESSION["email"];
    $name = $_SESSION['Nombre'];

    if(isset($_POST['email'])){
        //$name =  $_POST['name'];
        $idPostal = $_POST['id'];
        $emailDes =  $_POST['email'];
        $subject =  $_POST['subject'];
        $body =  $_POST['body'];

        require_once "./PHPMailer/PHPMailer.php";
        require_once "./PHPMailer/Exception.php";
        require_once "./PHPMailer/SMTP.php";
         
        $mail = new PHPMailer;
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();
        //Enable SMTP debugging
        $mail->isHTML(true);
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        // use
        // $mail->Host = gethostbyname('smtp.gmail.com');
        // if your network does not support SMTP over IPv6
        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;
        //Set the encryption mechanism to use - STARTTLS or SMTPS
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //usuario del servidor SMTP
        $mail->Username = 'edrasen04@gmail.com';
        //Contraseña del email que envia
        $mail->Password = 'Edgar$Cod3';
        //Establecemos el remitente
        $mail->setFrom("edrasen04@gmail.com", 'Postix');
        //Establecemos el correo al que se enviara la postal
        $mail->addAddress($emailDes);
        //Set the subject line
        $mail->Subject = $subject;
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        //$mail->msgHTML(file_get_contents('./plantilla/mensaje1.html'), __DIR__);

        $mail->Body = '<h1>Postix</h1><p> $name Te ha enviado una postal, para poder verla registrate en esta cuenta en <strong>Postix</strong></p><br><br><p>$body</p>';
        
        //send the message, check for errors
        if (!$mail->send()){
            $response["msg"] = "Error: " . $mail->ErrorInfo;
            $response["val"] = 0;
            //$response["edo"] = 0;
        }
        else{ 
            $response["msg"] = "Mensaje enviado";
            $response["val"] = 1;
            ////Conexion 
            include_once 'Tools.php';
            $connect = new Tools();
            $conn = $connect->connectDB();
            $sql = "SELECT * FROM usuario WHERE email='$emailDes'";
            $res=mysqli_query($conn, $sql);
            if (mysqli_num_rows($res)) { //Se busca un usuario asociado a ese correo, si existe se envia
                $row = $res->fetch_assoc();
                //query
                $idDes = $row["idUser"];
                $sql2 = "INSERT INTO envio(idRemitente,emailRemitente,idDestinatario,emailDestinatario,idPostal,mensaje,fechaEnv, saludo) 
                    VALUES ('$idRem','$emailRem','$idDes','$emailDes', '$idPostal','$body', now(), '$subject')";
                if (mysqli_query($conn, $sql2)) {
                    $response["msg"] = "Mensaje enviado";
                    $response["val"] = 1;
                    //$response["edo"] = 1; //BIEN
                } else {
                    $response["msg"] = "Error";
                    $response["val"] = 0;
                    //$response["edo"] = 'Error'; //ERROR
                }
            }
            else{
                $sql3 = "INSERT INTO usuario(email,nombre,primerAp,segundoAp,contrasena,fechaNac,tipoUser,estado,profile_Img) 
                VALUES ('$emailDes','$emailDes','','', '$unipass','2000-01-01','Normal','Activo','Img/yuna.jpg')";
                mysqli_query($conn, $sql3);
                /*if (mysqli_query($conn, $sql3)) {
                    $response["msg"] = "Se envio correo a usuario no registrado";
                    $response["val"] = 1;
                    //$response["edo"] = 1; //BIEN
                } else {
                    $response["msg"] = "Error";
                    $response["val"] = 0;
                    //$response["edo"] = 'Error'; //ERROR
                }*/

                $sql4 = "SELECT * FROM usuario WHERE email='$emailDes'";
                $res4=mysqli_query($conn, $sql4);
                if (mysqli_num_rows($res4)) { 
                    $row4 = $res4->fetch_assoc();
                    //query
                    $idDes = $row4["idUser"];
                    $sql5 = "INSERT INTO envio(idRemitente,emailRemitente,idDestinatario,emailDestinatario,idPostal,mensaje,fechaEnv, saludo) 
                        VALUES ('$idRem','$emailRem','$idDes','$emailDes', '$idPostal','$body', now(), '$subject')";
                    if (mysqli_query($conn, $sql5)) {
                        $response["msg"] = "Correo enviado a usuario no registrado";
                        $response["val"] = 1;
                        //$response["edo"] = 1; //BIEN
                    } else {
                        $response["msg"] = "Error";
                        $response["val"] = 0;
                        //$response["edo"] = 'Error'; //ERROR
                    }
                }
            }
            //Cierraconexion
            $connect->disconnectDB($conn);
            
        }
        echo(json_encode($response));
    }
?> 
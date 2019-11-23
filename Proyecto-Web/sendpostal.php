<?php
    session_start();

    $idPostal = $_GET["id"];

    if (!empty($_SESSION['NombreUsuario']) && $_SESSION['TipoDeUsuario'] == 'Admin') {
        $user = $_SESSION['NombreUsuario'];
    } else {
        header('Location: index.php');
    }

    include_once './inc/Tools.php';
    $connect = new Tools();
    $conn = $connect->connectDB();
    $sql = "SELECT * FROM postal WHERE idPostal='$idPostal'";
    $res=mysqli_query($conn, $sql);
    if (mysqli_num_rows($res)) { //Se busca un usuario asociado a ese correo
        $row = $res->fetch_assoc();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Envio de postal</title>
    <link rel="Stylesheet" href="assets/css/materialize.css">
    <link rel="Stylesheet" href="assets/css/all.css">
    <link href="assets/css/jquery-confirm.css" rel="stylesheet">
    <!--fontsawensome-->
    <link rel="Stylesheet" href="assets/css/validetta.min.css">
    <link rel="Styleshee" href="assets/css/misEstilos.css">
    
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/js/materialize.js"></script>
    <script src="assets/js/jquery-confirm.min.js"></script>
</head>

<body>
    <?php require_once('mod/header.php'); ?>
    <main class="container valign-wrapper" id="response">
        <div class="">
            <h4 class="center">Nuevo envio</h4>
            
                <div class="row">
                    <div class="col l6 s8">
                        <div class="col l12">
                                <h5 for="name" class="">From: <?php echo $_SESSION['NombreUsuario'];?></h5>
                                <!--<input type="text" id="name">-->
                        </div>
                        
                        <div class="col l12 input-field">
                            <i class="teal-text"></i>
                            <label for="email">e-mail:</label>
                            <input type="text" id="email">
                        </div>
                        <div class="col l12 input-field">
                            <i class="teal-text"></i>
                            <label for="asunto">Saludo</label>
                            <input type="text" id="subject">
                        </div>
                        <div class="input-field col l12">
                            <textarea id="body" class="materialize-textarea"></textarea>
                            <label for="body">Mensaje</label>
                        </div>
                        <div class="col l12 center">
                                <a href="#notification" class="btn waves-effect teal modal-trigger center" id="sent"><i class="material-icons right">send</i>Enviar</a>
                                <br>
                        </div>
                    </div>
                    <div class="col l6 s12" id="#<?php echo $idPostal?>">
                        <div class="card-image">
                            <input type="hidden" id="custId" name="custId" value="<?php echo $idPostal ?>">
                            <br>
                            <br>
                            <img class="responsive-img" src="<?php echo $row['dirPostal'];?>">
                        </div>
                    </div>    
                </div>
            
        </div>
    <script type="text/javascript" src="js/sendemail.js"></script>
    </main>
    <?php require_once('mod/footer.html'); ?>
</body>

<div id="notification" class="modal">
        <div class="modal-content">
            <h6 class="teal-text">Enviando mensaje</h6>
                <div class='container'>
                    <p>Espere mientras se envia el mensaje</p>
                    <div class='col l10 progress'>
                        <div class='indeterminate'>
                        </div>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <a href="" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
        </div>

</html>

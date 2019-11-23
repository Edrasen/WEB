<?php

include_once 'inc/Tools.php';
$connect = new Tools();
$conexion = $connect->connectDB();
session_start();
    
if (!empty($_SESSION['NombreUsuario'])) {
    $user = $_SESSION['NombreUsuario'];
    $emailUsr = $_SESSION['email'];
    //$profilePic=$_SESSION['RutaFotoPerfil'];
} else {
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Historial</title>
    <!--CSS-->
    <link rel="Stylesheet" href="assets/css/materialize.css">
    <link rel="Stylesheet" href="assets/css/all.css">
    <link rel="Stylesheet" href="assets/css/jquery.dataTables.min.css">
    <link rel="Stylesheet" href="assets/css/responsive.dataTables.min.css">
    <!--fontsawensome-->
    <link rel="Stylesheet" href="assets/css/validetta.min.css">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


</head>

<body class="">
    <?php require_once('mod/header.php'); ?>
    <main>
    <div id="envios" class="col s12">
                <div class="row center-align">
                    <div class="row center-align">
                        <h4>Mis Envios</h4>
                    </div>
                </div>
                <div class="container">
                <div class="row col s12 center-align">
                    <table class="responsive-table striped centered display" id="Postal" class="display responsive nowrap" style="width:100%">

                        <thead class="white-text black">
                            <tr>
                                <th>emailDestinatario</th>
                                <th>Asunto</th>
                                <th>Mensaje</th>
                                <th><br><br>Postal<br><br><br></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php


                            $sql = "SELECT * FROM envio INNER JOIN postal ON envio.idPostal = postal.idPostal WHERE emailRemitente = '$emailUsr'";
                            $result = mysqli_query($conexion, $sql);

                            while ($mostrar = mysqli_fetch_array($result)) { ?>
                                <tr>
                                    <td><?php echo $mostrar['emailDestinatario'] ?></td>
                                    <td><?php echo $mostrar['saludo'] ?></td>
                                    <td><?php echo $mostrar['mensaje'] ?></td>
                                    <td><img id="dirPostal" src="<?php echo $mostrar['dirPostal'] ?>" alt="" style="height:150px; width:220px;" /></td>
                            <?php
                            } ?>
                        </tbody>
                    </table>
                    <br>
                    <br>
                    <div class="col s6 black-text left-align"></div>
                </div>
                </div>
    </main>
    <!--FOOTER-->
    <?php require_once('mod/footer.html'); ?>

    <!--JavaScript at end of body for optimized loading-->
    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="assets/js/materialize.js"></script>
    <script src="js/historial.js"></script>
</body>


</html>
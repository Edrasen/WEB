<?php
session_start();
if (!empty($_SESSION['NombreUsuario'])) {
    $user = $_SESSION['NombreUsuario'];
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
    <!--fontsawensome-->
    <link rel="Stylesheet" href="assets/css/validetta.min.css">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


</head>

<body class="">
    <?php require_once('mod/header.php'); ?>
    <main>
        <div id="main" class="">
            <!--Body-->
            <div class="container lighten-1">
                <div class="row">
                    <div class="col s12 center-align black-text">
                        <h1>Historial de envios</h1>
                    </div>
                </div>
                <div class="row">
                    <table class="responsive-table centered">
                        <thead class="black white-text">
                            <tr>
                                <th>Para:</th>
                                <th>Nombre:</th>
                                <th>Mensaje:</th>
                                <th>Entrega:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Alvin</td>
                                <td>Eclair</td>
                                <td>$0.87</td>
                                <td>Eclair</td>
                            </tr>
                            <tr>
                                <td>Alvin</td>
                                <td>Eclair</td>
                                <td>$0.87</td>
                                <td>Eclair</td>
                            </tr>
                            <tr>
                                <td>Alvin</td>
                                <td>Eclair</td>
                                <td>$0.87</td>
                                <td>Eclair</td>
                            </tr>
                            <tr>
                                <td>Alvin</td>
                                <td>Eclair</td>
                                <td>$0.87</td>
                                <td>Eclair</td>
                            </tr>
                            <tr>
                                <td>Alvin</td>
                                <td>Eclair</td>
                                <td>$0.87</td>
                                <td>Eclair</td>
                            </tr>
                            <tr>
                                <td>Alvin</td>
                                <td>Eclair</td>
                                <td>$0.87</td>
                                <td>Eclair</td>
                            </tr>
                            <tr>
                                <td>Alvin</td>
                                <td>Eclair</td>
                                <td>$0.87</td>
                                <td>Eclair</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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
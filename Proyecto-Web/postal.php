<?php
session_start();
include_once 'inc/envio.php';
if (!empty($_SESSION['NombreUsuario']) && isset($_POST['idEnvio'])) {
    $user = $_SESSION['NombreUsuario'];
    $idEnvio = $_POST['idEnvio'];
    $datos = envio($_SESSION['email'], $idEnvio); //RETORNA UNA COMPROBACION ATRAVES DE SQL
    $imagen = postal($idEnvio);
    if (empty($datos)) {
        header('Location: myProfile.php');
    }
} else {
    header('Location: myProfile.php');
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Postal Recibida</title>
    <!--CSS-->
    <link rel="Stylesheet" href="assets/css/materialize.css">
    <link rel="Stylesheet" href="assets/css/all.css">
    <!--fontsawensome-->
    <link rel="Stylesheet" href="assets/css/validetta.min.css">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


</head>

<body>
    <?php require_once('mod/header.php'); ?>
    <main >
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <h4><?php echo $datos['saludo'] ?></h4>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6">
                    <div class="card">
                        <div class="card-image">
                            <img src="<?php echo $imagen ?>">
                        </div>
                        <div class="card-content">
                            <p class="orange-text"><?php echo "De:<br>" . $datos['nombre'] . " " . $datos['primerAp'] . " " . $datos['segundoAp'] . "<br>" . $datos['emailRemitente'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="card">
                        <div class="card-content">
                            <h5>Mensaje</h5>
                            <p><?php echo $datos['mensaje'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--FOOTER-->
    <?php require_once('mod/footer.html'); ?>

    <!--JavaScript at end of body for optimized loading-->
    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="assets/js/materialize.js"></script>
    <script src="assets/js/validetta.min.js"></script>
    <script src="assets/js/validettaLang-es-ES.js"></script>
    <script src="assets/js/jquery-confirm.min.js"></script>

    <script src="js/postal.js"></script>

</body>


</html>
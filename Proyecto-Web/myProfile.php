<?php
session_start();
if (!empty($_SESSION['NombreUsuario'])) {
    $user = $_SESSION['NombreUsuario'];
    include_once 'inc/envio.php';
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
    <title>Mi Perfil</title>
    <!--CSS-->
    <link rel="Stylesheet" href="assets/css/materialize.css">
    <link rel="Stylesheet" href="assets/css/all.css">
    <!--fontsawensome-->
    <link rel="Stylesheet" href="assets/css/validetta.min.css">
    <link rel="Stylesheet" href="assets/css/cssProfile.css">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


</head>

<body class="">
    <?php require_once('mod/header.php'); ?>
    <main>
        <div class="container">
            <div>
                <div id="profile-page row" class="section">
                    <!-- profile-page-header PC -->
                    <div id="profile-page-header" class="card">
                        <div class="black row card-image waves-effect waves-block waves-light">
                            <img class="responsive-img" src="assets/images/office.jpg" alt="user background">
                        </div>
                        <figure class="card-profile-image">
                            <img src="<?php echo $_SESSION["ProfilePic"]; ?> " alt="profile image" class="circle z-depth-2 responsive-img activator">
                        </figure>
                        <div class="card-content row">
                            <div class="row">
                                <div class="col s4 ">
                                    <h4 class="card-title grey-text text-darken-4"><?php echo $_SESSION["NombreUsuario"]; ?></h4>
                                    <p class="medium-small grey-text"><?php echo $_SESSION["email"]; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ profile-page-header -->


                <!-- profile-page-content -->
                <div id="profile-page-content" class="row">
                    <!-- profile-page-sidebar-->
                    <div id="profile-page-sidebar" class="col s12 m4">

                        <!-- Profile About Details  -->
                        <ul id="profile-page-about-details" class="collection z-depth-1">
                            <li class="collection-item green ">
                                <div class="row">
                                    <div class="col s5 white-text">
                                        <h5>Mis datos</h5>
                                    </div>
                                    <div class="col s7 white-text right-align"><button class="btn white green-text modal-trigger" href="#modalActualizar">EDITAR</button></div>
                                </div>
                            </li>
                            <li class="collection-item">
                                <div class="row">
                                    <div class="col s5 grey-text darken-1"><i class="mdi-action-wallet-travel"></i> Nombre</div>
                                    <div class="col s7 grey-text text-darken-4 right-align"><?php echo $_SESSION["NombreUsuario"]; ?></div>
                                </div>
                            </li>
                            <li class="collection-item">
                                <div class="row">
                                    <div class="col s5 grey-text darken-1"><i class="mdi-social-domain"></i> Fecha de Nac</div>
                                    <div class="col s7 grey-text text-darken-4 right-align"><?php echo $_SESSION["FechaNacimiento"]; ?></div>
                                </div>
                            </li>
                            <li class="collection-item">
                                <div class="row">
                                    <div class="col s5 grey-text darken-1"><i class="mdi-social-cake"></i> Correo Electronico</div>
                                    <div class="col s7 grey-text text-darken-4 right-align"><?php echo $_SESSION["email"]; ?></div>
                                </div>
                            </li>
                        </ul>
                        <!--Modal Actualizar Datos-->
                        <div id="modalActualizar" class="modal" style="top:0px">
                            <div class="modal-content">
                                <form id="formActualizar" enctype="multipart/form-data" method="post">
                                    <div class="row center-align">
                                        <h4>Editar Perfil</h4>
                                    </div>
                                    <div class="row center-align">
                                        <div class=" col s12 m6 l6 ">
                                            <!--Form-->
                                            <div class=" input-field">
                                                <i class="fas fa-at prefix"></i>
                                                <input id="email" value="<?php echo $_SESSION["email"]; ?>" name="email" type="text" class="input1" autocomplete="off" data-validetta="required,email,minLength[8],maxLength[64]" readonly>
                                                <label for="email">CorreoElectronico</label>
                                            </div>
                                            <div class="input-field">
                                                <i class="fa fa-calendar prefix"></i>
                                                <input type="text" class="datepicker" value="<?php echo  $_SESSION["FechaNacimiento"]; ?>" id="FechaNac" name="FechaNac" autocomplete="off">
                                                <label for="fechaNac">FechaNacimiento</label>
                                            </div>
                                            <div class="input-field">
                                                <i class="fa fa-user prefix"></i>
                                                <input id="name" name="name" value="<?php echo  $_SESSION["Nombre"]; ?>" type="text" class="input2" autocomplete="off" data-validetta="required,minLength[4],maxLength[32]">
                                                <label for="name">Nombre</label>
                                            </div>
                                            <div class="input-field">
                                                <i class="fa fa-user prefix"></i>
                                                <input id="primerAp" name="primerAp" value="<?php echo  $_SESSION["PrimerAp"]; ?>" type="text" class="input3" autocomplete="off" data-validetta="required,minLength[4],maxLength[32]">
                                                <label for="primerAp">Primer Apellido</label>
                                            </div>
                                            <div class="input-field">
                                                <i class="fa fa-user prefix"></i>
                                                <input id="segundoAp" name="segundoAp" value="<?php echo  $_SESSION["SegundoAp"]; ?>" type="text" class="input4" autocomplete="off" data-validetta="required,minLength[4],maxLength[32]">
                                                <label for="segundoAp">Segundo Apellido</label>
                                            </div>
                                            <div class="input-field">
                                                <i class="fa fa-key prefix"></i>
                                                <input id="psw" name="psw" type="password" class="input5" autocomplete="off" data-validetta="required,minLength[6],maxLength[12]">
                                                <label for="psw">Contraseña para confirmar cambios<a class="red-text">*</a></label>
                                            </div>
                                            <!--/Form-->
                                        </div>
                                        <!--Imagen-->
                                        <div class=" col s12 m6 l6 center-align">
                                            <img id="FotoPerfil" src="<?php echo  $_SESSION["ProfilePic"]; ?>" alt="FotoPerfil" style="height:200px;" />
                                            <div class="file-field input-field">
                                                <div class="btn">
                                                    <span>Foto de perfil</span>
                                                    <input type="file" id="profilePic" accept="image/*" name="profilePic" value="<?php echo  $_SESSION["ProfilePic"]; ?>" onchange="readURL(this);">
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <!--/Imagen-->
                                    </div>
                                    <div class="row">
                                        <div class=" col s6 input-field ">
                                            <input id="btnRegistro" type="submit" class="btn" value="Actualizar">
                                        </div>
                                        <div class=" col s6 input-field">
                                            <div class="modal-footer">
                                                <a href="#!" class="modal-close waves-effect btn waves-green btn-flat">Cerrar</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--/ Modal Actualizar Datos-->
                        <!--/ Profile About Details  -->
                        <!-- Profile Total envios -->
                        <div class="card center-align">
                            <div class="card-content purple white-text">
                                <p class="card-stats-title"><i class="mdi-editor-attach-money"></i>Tus envios</p>
                                <h4 class="card-stats-number"><?php echo "" . countEnvios($_SESSION['email']); ?></h4>
                                </p>
                            </div>
                            <a href="historial.php">
                                <div class="card-action purple darken-2">
                                    <div id="sales-compositebar">
                                        <p class="card-stats-fcompare"><span class="purple-text text-lighten-5">Historial de envios</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div id="profile-page-wall" class="col s12 m8 ">
                        <!-- task-card -->
                        <ul id="task-card" class="collection with-header">
                            <li class="collection-header cyan">
                                <h4 class="task-card-title">Mis ultimos envios</h4>
                            </li>

                            <ul class="collection">
                                <?php enviosDeUsuario($_SESSION["email"], "", 3); ?>

                            </ul>
                        </ul>
                        <!-- task-card -->

                        <!-- task-card -->
                        <ul id="task-card" class="collection with-header">
                            <li class="collection-header orange">
                                <h4 class="task-card-title">Postales recibidas</h4>
                            </li>
                            <ul class="collection">
                                <?php enviosRecibidos($_SESSION["email"]); ?>
                            </ul>
                        </ul>
                        <!-- task-card -->
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

    <script src="js/profile.js"></script>
</body>


</html>
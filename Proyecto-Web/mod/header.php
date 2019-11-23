<!--Header-->
<header>
    <nav>
        <div class="nav-wrapper black darken-3">
            <a href="index" class="brand-logo "> ~POSTAL~</a>
            <a href="#" data-target="mobile-Barra" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down ">
                <li><a class="nav-justified" href="">Acerca de</a></li>

                <!--SESSION -->
                <?php if (isset($user)) { ?>
                    <?php if (!strpos($_SERVER['REQUEST_URI'], '#task-card')) { ?>
                        <li><a class="nav-justified" href="myProfile#task-card">Postales Recibidas</a></li>
                    <?php } ?>
                    <li class='valign-wrapper '>
                        <a class="dropdown-button" href="#!" data-constrainwidth="false" data-beloworigin="true" data-activates="profileopt" data-target='dropdown1'>
                            <?php echo $_SESSION["NombreUsuario"]; ?><i class="material-icons right">arrow_drop_down</i> </a>
                        <img style="height:60px;" class="square" src=" <?php echo $_SESSION["ProfilePic"]; ?> ">
                    </li>
                    <!-- Dropdown Structure          NAVEGADOR EN PC-->
                    <ul id='dropdown1' class='dropdown-content collection'>
                        <?php if (!strpos($_SERVER['REQUEST_URI'], 'myProfile')) {
                                echo "<li><a href='myProfile'>Mi Perfil</a></li>";
                            } ?>
                        <?php if (!strpos($_SERVER['REQUEST_URI'], 'historial')) {
                                echo "<li><a href='historial'>Historial de envios</a></li>";
                            } ?>
                        <?php if ($_SESSION['TipoDeUsuario'] == 'Admin') {
                                if (!strpos($_SERVER['REQUEST_URI'], 'Administrador')) {
                                    echo "<li><a href='Administrador'>Interfaz de administrador</a></li>";
                                }
                                if (!strpos($_SERVER['REQUEST_URI'], 'Estadisticas')) {
                                    echo "<li><a href='Estadisticas'>Estadisticas</a></li>";
                                }
                            }
                            ?>
                        <li class="divider"></li>
                        <li><a href="inc\cerrarS" class="fas fa-sign-out-alt">Cerrar Sesion</a></li>
                    </ul>
                <?php } else { ?>
                    <li>
                        <a class="nav-justified  modal-trigger " href="#modalRegistro">
                            Registrarse
                        </a>
                    </li>
                    <li>
                        <a class="waves-effect waves-light btn modal-trigger " href="#modalLogin">
                            Login
                        </a>
                    </li>
                <?php  } ?>
                <!--/SESSION -->
                <!--END MODAL TRIGGER-->
            </ul>
        </div>
    </nav>
    <!-- Mobile navbar-->
    <ul class="sidenav" id="mobile-Barra">
        <!--SESSION -->
        <?php if (isset($user)) { ?>
            <li>
                <div class="user-view">
                    <div class="background">
                        <img src="assets/images/office.jpg">
                    </div>
                    <a href="#user"><img class="circle" src="<?php echo $_SESSION["ProfilePic"]; ?> "></a>
                    <a href="#name"><span class="white-text name"><?php echo $_SESSION["NombreUsuario"]; ?></span></a>
                    <a href="#email"><span class="white-text email"><?php echo $_SESSION["email"]; ?></span></a>
                </div>
            </li>

        <?php } else { ?>
            <!-- Modal Trigger -->
            <li>
                <a class="waves-effect  waves-light btn modal-trigger " href="#modalLogin">
                    Login
                </a>
            </li>
            <li>
                <a class="waves-effect  waves-light  modal-trigger " href="#modalRegistro">
                    Registrarse
                    <i class="fa fa-sign-in-alt left center"></i>
                </a>
            </li>
            <li class="divider"></li>
        <?php } ?>
        <li><a href="">Acerca de</a></li>
        <!--Navegador mobil-->
        <?php if (isset($user)) { ?>
            <li class="divider"></li>
            <?php if (!strpos($_SERVER['REQUEST_URI'], 'myProfile')) {
                    echo "<li><a href='myProfile'>Mi Perfil</a></li>";
                } ?>
            <?php if (!strpos($_SERVER['REQUEST_URI'], 'historial')) {
                    echo "<li><a href='historial'>Historial de envios</a></li>";
                } ?>

            <?php if ($_SESSION['TipoDeUsuario'] == 'Admin') {
                    if (!strpos($_SERVER['REQUEST_URI'], 'Administrador')) {
                        echo "<li><a href='Administrador'>Interfaz de administrador</a></li>";
                    }
                    if (!strpos($_SERVER['REQUEST_URI'], 'Estadisticas')) {
                        echo "<li><a href='Estadisticas'>Estadisticas</a></li>";
                    }
                }
                ?><li class="divider"></li>
            <li><a href="inc\cerrarS" class="fas fa-sign-out-alt">Cerrar Sesion</a></li>
        <?php } ?>
        <!--END MODAL TRIGGER-->
    </ul>
    <!--END mobil-->

    <?php if (!isset($user)) { ?>
        <!-- ModalLogin Structure -->
        <div id="modalLogin" class="modal">
            <div class="modal-content">
                <div class="row center-align">
                    <h4>Iniciar Sesion</h4>
                </div>
                <form id="formLogin" method="post">
                    <div class="row">
                        <div class="col s12 input-field">
                            <i class="fa fa-user prefix"></i>
                            <input id="usr" name="usr" type="text" class="input1" autocomplete="off" data-validetta="required,email,minLength[8],maxLength[64]">
                            <label for="usr">CorreoElectronico</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 input-field">
                            <i class="fa fa-key prefix"></i>
                            <input id="psw0" name="psw0" type="password" class="input2" autocomplete="off" data-validetta="required,minLength[6],maxLength[12]">
                            <label for="psw0">Contraseña</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="center-align col s6 input-field ">
                            <input id="btnLogin" type="submit" class="btn" value="Iniciar Sesion">
                        </div>
                </form>
                <div class="center-align  col s6 input-field">
                    <div class="modal-footer">
                        <a href="#!" class="modal-close waves-effect btn waves-green btn-flat">Cerrar</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- ModalRegistro Structure -->
        <div id="modalRegistro" class="modal full">
            <div class="modal-content">
                <form id="formRegistro" method="post">
                    <div class="row center-align">
                        <h4>Registro</h4>
                    </div>
                    <div class="row">
                        <div class=" col s12 m6 l3 input-field">
                            <i class="fas fa-at prefix"></i>
                            <input id="email" name="email" type="text" class="input1" autocomplete="off" data-validetta="required,email,minLength[8],maxLength[64]">
                            <label for="email">CorreoElectronico</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col s12 m6 l3 input-field">
                            <i class="fa fa-user prefix"></i>
                            <input id="name" name="name" type="text" class="input2" autocomplete="off" data-validetta="required,minLength[4],maxLength[32]">
                            <label for="name">Nombre</label>
                        </div>
                        <div class=" col s12 m6 l3 input-field">
                            <input id="primerAp" name="primerAp" type="text" class="input3" autocomplete="off" data-validetta="required,minLength[4],maxLength[32]">
                            <label for="primerAp">Primer Apellido</label>
                        </div>
                        <div class=" col s12 m6 l3 input-field">
                            <input id="segundoAp" name="segundoAp" type="text" class="input4" autocomplete="off" data-validetta="required,minLength[4],maxLength[32]">
                            <label for="segundoAp">Segundo Apellido</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col s12 m6 l3 input-field">
                            <i class="fa fa-calendar prefix"></i>
                            <input type="text" class="datepicker" id="FechaNac" name="FechaNac" autocomplete="off">
                            <label for="FechaNac">FechaNacimiento</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col s12 m6 l3 input-field">
                            <i class="fa fa-key prefix"></i>
                            <input id="psw" name="psw" type="password" class="input5" autocomplete="off" data-validetta="required,minLength[6],maxLength[12]">
                            <label for="psw">Contraseña</label>
                        </div>
                        <div class=" col s12 m6 l3 input-field">
                            <input id="pswConfirm" name="pswConfirm" type="password" class="input6" autocomplete="off" data-validetta="required,minLength[6],maxLength[12],equalTo[psw]">
                            <label for="pswConfirm">Repetir contraseña</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col s6 input-field ">
                            <input id="btnRegistro" type="submit" class="btn" value="Registrarse">
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
    <?php } ?>
</header>
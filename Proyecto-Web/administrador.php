<?php

////Conexion 
include_once 'inc/Tools.php';
$connect = new Tools();
$conexion = $connect->connectDB();
session_start();

if (!empty($_SESSION['NombreUsuario']) && $_SESSION['TipoDeUsuario'] == 'Admin') {
    $user = $_SESSION['NombreUsuario'];
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
    <title>Herramientas de administración</title>
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

<body>
    <?php require_once('mod/header.php'); ?>
    <main>
        <div class="row black">
            <div class="col s12 center-align white-text">
                <h1>Panel de administración</h1>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <ul class="tabs">
                    <li class="tab col s4"><a href="#Usuarios">Usuarios</a></li>
                    <li class="tab col s4"><a href="#Postales">Postales</a></li>
                    <li class="tab col s4"><a href="#Categorias">Categorias</a></li>
                </ul>
            </div>
            <!--Declarar cada div-->
            <!--DIV DE USUARIO-->|
            <div id="Usuarios" class="col s12">
                <div class="row">
                    <div class="row center-align">
                        <h4>Usuarios</h4>
                    </div>
                </div>
                <div class="row col s12 center-align">
                    <table class="responsive-table centered display" id="Usuario" class="display responsive nowrap" style="width:100%">
                        <thead class="black-text colorTema ">
                            <tr>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Estatus</th>
                                <th><br><br> Imagen de perfil <br><br></th>
                                <th>Privilegios</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM usuario";
                            $result = mysqli_query($conexion, $sql);
                            while ($mostrar = mysqli_fetch_array($result)) { ?>
                                <tr>
                                    <td><?php echo $mostrar['nombre'] ?></td>
                                    <td><?php echo $mostrar['email'] ?></td>
                                    <td><?php echo $mostrar['estado'] ?></td>
                                    <td><img id="profile_Img" src="<?php echo  $mostrar["profile_Img"]; ?>" alt="profile_Img" style="height:100px;" /></td>
                                    <td><?php echo $mostrar['tipoUser'] ?></td>
                                    <td>
                                        <button class="btn white black-text modal-trigger" href="#modalModificarUser" onclick="editarUsuario('<?php echo $mostrar['idUser'] ?>','<?php echo $mostrar['nombre'] ?>', '<?php echo $mostrar['email'] ?>', '<?php echo $mostrar['estado'] ?>', '<?php echo $mostrar['tipoUser'] ?>' )">EDITAR</button>
                                        <form action="inc/eliminarUs.php" method="POST">
                                            <input type="hidden" name="idUser" id="idUser" value="<?php echo $mostrar['idUser'] ?>">
                                            <button class="btn red black-text">ELIMINAR</button>
                                        </form>

                                    </td>
                                </tr>
                            <?php
                            } ?>
                        </tbody>
                    </table>
                </div>


                <!--Modificar-->
                <div id="modalModificarUser" class="modal" style="top:0px">
                    <div class="modal-content">
                        <form id="formModificarUser" name="formModificarUser" method="POST">
                            <div class="row">

                                <div class="col s12 center-align">
                                    <h4>Editar usuario</h4>
                                </div>
                            </div>
                            <div class="container lighten-1">
                                <div class="row">
                                    <input id="idU" name="idU" type="hidden" class="input">
                                    <div class="col s12 input-field">
                                        <i class="fas fa-user prefix"></i>
                                        <input type="text" value=" " id="nombreUser"  name="nombreUser" class="input" autocomplete="off" readonly>
                                        <label for="nombreUser">Nombre Usuario</label>
                                    </div>
                                    <div class=" col s12 input-field">
                                        <i class="fas fa-at prefix"></i>
                                        <input type="text" value=" " id="emailU" name="emailU" class="input" autocomplete="off" readonly>
                                        <label for="emailU">Email</label>
                                        <br>
                                    </div>
                                    <div class="input-field col s12">
                                        <select id="priviU" name="priviU"  >  
                                            <option value="Normal">Normal</option>
                                            <option value="Admin">Admin</option>
                                        </select>
                                        <label>Privilegios</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <select id="estaU" name="estaU">  
                                            <option value="Activo">Activo</option>
                                            <option value="Inactivo">Inactivo</option>
                                        </select>
                                        <label>Estatus</label>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class=" col s6 input-field ">
                                        <input id="btnAgregar1" type="submit" class="btn" value="Guardar">
                                    </div>
                                    <div class=" col s6 input-field">
                                        <div class="modal-footer">
                                            <a href="#Usuarios" class="modal-close waves-effect btn waves-green btn-flat">Cerrar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
            <!--div final de usuarios-->


            <div id="Postales" class="col s12">
                <div class="row center-align">
                    <div class="row center-align">
                        <h4>Postales</h4>
                    </div>
                </div>
                <div class="row col s12 center-align">
                    <table class="responsive-table centered display" id="Postal" class="display responsive nowrap" style="width:100%">

                        <thead class="black-text">
                            <tr>
                                <th>ID postal</th>
                                <th>Descripción</th>
                                <th>Categoria</th>
                                <th><br><br>Imagen<br><br><br></th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $sql = "SELECT * FROM postal";
                            $result = mysqli_query($conexion, $sql);

                            while ($mostrar = mysqli_fetch_array($result)) { ?>
                                <tr>
                                    <td><?php echo $mostrar['idPostal'] ?></td>
                                    <td><?php echo $mostrar['descripcion'] ?></td>
                                    <td><?php echo $mostrar['idCat'] ?></td>
                                    <td><img id="dirPostal" src="<?php echo  $mostrar["dirPostal"]; ?>" alt="dirPostal" style="height:100px;" /></td>
                                    <td>
                                        <button class="btn white black-text modal-trigger" href="#modalEditaPos" onclick="editarPos('<?php echo $mostrar['idPostal'] ?>','<?php echo $mostrar['descripcion'] ?>', '<?php echo $mostrar['idCat'] ?>' )">EDITAR</button>

                                        <form action="inc/eliminarPostal.php" method="POST">
                                            <input type="hidden" name="idPostal" id="idPostal" value="<?php echo $mostrar['idPostal'] ?>">
                                            <button class="btn red black-text">ELIMINAR</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                            } ?>
                        </tbody>
                    </table>
                    <br>
                    <br>
                    <div class="col s6 black-text left-align"><button class="btn white black-text modal-trigger" href="#modalAgregaPos">Agregar postal nueva</button></div>
                </div>


                <!--Añadir postal -->
                <div id="modalAgregaPos" class="modal" style="top:0px">
                    <div class="modal-content">
                        <form id="formAgregaPos" enctype="multipart/form-data" method="post">
                            <div class="row">
                                <div class="col s12 center-align">
                                    <h4>Agregar Postal</h4>
                                </div>
                            </div>
                            <div class="container lighten-1">
                                <div class="row">
                                    <div class=" col s12 input-field">
                                        <label for="descPos">Descripción de la postal</label>
                                        <input id="descPos" name="descPos" type="text" class="input" autocomplete="off" data-validetta="required,minLength[4],maxLength[32]">

                                    </div>
                                    <label for="categoria">Selecciona ID de la categoría</label><br><br><br>

                                    <select id="Pcategoria" class="input" name="Pcategoria" style="display:block !important;">

                                    </select><br><br>

                                    <div class="btn">
                                        <span>Seleccionar postal</span>
                                        <input type="file" id="Npostal" name="Npostal" class="input" accept="image/*">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class=" col s6 input-field ">
                                        <input id="btnAgregar" type="submit" class="btn" value="Guardar">
                                    </div>
                                    <div class=" col s6 input-field">
                                        <div class="modal-footer">
                                            <a href="#Postales" class="modal-close waves-effect btn waves-green btn-flat">Cerrar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!--Editar postal -->
                <!--Editar postal -->
                <div id="modalEditaPos" class="modal" style="top:0px">
                    <div class="modal-content">
                        <form id="formEditaPos" enctype="multipart/form-data" method="post">
                            <div class="row">
                                <div class="col s12 center-align">
                                    <h4>Editar Postal</h4>
                                </div>
                            </div>
                            <div class="container lighten-1">
                                <div class="row">
                                    <div class=" col s12 input-field">
                                        <input id="idEP" name="idEP" type="hidden" class="input">
                                        <label for="Edesc">Descripción de la postal</label>
                                        <input id="Edesc" name="Edesc" type="text" class="input" autocomplete="off" data-validetta="required,minLength[4],maxLength[40]">

                                    </div>
                                    <label for="Ecategoria">Selecciona ID de la categoría</label><br><br><br>

                                    <select id="Ecategoria" class="input" name="Ecategoria" style="display:block !important;">

                                    </select><br><br>
                                    <!--<div class="btn">

                                            <span>Puede seleccionar una nueva postal</span>
                                            <input type="file" id="Epostal" name="Epostal" class="input" accept="image/*">
                                        </div> -->
                                </div>
                                <br>
                                <div class="row">
                                    <div class=" col s6 input-field ">
                                        <input id="btnAgregar" type="submit" class="btn" value="Guardar">
                                    </div>
                                    <div class=" col s6 input-field">
                                        <div class="modal-footer">
                                            <a href="#Postales" class="modal-close waves-effect btn waves-green btn-flat">Cerrar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--div final de postales-->


            <div id="Categorias" class="col s12">
                <div class="row center-align">
                    <div class="row center-align">
                        <h4>Categorias</h4>
                    </div>
                </div>
                <div class="row col s12">
                    <table class="responsive-table centered display" id="Categoria" class="display responsive nowrap" style="width:100%">
                        <thead class="black-text">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Acciones
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $sql = "SELECT * FROM categoria";
                            $result = mysqli_query($conexion, $sql);
                            while ($mostrar = mysqli_fetch_array($result)) { ?>
                                <tr>
                                    <td><?php echo $mostrar['idcategoria'] ?></td>
                                    <td><?php echo $mostrar['nombreCat'] ?></td>
                                    <td><button class="btn white black-text modal-trigger" href="#modalModificarC" onclick="editarReg(<?php echo $mostrar['idcategoria'] ?>,'<?php echo $mostrar['nombreCat'] ?>')">EDITAR</button></td>
                                    <td>
                                        <form action="inc/eliminarC.php" method="POST">
                                            <input type="hidden" name="idcategoria" id="idcategoria" value="<?php echo $mostrar['idcategoria'] ?>">
                                            <button class="btn red black-text">ELIMINAR</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                            } ?>
                        </tbody>
                    </table>
                    <br>
                    <br>
                    <div class="col s12 black-text left-align"><button class="btn white black-text modal-trigger" href="#modalAgregarC">Añadir categoria</button></div>
                    <!--Agregar categoría-->
                    <div id="modalAgregarC" class="modal" style="top:0px">
                        <div class="modal-content">
                            <form id="formAgregarC" method="post">
                                <div class="row">
                                    <div class="col s12 center-align">
                                        <h4>Agregar categoría</h4>
                                    </div>
                                </div>
                                <div class="container lighten-1">
                                    <div class="row">
                                        <div class=" col s12 input-field">
                                            <label for="NombreCate">Nombre de la categoría</label>
                                            <input id="NombreCate" name="NombreCate" type="text" class="input" autocomplete="off" data-validetta="required,minLength[4],maxLength[32]">

                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class=" col s6 input-field ">
                                            <input id="btnAgregar" type="submit" class="btn" value="Guardar">
                                        </div>
                                        <div class=" col s6 input-field">
                                            <div class="modal-footer">
                                                <a href="#Categorias" class="modal-close waves-effect btn waves-green btn-flat">Cerrar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--Modificar-->
                <div id="modalModificarC" class="modal" style="top:0px">
                    <div class="modal-content">
                        <form id="formModificarC" method="POST">
                            <div class="row">

                                <div class="col s12 center-align">
                                    <h4>Modificar categoría</h4>
                                </div>
                            </div>
                            <div class="container lighten-1">
                                <div class="row">
                                    <div class=" col s12 input-field">

                                        <p>Nuevo nombre para la categoría</p>
                                        <input id="editaC" name="editaC" type="text" class="input" autocomplete="off">
                                        <input id="idCate" name="idCate" type="hidden">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class=" col s6 input-field ">
                                        <input id="btnAgregar3" type="submit" class="btn" value="Guardar">
                                    </div>
                                    <div class=" col s6 input-field">
                                        <div class="modal-footer">
                                            <a href="#Categorias" class="modal-close waves-effect btn waves-green btn-flat">Cerrar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
            <!--div final de categorias-->
        </div>
        <!--FOOTER-->
        <?php require_once('mod/footer.html'); ?>

        <!--JavaScript at end of body for optimized loading-->
        <script src="assets/js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="assets/js/materialize.js"></script>
        <script src="assets/js/validetta.min.js"></script>
        <script src="assets/js/validettaLang-es-ES.js"></script>
        <script src="assets/js/jquery-confirm.min.js"></script>
        <script src="assets/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/dataTables.responsive.min.js"></script>


        <script src="js/administrador.js"></script>

</body>


</html>
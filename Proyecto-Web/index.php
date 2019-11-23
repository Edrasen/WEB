<?php
session_start();
include_once 'inc/Tools.php';
include_once 'inc/catalogo.php';
//SESSION
if (!empty($_SESSION['NombreUsuario'])) {
    $user = $_SESSION['NombreUsuario'];
    //$profilePic=$_SESSION['RutaFotoPerfil'];
}
//Paginas
if (empty($_GET['Pagina'])) {
    $numpagina = 1; //SI NO HAY GET POR DEFAULT PAGINA 1
} else if ($_GET['Pagina'] > 0) {
    $numpagina = $_GET['Pagina'];
} else {
    header('Location: 404.php');
}
//Filtros
if (empty($_COOKIE['Filtros'])) {
    $Filtros = array();
} else {
    eval($_COOKIE["Filtros"]);
}

//QUERY CATALOGO separando los filtros y la query 
$pagina = 6 * ($numpagina - 1);
$sql = "SELECT * FROM postal pst, categoria cat WHERE pst.idCat=cat.IdCategoria ";
$filtrosSQL = "";
//VolcarFiltros
for ($i = 0; $i < count($Filtros); $i++) {
    if ($i == 0) {
        $filtrosSQL = "AND (";
    }
    $filtrosSQL .= "cat.nombreCat=\"" . $Filtros[$i] . "\" OR ";
    if ($i == (count($Filtros) - 1)) {
        $filtrosSQL = substr_replace($filtrosSQL, "", -3); //ELIMINA EL ULTIMO OR
        $filtrosSQL .= ")";
    }
}
$sql .= $filtrosSQL .  "limit 6 offset $pagina;"; //junta la query con los filtros
$paginasTotal = ceil(cuentaPaginas($filtrosSQL) / 6); //CUENTA LAS PAGINAS A CREAR  BASANDOSE EN LA QUERY CON FILTROS

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Postal</title>

    <!-- Facebook Opengraph integration: https://developers.facebook.com/docs/sharing/opengraph -->
    <meta property="og:title" content="Postal :)">
    <meta property="og:image" content="Img/postal.jpg">
    <meta property="og:url" content="">
    <meta property="og:site_name" content="POSTAL">
    <meta property="og:description" content="En esta pagina puedes mandar postales :)">


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
    <main>
        <div id="main" class="main-full">
            <!--Body-->
            <div class="row">
                <div class="content-wrapper-before brown darken-2"></div>
                <div class="breadcrumbs-header " id="breadcrumbs-wrapper">
                    <nav>
                        <div class="nav-wrapper black">
                            <div class="col s12 ">
                                <a href="#" class="breadcrumb">Catalogo Postales</a>
                            </div>
                        </div>
                    </nav>
                </div>

                <div class="col s12">
                    <div class="section">
                        <!-- Pagination -->
                        <?php Paginacion($numpagina, $paginasTotal); ?>
                        <!--Filtros-->
                        <div class="col s12 m12 l2 animate" id="">
                            <div class="card">
                                <div class="card-content">
                                    <span class="card-title mt-10">Categorias</span>
                                    <hr class="p-0 mb-10">

                                    <form action="inc/FiltrosCookie.php" method="POST" id="FormFiltro" name="FormFiltro" class="display-grid">
                                        <?php traeCategoriasFiltro($Filtros);  ?>
                                        <br>
                                        <label>
                                            <input id="SubmitFiltro" name="SubmitFiltro" type="submit" value="Aplicar Filtros" class="btn waves-button-input">
                                        </label>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!--/ Filtros-->
                        <!--Postal--->
                        <div class="col s12 m12 l10">
                            <?php
                            ////Conexion 
                            $i = 0;
                            $connect = new Tools();
                            $conn = $connect->connectDB();
                            $res = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($res)) {
                                while ($row = $res->fetch_assoc()) {
                                    if ($i % 2 == 0) { ?>
                                        <div class="row">
                                        <?php
                                                } ?>
                                        <div class="col s12 m6 l6 centered">
                                            <div class="card" style="height:auto;">
                                                <div class="card-image" >
                                                    <img src="<?php echo $row['dirPostal'];
                                                                        $i++; ?>", style="max-height:280px;">
                                                </div>
                                                <div class="card-action green-text center-align">
                                                    <a href="sendpostal?id=<?php echo $row['idPostal'] ?>" class="btn waves-button-input">Enviar postal</a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                                if ($i % 2 == 0) { ?>
                                        </div>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                        <!-- Pagination -->
                        <?php Paginacion($numpagina, $paginasTotal); ?>
                    </div>
                </div>
            </div><!-- START RIGHT SIDEBAR NAV -->
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
    <script src="js/index.js"></script>
</body>


</html>
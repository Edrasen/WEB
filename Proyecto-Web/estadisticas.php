<?php
session_start();

if (!empty($_SESSION['NombreUsuario']) && $_SESSION['TipoDeUsuario'] == 'Admin') {
    $user = $_SESSION['NombreUsuario'];
} else {
    header('Location: index.php');
}

include_once("inc/config.php");
include_once("chartphp/inc/chartphp_dist.php");
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
    <!--fontsawensome-->
    <link rel="Stylesheet" href="assets/css/validetta.min.css">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Graficador-->
    <link rel="stylesheet" href="chartphp/js/chartphp.css">
    <script src="chartphp/js/chartphp.js"></script>
    <script src="chartphp/js/jquery.min.js"></script>
</head>

<body>
    <?php require_once('mod/header.php'); ?>
    <main>
        <!--Declarar cada div-->
        <div id="Estadisticas" class="container">
            <div class="row center-align">
                <h3>Estadisticas de envios</h3>
                <div class="col s12 m12 l12">
                    <?php
                    $p = new chartphp();
                    $p->data_sql = "SELECT nombreCat, count(*)  FROM categoria cat, envio env ,postal pst WHERE cat.idcategoria=pst.idCat and pst.idpostal=env.idPostal  GROUP BY nombreCat; ";
                    $p->chart_type = "pie";
                    // Common Options
                    $p->title = "Categorias mas enviadas";
                    $out = $p->render('c0');
                    ?>
                    <div>
                        <div>
                            <?php echo $out; ?>
                        </div>
                    </div>
                </div>
                <?php
                ////Conexion 
                include_once 'inc/Tools.php';
                $connect = new Tools();
                $conn = $connect->connectDB();
                //query
                $sql = "SELECT * FROM categoria;";
                $res = mysqli_query($conn, $sql);
                $i = 1;
                if (mysqli_num_rows($res)) {
                    while ($row = $res->fetch_assoc()) { ?>
                        <div class="col s12 m6 l6">
                            <!--Grafica por cada una de las Categorias-->
                            <?php
                                    $p = new chartphp();
                                    $p->data_sql = "SELECT pst.descripcion, count(*)  FROM categoria cat,envio env ,postal pst WHERE cat.idcategoria=" . $row['idcategoria'] . " and cat.idcategoria=pst.idCat and pst.idpostal=env.idPostal  GROUP BY pst.idPostal;";
                                    $p->chart_type = "pie";
                                    // Common Options
                                    $asignacion = "
                                        \$p->title = \"Postal mas enviada de " . $row['nombreCat'] . "\"; 
                                        \$out = \$p->render('c" . $i++ . "');";
                                    eval($asignacion);
                                    ?>
                            <?php echo $out; ?>
                        </div>
                <?php
                    }
                }
                //Cierraconexion
                $connect->disconnectDB($conn); ?>
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

    <script src="js/administrador.js"></script>

</body>


</html>
<?php
//FILTROS
if (isset($_POST['SubmitFiltro'])) {
    $asignacion = "\$Filtros=array( ";
    foreach ($_POST as $nombre_campo => $valor) {
        if ($nombre_campo != "SubmitFiltro") {
            $asignacion .= "\"$nombre_campo\",";
        }
    }
    $asignacion = substr_replace($asignacion, "", -1); //ELIMINA LA ULTIMA ,
    $asignacion .= "); ";
    unset($_COOKIE["Filtros"]);
    setcookie("Filtros", $asignacion, time()+3600 ,'/');
} else {
    $Filtros = array();
}

header('Location: ../index');
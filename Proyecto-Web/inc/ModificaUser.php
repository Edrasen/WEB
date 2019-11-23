<?php
session_start();

$idU = $_POST['idU'];
$nombreUser = $_POST['nombreUser'];
$emailU = $_POST['emailU'];
$priviU = $_POST['priviU'];
$estaU = $_POST['estaU'];

if (strpos($idU, "'") || strpos($nombreUser, "'") || strpos($emailU, "'") || strpos($priviU, "'") || strpos($estaU, "'")) {
    echo json_encode(array('success' => 0)); //ERROR

} else {
    ////Conexion 
    include_once 'Tools.php';
    $connect = new Tools();
    $conn = $connect->connectDB();
        //query
        $sql = "UPDATE usuario SET email='$emailU' , nombre='$nombreUser' , tipoUser='$priviU' , estado='$estaU' WHERE idUser ='$idU'";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(array('success' => 1)); //BIEN
        } else {
            echo json_encode(array('success' => '' . mysqli_error($conn) . '')); //ERROR
        }
    //Cierraconexion
    $connect->disconnectDB($conn);
} 
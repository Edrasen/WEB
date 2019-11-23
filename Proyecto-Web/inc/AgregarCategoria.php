<?php
session_start();

$NombreCate = $_POST['NombreCate'];
if(empty($NombreCate)){
    echo json_encode(array('success' => 0)); //ERROR
    echo json_encode(array('message' => "Vacía")); //ERROR
    return 0;
}
if (strpos($NombreCate, "'") !== false) {
    echo json_encode(array('success' => 0)); //ERROR

} else {
    ////Conexion 
    include_once 'Tools.php';
    $connect = new Tools();
    $conn = $connect->connectDB();
        //query
        $sql = "INSERT INTO categoria (nombreCat) VALUES ('$NombreCate')";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(array('success' => 1)); //BIEN
        } else {
            echo json_encode(array('success' => '' . mysqli_error($conn) . '')); //ERROR
        }
    //Cierraconexion
    $connect->disconnectDB($conn);
} 
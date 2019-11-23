<?php


$idCate = $_POST['idCate'];
$editaC = $_POST['editaC'];

if(empty($_POST['editaC'])){
    echo json_encode(array('success' => 0)); //ERROR
    echo json_encode(array('message' => "Vacía")); //ERROR
    return 0;
}
if (strpos($idCate, "'")) {
    echo json_encode(array('success' => 0)); //ERROR

} else {
    ////Conexion 
    include_once 'Tools.php';
    $connect = new Tools();
    $conn = $connect->connectDB();
        //query
        $sql = "UPDATE categoria SET nombreCat='$editaC' WHERE idcategoria ='$idCate'";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(array('success' => 1)); //BIEN
        } else {
            echo json_encode(array('success' => '' . mysqli_error($conn) . '')); //ERROR
        }
    //Cierraconexion
    $connect->disconnectDB($conn);
} 
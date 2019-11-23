<?php

//PREPARA LA SESSION
session_start();

$email = $_SESSION["email"];
$target_file = $_SESSION["ProfilePic"];
$name = $_POST['name'];
$primerAp = $_POST['primerAp'];
$segundoAp = $_POST['segundoAp'];
$FechaNac = $_POST['FechaNac'];
$psw = md5($_POST['psw']);

//Revisamos que la contraseña coincida
if( $psw != $_SESSION["Password"]){
    echo json_encode(array('message' => 'Error Contraseña'));
    return 0;
}
/////////////////SUBIR IMAGEN/////////////////
if (basename($_FILES["profilePic"]["name"])) {
    $target_dir = "../Img/";
    $filename = basename($_FILES["profilePic"]["name"]);
    $target_file = $target_dir . $filename;
    $uploadOk = 1;
    //OBTIENE EL TIPO DE IMAGEN
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    /// VERIFICA que se trate de una imagen
    $check = getimagesize($_FILES["profilePic"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo json_encode(array('message' => 'Su archivo no es una imagen'));
        return 0;
    }
    // Revisa el tamaño de la imagen
    if ($_FILES["profilePic"]["size"] > 1000000) {
        echo json_encode(array('message' => 'Su archivo es muy grande'));
        return 0;
    }
    // Filtra el formato de la imagen
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo json_encode(array('message' => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.'));
        return 0;
    }
    // Revisa que la confirmacion $uploadOk este en 1 para poder subirla 
    if ($uploadOk == 0) {
        return 0;
    } else {
        if (move_uploaded_file($_FILES["profilePic"]["tmp_name"], $target_file)) {
            rename($target_file, $target_dir . '/' . md5($_SESSION["email"]) . "." . $imageFileType);
            $target_file = 'Img/' . md5($_SESSION["email"]) . "." . $imageFileType;
            $uploadOk=1;
        } else {
            echo json_encode(array('message' => 'Error Subiendo el archivo'));
            return 0;
        }
    }
} else {
    $uploadOk=1;
    $target_file = $_SESSION["ProfilePic"];//SI NO SUBIO NINGUNA IMAGEN CONSERVA LA QUE TENIA
}
//////////////////////////////////////////////////Inserta en la base de datos //////////////////////////////////////////////////
if (strpos($email, "'")  || strpos($name, "'")  || strpos($primerAp, "'")  || strpos($segundoAp, "'")  || strpos($FechaNac, "'")  || $uploadOk == 0) {
    echo json_encode(array('success' => 0)); //ERROR
} else {
    ////Conexion 
    include_once 'Tools.php';
    $connect = new Tools();
    $conn = $connect->connectDB();
    //query
    $sql = "UPDATE usuario SET nombre='$name' , primerAp='$primerAp' , segundoAp='$segundoAp' , fechaNac='$FechaNac' , profile_Img='$target_file' WHERE IdUser ='" . $_SESSION["IdUser"] . "'";
    if (mysqli_query($conn, $sql)) {
        session_unset(); // remove all session variables
        session_destroy(); // destroy the session
        session_start(); //Reinicia la session
        include_once('IniciarSesioFunc.php');
        IniciarSesion($email, $psw);
        echo json_encode(array('success' => 1)); //BIEN
    } else {
        echo json_encode(array('success' => '' . mysqli_error($conn) . '')); //ERROR
    }
    //Cierraconexion
    $connect->disconnectDB($conn);
}

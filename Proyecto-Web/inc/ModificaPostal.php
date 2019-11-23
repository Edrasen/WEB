<?php
session_start();

$idEP = $_POST['idEP'];
$Edesc = $_POST['Edesc'];
$Ecategoria = $_POST['Ecategoria'];
$target_file = $_POST['Epostal']['name'];

/*/////////////////SUBIR IMAGEN/////////////////
if (basename($_FILES["Epostal"]["name"])) {
    $target_dir = "Img/";
    $filename = basename($_FILES["Epostal"]["name"]);
    $target_file = $target_dir . $filename;
    $uploadOk = 1;
    //OBTIENE EL TIPO DE IMAGEN
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    /// VERIFICA que se trate de una imagen
    $check = getimagesize($_FILES["Epostal"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo json_encode(array('message' => 'Su archivo no es una imagen'));
        return 0;
    }
    // Revisa el tamaño de la imagen
    if ($_FILES["Epostal"]["size"] > 1000000) {
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
    } 
} else {
    $uploadOk=1;
    $target_file = $_POST["Epostal"];//SI NO SUBIO NINGUNA IMAGEN CONSERVA LA QUE TENIA
}*/

//////////////////////////////////////////////////Inserta en la base de datos //////////////////////////////////////////////////
if(empty($idEP)){
    echo json_encode(array('success' => 0)); //ERROR
    echo json_encode(array('message' => "Vacía")); //ERROR
    return 0;
}

if (strpos($idEP, "") || strpos($Edesc, "") || strpos($Ecategoria , "")) /*|| $uploadOk == 0)*/ {
    echo json_encode(array('success' => 0)); //ERROR
} else {
    ////Conexion 
    include_once 'Tools.php';
    $connect = new Tools();
    $conn = $connect->connectDB();
    //query
    $sql = "UPDATE postal SET descripcion='$Edesc' , idCat='$Ecategoria' /*, dirPostal='$target_file'*/ WHERE idPostal ='$idEP'";
     if (mysqli_query($conn, $sql)) {
            echo json_encode(array('success' => 1)); //BIEN
        } else {
            echo json_encode(array('success' => '' . mysqli_error($conn) . '')); //ERROR
        }
    //Cierraconexion
    $connect->disconnectDB($conn);
}
<?php
session_start();

$descPos = $_POST['descPos'];
$Pcategoria = $_POST['Pcategoria'];
$dirPostal = $_POST['dirPostal'];

/////////////////SUBIR IMAGEN/////////////////
if (basename($_FILES["dirPostal"]["name"])) {
    $target_dir = "../Img/";
    $filename = basename($_FILES["dirPostal"]["name"]);
    $target_file = $target_dir . $filename;
    $uploadOk = 1;
    //OBTIENE EL TIPO DE IMAGEN
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    /// VERIFICA que se trate de una imagen
    $check = getimagesize($_FILES["dirPostal"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo json_encode(array('message' => 'Su archivo no es una imagen'));
        return 0;
    }
    // Revisa el tamaño de la imagen
    if ($_FILES["dirPostal"]["size"] > 1000000) {
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
        if (move_uploaded_file($_FILES["dirPostal"]["tmp_name"], $target_file)) {
            rename($target_file, $target_dir . '/' . "." . $imageFileType);
            $target_file = 'Img/' . "." . $imageFileType;
            $uploadOk=1;
        } else {
            echo json_encode(array('message' => 'Error Subiendo el archivo'));
            return 0;
        }
    }
} else {
    $uploadOk=1;
}
//////////////////////////////////////////////////Inserta en la base de datos //////////////////////////////////////////////////
if (strpos($descPos, "'")  || strpos($Pcategoria, "'")  || $uploadOk == 0) {
    echo json_encode(array('success' => 0)); //ERROR
} else {
    ////Conexion 
    include_once 'Tools.php';
    $connect = new Tools();
    $conn = $connect->connectDB();
    //query
    $sql = "UPDATE postal SET descripcion='$descPos' , dirPostal='$target_file' , idCat='$Pcategoria' ";
     if (mysqli_query($conn, $sql)) {
            echo json_encode(array('success' => 1)); //BIEN
        } else {
            echo json_encode(array('success' => '' . mysqli_error($conn) . '')); //ERROR
        }
    //Cierraconexion
    $connect->disconnectDB($conn);
}
<?php
$email = $_POST['email'];
$name = $_POST['name'];
$primerAp = $_POST['primerAp'];
$segundoAp = $_POST['segundoAp'];
$FechaNac = $_POST['FechaNac'];
$psw = md5($_POST['psw']);
$pswConfirm = md5($_POST['pswConfirm']);

if (strpos($email, "'")  || strpos($name, "'")  || strpos($primerAp, "'")  || strpos($segundoAp, "'")  || strpos($FechaNac, "'") || ($psw !== $pswConfirm) !== false) {
    echo json_encode(array('succesfs' => 0)); //ERROR
} else {
    ////Conexion 
    include_once 'Tools.php';
    $connect = new Tools();
    $conn = $connect->connectDB();
    $sql = "SELECT * FROM usuario WHERE email='$email'";
    $res=mysqli_query($conn, $sql);
    if (mysqli_num_rows($res)) {
        echo json_encode(array('success' => 'CorreoYaRegistrado')); //ERROR
    } else {
        //query
        $sql = "INSERT INTO usuario(email,nombre,primerAp,segundoAp,contrasena,fechaNac,tipoUser,estado,profile_Img) VALUES ('$email','$name','$primerAp','$segundoAp','$psw','$FechaNac','Normal','Activo','Img/yuna.jpg')";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(array('success' => 1)); //BIEN
        } else {
            echo json_encode(array('success' => '' . mysqli_error($conn) . '')); //ERROR
        }
    }
    //Cierraconexion
    $connect->disconnectDB($conn);
}

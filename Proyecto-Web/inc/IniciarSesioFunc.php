<?php
//PREPARA LA SESSION
function IniciarSesion($user, $contrasena): int {
    if (strpos($user, "'") !== false) {
        // remove all session variables
        session_unset();
        // destroy the session
        session_destroy();
        return 0;
    } else {
        ////Conexion 
        include_once 'Tools.php';
        $connect = new Tools();
        $conn = $connect->connectDB();
        //query
        $sql = "SELECT * FROM  usuario where email='$user' and contrasena='$contrasena' and estado='Activo'";
        $res = mysqli_query($conn, $sql);
        if (mysqli_num_rows($res)) {
            $row = $res->fetch_assoc();
            //Crea La sesion y la llena 
            $_SESSION["IdUser"] = $row["idUser"];
            $_SESSION["NombreUsuario"] = $row["nombre"] . " " . $row["primerAp"] . " " . $row["segundoAp"];
            $_SESSION["Nombre"] = $row["nombre"];
            $_SESSION["PrimerAp"] = $row["primerAp"];
            $_SESSION["SegundoAp"] = $row["segundoAp"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["FechaNacimiento"] = $row["fechaNac"];
            $_SESSION["ProfilePic"] = $row["profile_Img"];
            $_SESSION["TipoDeUsuario"] = $row["tipoUser"];
            $_SESSION["Password"] = $row["contrasena"];
            //Cierraconexion
            $connect->disconnectDB($conn);
            return 1;
        } else {
            //Cierraconexion
            $connect->disconnectDB($conn);
            //Elimina la sesion
            session_unset();
            session_destroy();
            return 0;
        }
    }
}

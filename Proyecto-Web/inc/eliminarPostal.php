<?php
	session_start();
	 ////Conexion 
        include_once 'Tools.php';
        $connect = new Tools();
        $conn = $connect->connectDB();
        //query
        $sql = "SELECT * FROM  usuario where email='".$_SESSION["email"]."' and tipoUser = 'Admin'";
        $res = mysqli_query($conn, $sql);
        if (mysqli_num_rows($res)) {
        	$sql = "DELETE FROM postal WHERE idPostal = '".$_POST["idPostal"]."'";
        	$res = mysqli_query($conn, $sql);
        	//Cierraconexion
            $connect->disconnectDB($conn);
        header('location:../Administrador.php#Postales');
        }
?>
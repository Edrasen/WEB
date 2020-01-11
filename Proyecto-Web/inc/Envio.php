<?php
//Esta funcion cuenta los envios de un usuario especifico
function countEnvios($user)
{
    ////Conexion 
    include_once 'Tools.php';
    $connect = new Tools();
    $conn = $connect->connectDB();
    //query
    $sql = "SELECT count(*)AS numeroDeEnvios FROM envio where emailRemitente='$user'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res)) {
        $row = $res->fetch_assoc();
        //Cierraconexion
        $connect->disconnectDB($conn);
        return $row["numeroDeEnvios"];
    } else {
        //Cierraconexion
        $connect->disconnectDB($conn);
    }
}
//Esta funcion trae los envios de un usuario especifico
function enviosDeUsuario($user,$busqueda, $limit)
{
    ////Conexion 
    include_once 'Tools.php';
    $connect = new Tools();
    $conn = $connect->connectDB();
    //query
    $sql = "SELECT * FROM envio env, usuario us where us.email=env.emailDestinatario and env.emailRemitente='$user' and (emailDestinatario LIKE '%$busqueda%' or mensaje LIKE '%$busqueda%' or fechaEnv Like '%$busqueda%' ) LIMIT $limit;";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res)) {
        // output data of each row
        while ($row = $res->fetch_assoc()) {
            ?>
                <li class="collection-item avatar">
                    <img src="<?php echo $row["profile_Img"]?>" alt="foto perfil" class="circle">
                    <span class="title">Para:</span>
                    <p><?php echo "".$row["nombre"]." ".$row["primerAp"]." ".$row["segundoAp"]?><br>
                       <?php echo $row["emailDestinatario"] ?>
                    </p>
                    <a class="secondary-content"><span class="ultra-small cyan-text">Fecha de entrega: <?php echo $row["fechaEnv"] ?></span></a>
                </li>
            <?php
        }
        //Cierraconexion
        $connect->disconnectDB($conn);
    } else {
        echo" <li class=\"collection-item avatar\"> <blockquote class=\"cyanB\">
            No has enviado postales
        </blockquote>
        </li>";
        //Cierraconexion
        $connect->disconnectDB($conn);
    }
}
///LISTA EN EL PERFIL//
function enviosRecibidos($user)
{
    ////Conexion 
    include_once 'Tools.php';
    $connect = new Tools();
    $conn = $connect->connectDB();
    //query
    $sql = "SELECT emailRemitente,profile_Img,nombre,primerAp,segundoAp,segundoAp,idEnvio,fechaEnv FROM envio env, usuario us where us.email=env.emailRemitente and env.emailDestinatario='$user';";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res)) {
        // output data of each row
        while ($row = $res->fetch_assoc()) {
            echo "
                <li class=\"collection-item avatar\">
                    <img src=".$row["profile_Img"]." alt=\"foto perfil\" class=\"circle\">
                    <span class=\"title\">De:</span>
                <blockquote class=\"orangeB\">
                    <p>".$row["nombre"]." ".$row["primerAp"]." ".$row["segundoAp"]." <br>
                       ".$row["emailRemitente"]."
                    </p>
                </blockquote>
                    <form action='postal.php' method='POST' id=".md5($row["idEnvio"])."><input type='hidden' name='idEnvio' id='idEnvio' value=".$row["idEnvio"].">
                    <a class='secondary-content '><input type='submit' class=\"btn orange\" value='Ver postal'><br><span class='ultra-small orange-text'>Fecha de entrega:".$row["fechaEnv"]."</span></form></a>
                </li>
            ";
        }
        //Cierraconexion
        $connect->disconnectDB($conn);
    } else {
        echo" <li class=\"collection-item avatar\"> 
        <blockquote class=\"orangeB\">
            No tienes postales recibidas
        </blockquote>
        </li>";
        //Cierraconexionecho "
        $connect->disconnectDB($conn);
    }
}
//COMPROBACION EVITAR QUE OTROS USARIOS VEAN LA POSTALA
function envio($user,$id){
    ////Conexion 
    include_once 'Tools.php';
    $connect = new Tools();
    $conn = $connect->connectDB();
    //query

    $sql = "SELECT * FROM envio env, usuario us,postal ps where us.email=env.emailRemitente and env.emailDestinatario='$user' and env.idenvio='$id';";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res)) {
        // output data of each row
        $row = $res->fetch_assoc();
        //Cierraconexion
        $connect->disconnectDB($conn);
        return $row;
    } else {
        //Cierraconexion
        echo "No tienes envios";
        $connect->disconnectDB($conn);
        return NULL;
    }
}

function postal($id){
        ////Conexion 
        include_once 'Tools.php';
        $connect = new Tools();
        $conn = $connect->connectDB();
        //query
    
        $sql2 = "SELECT * FROM envio WHERE idEnvio = '$id'";
        $res2 = mysqli_query($conn, $sql2);
        mysqli_num_rows($res2);
        $row2 = $res2->fetch_assoc();
        $idPostal = $row2["idPostal"];
    
        $sql3 = "SELECT * FROM postal WHERE idPostal = '$idPostal'";
        $res3 = mysqli_query($conn, $sql3);
        mysqli_num_rows($res3);
        $row3 = $res3->fetch_assoc();
        $dirPostal = $row3["dirPostal"];
        return $dirPostal;
}

function name($id){
    include_once 'Tools.php';
    $connect = new Tools();
    $conn = $connect->connectDB();

    $emailD = "SELECT * FROM envio WHERE idEnvio = '$id'";
    $resemD = mysqli_query($conn, $emailD);
    mysqli_num_rows($resemD);
    $rows = $resemD->fetch_assoc();
    $idDes = $rows["idDestinatario"];

    $nmD = "SELECT * FROM usuario WHERE idUser = '$idDes'";
    $resnmD = mysqli_query($conn, $nmD);
    mysqli_num_rows($resnmD);
    $rows2 = $resnmD->fetch_assoc();
    $nmDes = $rows2["nombre"] . " " .$rows2["primerAp"];    

    return $nmDes;
}




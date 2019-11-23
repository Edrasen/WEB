<?php
//FILTROS
function traeCategoriasFiltro($Filtros){
    ////Conexion 
    include_once 'Tools.php';
    $connect = new Tools();
    $conn = $connect->connectDB();
    //query
    $sql = "SELECT * FROM categoria;";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res)) {
        while ($row = $res->fetch_assoc()) {
            ?>
            <label>
                <input type="checkbox" id="<?php echo $row['nombreCat'] ?>" name="<?php echo $row['nombreCat'] ?>" <?php for ($i = 0; $i < count($Filtros); $i++) {
                                                                                                                                    if ($Filtros[$i] == $row['nombreCat']) {
                                                                                                                                        echo "checked";
                                                                                                                                    }
                                                                                                                                } ?>>
                <span><?php echo $row['nombreCat'] ?></span>
            </label>
            <br>
   <?php
            }
            //Cierraconexion
            $connect->disconnectDB($conn);
        } else {
            //Cierraconexion
            $connect->disconnectDB($conn);
        }
    }
    //Combo
    function cuentaPaginas($Filtros)
    {
        ////Conexion 
        include_once 'Tools.php';
        $connect = new Tools();
        $conn = $connect->connectDB();
        //query
        $sql = "SELECT count(*) as NumeroPostales FROM postal pst, categoria cat WHERE pst.idCat=cat.IdCategoria  " . $Filtros . ";";
        $res = mysqli_query($conn, $sql);
        if (mysqli_num_rows($res)) {
            $row = $res->fetch_assoc();
            return $row['NumeroPostales'];
            //Cierraconexion
            $connect->disconnectDB($conn);
        } else {
            return 0;
            //Cierraconexion
            $connect->disconnectDB($conn);
        }
    }
    function Paginacion($numpagina, $paginasTotal)
    {
        ?>
    <div class="col s12 center">
        <ul class="pagination">
            <li <?php if ($numpagina > 1) { ?> class="waves-effect" <?php } else { ?> class="disabled" <?php } ?>>
                <a <?php if ($numpagina > 1) {
                            echo "href=\"index?Pagina=" . ($numpagina - 1) . "\"";
                        } ?>>
                    <i class="material-icons">chevron_left</i>
                </a>
            </li>
            <?php
                for ($i = 1; $i <=  $paginasTotal; $i++) { ?>
                <li <?php if ($numpagina == $i) { ?> class="active" <?php } else { ?> class="waves-effect" <?php } ?>>
                    <a href="?Pagina=<?php echo $i ?>"><?php echo $i ?></a>
                    </a>
                </li>
            <?php } ?>
            <li <?php if ($numpagina < $paginasTotal) { ?> class="waves-effect" <?php } else { ?> class="disabled" <?php } ?>>
                <a <?php if ($numpagina < $paginasTotal) {
                            echo "href=\"?Pagina=" . ($numpagina + 1) . "\"";
                        } ?>>
                    <i class="material-icons">chevron_right</i>
                </a>
            </li>
        </ul>
    </div>
<?php
}

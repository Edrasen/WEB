<?php

function getListasRep(){
	$mysqli = getConn();
	$query = 'SELECT * FROM `categoria`';
	$result = $mysqli->query($query);
	$listas = '<option value = "0">Elige una opción</option>';
	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$listas .= "<option value = '$row[nombreCat]''>$ron[nombreCat]</option>";
	}
	return $listas;
}

?>
<?php
session_start();
include_once 'Tools.php';
    $connect = new Tools();
    $conn = $connect->connectDB();

$result = mysqli_query($conn, "SELECT * FROM categoria");

while($row = mysqli_fetch_array($result)){
	echo '<option value="'.$row['idcategoria'].'">'.$row['idcategoria'].'</option>';
}
?> 
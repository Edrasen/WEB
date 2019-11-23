<?php
    include_once 'Tools.php';
    $connect = new Tools();
    $conn = $connect->connectDB();
    $query=mysqli_query($conn,"SELECT idcategoria, nombreCat FROM categoria");
    
    if(isset($_POST['categorias']))
    {
        $categorias=$_POST['categorias'];
        echo $categorias;
    }
?>
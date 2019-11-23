<?php
//PREPARA LA SESSION
session_start();

$user = $_POST['usr'];
$contrasena = md5($_POST['psw0']);
include_once 'IniciarSesioFunc.php';
if(IniciarSesion($user,$contrasena) == '1'){
    echo json_encode(array('success' => 1));
}else{
    echo json_encode(array('success' => 0));
}
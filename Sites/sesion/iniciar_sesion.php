<?php session_start();
    if($_GET){
        $lista = preg_split('~,~', $_GET['user']);
        $_SESSION['id'] = $lista[0];
        $_SESSION['nombre'] = $lista[1];
        $_SESSION['rut'] = $lista[2];
        $_SESSION['edad'] = $lista[3];
        $_SESSION['sexo'] = $lista[4];
        $_SESSION['direccion'] = $lista[5];
        $_SESSION['comuna'] = $lista[6]; 
    }else{
        echo "Url has no user";
    }
header('Location:../index.php');
?>
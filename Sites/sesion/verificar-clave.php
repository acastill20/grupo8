<?php 
session_start();
if (isset($_SESSION['rut'])) {

    require("../config/conexion.php");

    if (isset($_POST['op']) && isset($_POST['np'])
        && isset($_POST['c_np'])) {

        $op = $_POST['op'];
        $np = $_POST['np'];
        $c_np = $_POST['c_np'];
    
        if(empty($op)){
            header("Location: ../cambiar-clave.php?error=Rellena la casilla de contraseña actual");
            exit();
        }else if(empty($np)){
            header("Location: ../cambiar-clave.php?error=Rellena con tu contraseña nueva");
            exit();
        }else if($np !== $c_np){
            header("Location: ../cambiar-clave.php?error=Las claves nuevas no coinciden");
            exit();
        }else if(!is_numeric($np)){
            header("Location: ../cambiar-clave.php?error=La nueva clave debe ser numérica");
            exit(); 
        }else {
            $rut = $_SESSION['rut'];

            $query =   "SELECT contrasena
                        FROM usuarios WHERE 
                        rut='$rut' AND contrasena = '$op';";
            $result = $db2 -> prepare($query);
            $result -> execute();
            $contrasena = $result -> fetchAll();
        }
    
        if($contrasena){
        	
            $query2 = "UPDATE usuarios
                        SET contrasena='$np'
                        WHERE rut='$rut';";
            $result = $db2 -> prepare($query2);
            $result -> execute();
            $result -> fetchAll();

            header("Location: ../cambiar-clave.php?success=Tu contraseña ha sido cambiada");
            exit();

        }else {
         	header("Location: ../cambiar-clave.php?error=La clave que ingresaste no coincide con la tuya");
	        exit();
        }
    
    }else{
        header("Location: ../cambiar-clave.php");
        exit();
    }

}else{
    header("Location: ../index.php");
     exit();
}
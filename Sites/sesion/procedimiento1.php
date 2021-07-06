<?php
    session_start();
    require("../config/conexion.php");

    $query = "SELECT nombre, rut, edad, sexo, nombre_direccion, comuna, jefe FROM personal, personaladmin, Unidades, Direcciones WHERE personal.pid = personaladmin.pid AND personaladmin.uid = unidades.uid AND Unidades.direccion = Direcciones.direccion ORDER BY personal.pid;";
    $result = $db -> prepare($query);
    $result -> execute();
    $personaladmin = $result -> fetchAll();

    foreach ($personaladmin as $personal){
        $clave_random = rand(1000,9999);
        $query2 = "SELECT insertar_usuario('$personal[0]', '$personal[1]',$personal[2],'$personal[3]', '$personal[4]', '$personal[5]', $personal[6], $clave_random);";

        $result2 = $db2 -> prepare($query2);
        $result2 -> execute();
        $resultado = $result2 -> fetchAll();
    }
    $_SESSION['comienzo'] = 1;
    echo '<script>window.location="../index.php"</script>';
    exit();
?>
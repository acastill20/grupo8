<?php include('../templates/header.html'); ?>
<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");
  #Se obtiene el valor del input del usuario
  $rut = strtolower($_POST["rut"]);
  $contraseña = strtolower($_POST["contraseña"]);
  if(empty($rut) || empty($contraseña))
  {
    echo '<script>window.location="../inicio-sesion.php?error=Rellenar todas las casillas"</script>';
	  exit();
  }else{
  $query = "SELECT verificar_ingreso('$rut', $contraseña);";
  $result = $db2 -> prepare($query);
  $result -> execute();
  $resultado = $result -> fetchAll();
  foreach ($resultado as $r){
    $funca = $r[0];
  }
}
  if ($funca){
    $query2 = "SELECT * FROM usuarios WHERE usuarios.rut = '$rut';";
    $result2 = $db2 -> prepare($query2);
    $result2 -> execute();
    $usuario = $result2 -> fetchAll();

    foreach ($usuario as $u) {
      $lista = new ArrayObject(array($u[0],$u[1],$u[2],$u[3],$u[4]));
    }

    $query3 = "SELECT direcciones.direccion
    FROM usuarios, direcciones, direcciones_usuarios
    WHERE usuarios.rut = '$rut'
    AND direcciones_usuarios.id_usuario = usuarios.id
    AND direcciones_usuarios.id_direccion = direcciones.id";
    $result3 = $db2 -> prepare($query3);
    $result3 -> execute();
    $usuario2 = $result3 -> fetchAll();
    foreach ($usuario2 as $u) {
      $lista->append($u[0]);
    }

    $query4 = "SELECT comunas.nombre_comuna
    FROM usuarios, direcciones, direcciones_usuarios, comunas
    WHERE usuarios.rut = '$rut'
    AND direcciones_usuarios.id_usuario = usuarios.id
    AND direcciones_usuarios.id_direccion = direcciones.id
    AND direcciones.id_comuna = comunas.id";
    $result4 = $db2 -> prepare($query4);
    $result4 -> execute();
    $usuario3 = $result4 -> fetchAll();
    foreach ($usuario3 as $u) {
      $lista -> append($u[0]);
    }
    echo '<script>window.location="iniciar_sesion.php?user='.$lista[0].','.$lista[1].','.$lista[2].','.$lista[3].','.$lista[4].','.$lista[5].','.$lista[6].'"</script>';
  } else {
      echo '<script>window.location="../inicio-sesion.php?error=El rut y/o contraseña es/son incorrectas"</script>';
  }
?>
</body>
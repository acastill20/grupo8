<?php include('../templates/header.html'); ?>
<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");
  #Se obtiene el valor del input del usuario
  $nombre = strtolower($_POST["nombre"]);
  $rut = strtolower($_POST["rut"]);
  $edad = intval($_POST["edad"]);
  $sexo = strtolower($_POST["sexo"]);
  $direccion = strtolower($_POST["direccion"]);
  $comuna = strtolower($_POST["comuna"]);
  $clave = intval($_POST["contrasena"]);
  $jefe = 0;
  if(empty($nombre) || empty($rut) || empty($sexo) || empty($direccion) || empty($comuna))
  {
    echo '<script>window.location="../registro.php?error=Rellenar todas las casillas"</script>';
	  exit();
  }elseif(empty($clave)){
    echo '<script>window.location="../registro.php?error=Rellenar todas las casillas y/o revisa que tu clave sea numérica"</script>';
    exit();
}
elseif(empty($edad)){
  echo '<script>window.location="../registro.php?error=Rellenar todas las casillas y/o revisa que tu edad sea válida"</script>';
  exit();
}
  else{

    $query2 = "SELECT insertar_es_jefe();";
    $result2 = $db2 -> prepare($query2);
    $result2 -> execute();
    $resultado2 = $result2 -> fetchAll();

    $query = "SELECT insertar_usuario('$nombre', '$rut', $edad, '$sexo', '$direccion', '$comuna', $jefe, $clave);";

    #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
    $result = $db2 -> prepare($query);
    $result -> execute();
    $resultado = $result -> fetchAll();
    foreach ($resultado as $r){
      $funca = $r[0];
    }

    if ($funca){
        echo '<script>window.location="../registro.php?success=Se ha registrado el usuario exitosamente"</script>';
      } else {
        echo '<script>window.location="../registro.php?error=Revisar que todos los datos estén bien ingresados y que tu clave sea numérica"</script>';
      }
  }
?>
</body>
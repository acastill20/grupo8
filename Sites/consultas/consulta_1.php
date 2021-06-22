<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se construye la consulta como un string
    $query = "SELECT Unidades.uid, Direcciones.nombre_direccion, Direcciones.comuna FROM Direcciones, Unidades WHERE Unidades.direccion = Direcciones.direccion ORDER BY Unidades.uid;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$direcciones = $result -> fetchAll();
  ?>

  <table>
    <tr>
      <th>Direcciones</th>
    </tr>

    <tr><td>Unidad</td><td>Dirección</td><td>Comuna</td></tr>
  
      <?php
        // echo $direcciones;
        foreach ($direcciones as $d) {
          echo "<tr><td>$d[0]</td><td>$d[1]</td><td>$d[2]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>

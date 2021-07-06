<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $comuna = strtolower($_POST["comuna"]);


  #Se construye la consulta como un string
 	$query = "SELECT DISTINCT Vehiculos.vid, VehiculosPatente.patente
     FROM UnidadesCobertura, Unidades, Vehiculos, VehiculosPatente
     WHERE UnidadesCobertura.comuna LIKE '%$comuna%' AND UnidadesCobertura.uid = Unidades.uid AND Unidades.uid = Vehiculos.uid AND Vehiculos.vid = VehiculosPatente.vid
     ORDER BY Vehiculos.vid;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$vehiculos = $result -> fetchAll();
  ?>

  <table>
    <tr>
      <th>Vehiculos</th>
    </tr>
    <tr><td>Id</td><td>Patente</td></tr>
  
      <?php
        // echo $vehiculos;
        foreach ($vehiculos as $v) {
          echo "<tr><td>$v[0]</td><td>$v[1]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>

<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $comuna = strtolower($_POST["comuna"]);
  $ano = strtolower($_POST["año"]);

  #Se construye la consulta como un string
    $query = "SELECT Despachos.did, VehiculosPatente.patente
    FROM Despachos, Vehiculos, Direcciones, VehiculosPatente
    WHERE Direcciones.comuna LIKE '%$comuna%' AND EXTRACT(YEAR FROM Despachos.fecha) = '$ano' AND Despachos.vid = Vehiculos.vid AND Direcciones.direccion = Despachos.destino
    AND Vehiculos.vid = VehiculosPatente.vid ORDER BY Despachos.did;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$vehiculos = $result -> fetchAll();
  ?>

  <table>
    <tr>
      <th>Vehiculos</th>
    </tr>

    <tr><td>Despacho</td><td>Patente</td></tr>
  
      <?php
        // echo $direcciones;
        foreach ($vehiculos as $v) {
          echo "<tr><td>$v[0]</td><td>$v[1]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>

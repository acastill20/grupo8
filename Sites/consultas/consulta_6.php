<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $vehiculo = strtolower($_POST["vehiculo"]);

  #Se construye la consulta como un string
    $query = "SELECT DISTINCT Unidades.uid
    FROM Vehiculos, VehiculosLicencia, Unidades, (SELECT Uni.uid AS id, COUNT(*) AS cty
                                                  FROM VehiculosLicencia AS VehL, Unidades AS Uni, Vehiculos AS Veh
                                                  WHERE VehL.licencia LIKE '%$vehiculo%' AND Veh.uid = Uni.uid AND Veh.vid = VehL.vid
                                                  GROUP BY Uni.uid) AS Cuenta
    WHERE VehiculosLicencia.licencia LIKE '%$vehiculo%' AND  Cuenta.cty IN (SELECT MAX(cty2)
                                                                      FROM (SELECT COUNT(*) AS cty2
                                                                      FROM VehiculosLicencia AS VehL2, Unidades AS Uni2, Vehiculos AS Veh2
                                                                      WHERE VehL2.licencia LIKE '%$vehiculo%' AND Veh2.uid = Uni2.uid AND Veh2.vid = VehL2.vid
                                                                      GROUP BY Uni2.uid) AS Uwu)
    AND Vehiculos.uid = Unidades.uid
    AND Cuenta.id = Unidades.uid
    AND VehiculosLicencia.vid = Vehiculos.vid";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$despachos = $result -> fetchAll();
  ?>

  <table>
    <tr>
      <th>Unidad</th>
    </tr>

    <tr><td>Unidad</td></tr>
  
      <?php
        // echo $direcciones;
        foreach ($despachos as $d) {
          echo "<tr><td>$d[0]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>
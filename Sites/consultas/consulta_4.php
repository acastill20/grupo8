<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $licencia = strtolower($_POST["licencia"]);
  $desde = strtolower($_POST["Desde"]);
  $hasta = strtolower($_POST["Hasta"]);

  #Se construye la consulta como un string
    $query = "SELECT Despachos.did, Personal.nombre
    FROM Despachos, Personal, PersonalRepartidor, Vehiculos, VehiculosLicencia
    WHERE VehiculosLicencia.licencia LIKE '%$licencia%' AND Personal.edad BETWEEN $desde AND $hasta AND Despachos.vid = Vehiculos.vid AND Despachos.pid = PersonalRepartidor.pid AND Personal.pid = PersonalRepartidor.pid AND PersonalRepartidor.vid = Vehiculos.vid AND Vehiculos.vid = VehiculosLicencia.vid";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$despachos = $result -> fetchAll();
  ?>

  <table>
    <tr>
      <th>Despachos</th>
    </tr>

    <tr><td>Despacho</td><td>Personal</td></tr>
  
      <?php
        // echo $direcciones;
        foreach ($despachos as $d) {
          echo "<tr><td>$d[0]</td><td>$d[1]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>
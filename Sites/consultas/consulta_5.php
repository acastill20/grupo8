<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $comuna1 = strtolower($_POST["comuna1"]);
  $comuna2 = strtolower($_POST["comuna2"]);

  #Se construye la consulta como un string
    $query = "SELECT Unidades.uid, Personal.nombre
    FROM PersonalAdmin, Personal, Unidades, (SELECT com2.uid AS cuid2, com2.comuna AS comcomuna2
                                  FROM UnidadesCobertura AS com2
                                  WHERE com2.comuna LIKE '%$comuna2%') AS Cta2, (SELECT com.uid AS cuid, com.comuna AS comcomuna
                                                                                FROM UnidadesCobertura AS com
                                                                                WHERE com.comuna LIKE '%$comuna1%'
                                                                                ) AS Cta1
    WHERE Cta1.cuid = Cta2.cuid2 AND Unidades.uid = Cta1.cuid AND PersonalAdmin.jefe = 1 AND Personal.pid = PersonalAdmin.pid AND PersonalAdmin.uid = Unidades.uid";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$despachos = $result -> fetchAll();
  ?>

  <table>
    <tr>
      <th>Jefes</th>
    </tr>

    <tr><td>Unidades</td><td>Jefes</td></tr>
  
      <?php
        // echo $direcciones;
        foreach ($despachos as $d) {
          echo "<tr><td>$d[0]</td><td>$d[1]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>
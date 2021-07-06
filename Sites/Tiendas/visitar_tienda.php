<?php require('../config/conexion.php');

$tienda_id = $_POST["tienda_elegida"];

$query = "
SELECT tiendas.nombre, direcciones.direccion, comunas.nombre_comuna
FROM tiendas, direcciones, comunas
WHERE tiendas.id_direccion = direcciones.id
AND direcciones.id_comuna = comunas.id
AND tiendas.id = $tienda_id
";
$resultado = $db2 -> prepare($query);
$resultado -> execute();
$data = $resultado -> fetchAll();
$d = $data[0];
?>


<div align='center'>
    <h1> Tienda </h1>
</div>

<div>
    <?php
        echo "<br><br>
        <table align='center' cellspacing='5em'>
            <thead>
                <tr>
                    <th><h2> Tienda </h2></th>
                    <th><h2> Direccion </h2></th>
                    <th><h2> Comuna </h2></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>$d[0]</td>
                    <td>$d[1]</td>
                    <td>$d[2]</td>
                </tr>
            </tbody>
        </table>
        ";
    ?>
</div>
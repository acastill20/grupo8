<?php
session_start();
require('../config/conexion.php');
include('../templates/header.html');
include('../templates/navbar.php');

$query = "SELECT tiendas.nombre, tiendas.id FROM tiendas;";
$resultado = $db2 -> prepare($query);
$resultado -> execute();
$data = $resultado -> fetchAll();

?>

<html style="background-color: #6495ed">
<br>
<br>
<div style="width: 70%; padding-top: 2%; padding-bottom: 2%; background-color: white; margin-left: 15%; margin-right: 15%">
<div align='center'>
    <h1 class='is-size-1'> Nuestras tiendas ! </h1>
</div>
</div>

<div>
    <?php
        echo "<br><br>
        <table class='table' align='center' cellspacing='5em'>
            <thead>
                <tr class='is-selected'>
                    <th><h2><strong> ID </strong></h2></th>
                    <th><h2><strong> Tienda </strong></h2></th>";
        if(!isset($_SESSION['rut'])) {
            echo "<article class='message is-danger'>
            <div class='message-body'>
              Debes iniciar sesión para visitar las tiendas.
            </div>
          </article>";
        } else {
            echo "<th><h2><strong> Despacho a<br />tu comuna </strong></h2></th>
            <th><h2><strong> Visitar </strong></h2></th>";
        }
        echo "</tr>";

        foreach ($data as $d) {
            echo "
                <tr>
                    <td> $d[1]</td>
                    <td>" ?> <?php echo ucwords($d[0]) ?> </td>
            <?php ;
            if (isset($_SESSION['rut'])) {
                $uid = $_SESSION['id'];
                $query1 = "SELECT direcciones.id
                FROM direcciones, comunas, despacha_a
                WHERE direcciones.id_comuna = comunas.id
                AND comunas.id = despacha_a.id_comuna
                AND despacha_a.id_tienda = $d[1]

                INTERSECT

                SELECT direcciones.id
                FROM direcciones, direcciones_usuarios
                WHERE direcciones.id = direcciones_usuarios.id_direccion
                AND direcciones_usuarios.id_usuario = $uid";
                $resultado1 = $db2 -> prepare($query1);
                $resultado1 -> execute();
                $data1 = $resultado1 -> fetchAll();
                $despacha_a = '';
                if (is_null($data1[0])){
                    $despacha_a = 'No';
                } else{
                    $despacha_a ='Sí';
                }

                echo "
                <td> $despacha_a </td>
                <td>
                <form action='visitar_tienda.php' method='post' align='center'>
                    <input type='hidden' value=$d[1] class='button is-info' name='tienda_elegida'>
                    <input type='submit' value='Visitar' class='button is-info is-small is-rounded'>
                </form>
                </td>
                ";
            }
            echo "</tr>";
        }
        echo "
            </thead>
            <tbody>
            ";
    ?>
</div>


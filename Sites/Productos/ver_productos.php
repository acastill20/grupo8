<?php
session_start();
require('../config/conexion.php');
include('../templates/header.html');
include('../templates/navbar.php');

$query = "SELECT id, nombre FROM productos;";
$resultado = $db2 -> prepare($query);
$resultado -> execute();
$data = $resultado -> fetchAll();
?>

<html style="background-color: #6495ed">
<br>
<br>
<div style="width: 70%; padding-top: 2%; padding-bottom: 2%; background-color: white; margin-left: 15%; margin-right: 15%">
<div align='center'>
    <h1 class='is-size-1'> Nuestros productos ! </h1>
</div>
</div>
<div>
    <?php
        echo "<br><br>
        <table class='table' align='center' cellspacing='5em'>
            <thead>
                <tr class='is-selected'>
                    <th><h2><strong> ID </strong></h2></th>
                    <th><h2><strong> Producto </strong></h2></th>";
        if (isset($_SESSION['rut'])) {
            echo "<th><h2> Detalles </h2></th>";
        }
        echo "</tr>";
        foreach ($data as $d) { ?>
                <tr>
                    <td> <?php echo $d[0] ?></td>
                    <td> <?php echo ucfirst($d[1]) ?></td>
            <?php if (isset($_SESSION['rut'])) {
                echo "
                <td>
                    <div>
                        <form action='detalles_productos.php' method='post' align='center'>
                            <input type='hidden' value=$d[0] class='boton' name='producto_elegido'>
                            <input type='submit' value='Ver' class='button is-info is-small is-rounded'>
                        </form>
                    </div>
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
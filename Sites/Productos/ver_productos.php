<?php
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
<div align='center'>
    <h1 class='is-size-1'> Ver todos los productos </h1>
</div>

<div>
    <?php
        echo "<br><br>
        <table class='table' align='center' cellspacing='5em'>
            <thead>
                <tr>
                    <th><h2><strong> ID </strong></h2></th>
                    <th><h2><strong> Producto </strong></h2></th>";
        if (True) {
            echo "<th><h2> Detalles </h2></th>";
        }
        echo "</tr>";
        foreach ($data as $d) {
            echo "
                <tr>
                    <td> $d[0]</td>
                    <td> $d[1]</td>
            ";
            if (true) {
                echo "
                <td>
                    <div>
                        <form action='detalles_productos.php' method='post' align='center'>
                            <input type='hidden' value=$d[0] class='boton' name='producto_elegido'>
                            <input type='submit' value='Ver' class='boton'>
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
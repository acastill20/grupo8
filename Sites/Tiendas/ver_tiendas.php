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
<div align='center'>
    <h1> Ver todas las tiendas </h1>
</div>

<div>
    <?php
        echo "<br><br>
        <table align='center' cellspacing='5em'>
            <thead>
                <tr>
                    <th><h2> Tienda </h2></th>";
        if (True) {
            echo "<th><h2> Visitar </h2></th>";
        }
        echo "</tr>";
        foreach ($data as $d) {
            echo "
                <tr>
                    <td> $d[0] $d[1]</td>
            ";
            if (true) {
                echo "
                <td>
                <form action='visitar_tienda.php' method='post' align='center'>
                    <input type='hidden' value=$d[1] class='boton' name='tienda_elegida'>
                    <input type='submit' value='Visitar' class='boton'>
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
<?php require('../config/conexion.php');
include('../templates/header.html');
include('../templates/navbar.php');

# revisar cómo se guarda id producto en post
$id_producto = $_POST["id_producto"];

$query1 = "
SELECT productos.id, productos.nombre, productos.precio, productos,descripcion, productos.categoria
FROM productos
WHERE productos.id = $id_producto";

$resultado1 = $db2 -> prepare($query1);
$resultado1 -> execute();
$data1 = $resultado1 -> fetchAll();
$d1 = $data1[0];
?>


<div align='center'>
    <h1> Producto </h1>
</div>

<div>
    <?php
        echo "<br><br>
        <table align='center' cellspacing='5em'>
            <thead>
                <tr>
                    <th><h2> ID </h2></th>
                    <th><h2> Nombre </h2></th>
                    <th><h2> Precio </h2></th>
                    <th><h2> Descripción </h2></th>
                    <th><h2> Categoría </h2></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>$d1[0]</td>
                    <td>$d1[1]</td>
                    <td>$d1[2]</td>
                    <td>$d1[3]</td>
                    <td>$d1[4]</td>
                </tr>
            </tbody>
        </table>
        ";
    ?>
</div>


<?php
if($d1[4]=='comestible'){
    $query21 = "
    SELECT productos_comestibles.fecha_expiracion, productos_comestibles.subcategoria
    FROM productos_comestibles
    WHERE productos_comestibles.id = $id_producto";
    $resultado21 = $db2 -> prepare($query21);
    $resultado21 -> execute();
    $data21 = $resultado21 -> fetchAll();
    $d21 = $data21[0];
    if($d21[1]=='congelado'){
        $query211 = "
        SELECT productos_congelados.peso
        FROM productos_congelados
        WHERE productos_congelados.id = $id_producto";
        $resultado211 = $db2 -> prepare($query211);
        $resultado211 -> execute();
        $data211 = $resultado211 -> fetchAll();
        $d211 = $data211[0];
    }
    elseif ($d21[1]=='conserva'){
        $query212 = "
        SELECT productos_conservas.metodo_conserva
        FROM productos_conservas
        WHERE productos_conservas.id = $id_producto";
        $resultado212 = $db2 -> prepare($query212);
        $resultado212 -> execute();
        $data212 = $resultado212 -> fetchAll();
        $d212 = $data212[0];
    }
    elseif ($d21[1]=='fresco'){
        $query213 = "
        SELECT productos_frescos.duracion_sin_refrigerar
        FROM productos_frescos
        WHERE productos_frescos.id = $id_producto";
        $resultado213 = $db2 -> prepare($query213);
        $resultado213 -> execute();
        $data213 = $resultado213 -> fetchAll();
        $d213 = $data213[0];
    }
}

elseif ($d1[4]=='no comestible'){
    $query22 = "
    SELECT productos_no_comestibles.ancho, productos_no_comestibles.largo, productos_no_comestibles.alto, productos_no_comestibles.peso
    FROM productos_no_comestibles
    WHERE productos_no_comestibles.id = $id_producto";
    $resultado22 = $db2 -> prepare($query22);
    $resultado22 -> execute();
    $data22 = $resultado22 -> fetchAll();
    $d22 = $data22[0];
}


?>
<?php
session_start();
require('../config/conexion.php');
include('../templates/header.html');
include('../templates/navbar.php');

# revisar cómo se guarda id producto en post
$id_producto = $_POST['producto_elegido'];

$query1 = "
SELECT *
FROM productos
WHERE productos.id = $id_producto
;";

$resultado1 = $db2 -> prepare($query);
$resultado1 -> execute();
$data1 = $resultado1 -> fetchAll();
$producto1 = $data1[0];

$prod_nombre = $producto1[1];
$prod_precio = $producto1[2];
$prod_descripcion = $producto1[3];
$prod_categoria = $producto[4];

if ($prod_categoria == 'comestible') {
    $query2 = "
    SELECT productos_comestibles.fecha_expiracion, productos_comestibles.subcategoria
    FROM productos, productos_comestibles
    WHERE productos.id = productos_comestibles.id
    AND productos.id = $id_producto
    ;";

    $resultado2 = $db2 -> prepare($query2);
    $resultado2 -> execute();
    $data2 = $resultado2 -> fetchAll();
    $producto2 = $data2[0];

    $prod_fecha_expiracion = $producto2[0];
    $prod_sub_categoria = $producto2[1];

    if ($prod_sub_categoria == 'fresco') {
        $query3 = "
        SELECT productos_frescos.duracion_dias
        FROM productos, productos_comestibles, productos_frescos
        WHERE productos.id = productos_comestibles.id
        AND productos.id = productos_frescos.id
        AND productos.id = $id_producto
        ;";
        $resultado3 = $db2 -> prepare($query3);
        $resultado3 -> execute();
        $data3 = $resultado3 -> fetchAll();
        $producto3 = $data3[0];

        $prod_duracion_dias = $producto3[0];

    } elseif ($prod_sub_categoria == 'congelado') {
        $query3 = "
        SELECT productos_congelados.peso
        FROM productos, productos_comestibles, productos_congelados
        WHERE productos.id = productos_comestibles.id
        AND productos.id = productos_congelados.id
        AND productos.id = $id_producto
        ;";
        $resultado3 = $db2 -> prepare($query3);
        $resultado3 -> execute();
        $data3 = $resultado3 -> fetchAll();
        $producto3 = $data3[0];

        $prod_peso = $producto3[0];

    } elseif ($prod_sub_categoria == 'conserva') {
        $query3 = "
        SELECT *
        FROM productos, productos_comestibles, productos_conservas
        WHERE productos.id = productos_comestibles.id
        AND productos.id = productos_conservas.id
        AND productos.id = $id_producto
        ;";
        $resultado3 = $db2 -> prepare($query3);
        $resultado3 -> execute();
        $data3 = $resultado3 -> fetchAll();
        $producto3 = $data3[0];

        $prod_metodo = $producto3[0];
    }
} elseif ($prod_categoria == 'no comestible') {
    $query2 = "
    SELECT productos_no_comestibles.ancho, productos_no_comestibles.largo, productos_no_comestibles.alto, productos_no_comestibles.peso
    FROM productos, productos_no_comestibles
    WHERE productos.id = productos_no_comestibles.id
    AND productos.id = $id_producto
    ;";
    $resultado2 = $db2 -> prepare($query2);
    $resultado2 -> execute();
    $data2 = $resultado2 -> fetchAll();
    $producto2 = $data2[0];

    $prod_ancho = $producto2[0];
    $prod_largo = $producto2[1];
    $prod_alto = $producto2[2];
    $prod_peso = $producto2[3];
}
?>

<div class="column" style="width: 30%; margin-right: 30px">
    <div class="card">
        <div class="card-content">
            <div class="content">
                <h2><strong>AAAAAA<?php // echo ucwords($prod_nombre) ?></strong></h2>
                <p><strong>Nombre:</strong> <?php echo ucwords($_SESSION['nombre'])?></p>
                <p><strong>Rut:</strong> <?php echo $_SESSION['rut'] ?></p>
                <p><strong>Edad:</strong> <?php echo $_SESSION['edad'] ?></p>
                <p><strong>Dirección:</strong> <?php echo ucwords($_SESSION['direccion']) ?>, <?php echo ucwords($_SESSION['comuna']) ?></p>
            </div>
        </div>
    </div>
</div>

<div>


    <?php
        // echo "<br><br>
        // <table align='center' cellspacing='5em'>
        //     <thead>
        //         <tr>
        //             <th><h2> ID </h2></th>
        //             <th><h2> Nombre </h2></th>
        //             <th><h2> Precio </h2></th>
        //             <th><h2> Descripción </h2></th>
        //             <th><h2> Categoría </h2></th>
        //         </tr>
        //     </thead>
        //     <tbody>
        //         <tr>
        //             <td>$d1[0]</td>
        //             <td>$d1[1]</td>
        //             <td>$d1[2]</td>
        //             <td>$d1[3]</td>
        //             <td>$d1[4]</td>
        //         </tr>
        //     </tbody>
        // </table>
        // ";
    ?>
</div>


<?php
// if($d1[4]=='comestible'){
//     $query21 = "
//     SELECT productos_comestibles.fecha_expiracion, productos_comestibles.subcategoria
//     FROM productos_comestibles
//     WHERE productos_comestibles.id = $id_producto";
//     $resultado21 = $db2 -> prepare($query21);
//     $resultado21 -> execute();
//     $data21 = $resultado21 -> fetchAll();
//     $d21 = $data21[0];
//     if($d21[1]=='congelado'){
//         $query211 = "
//         SELECT productos_congelados.peso
//         FROM productos_congelados
//         WHERE productos_congelados.id = $id_producto";
//         $resultado211 = $db2 -> prepare($query211);
//         $resultado211 -> execute();
//         $data211 = $resultado211 -> fetchAll();
//         $d211 = $data211[0];
//     }
//     elseif ($d21[1]=='conserva'){
//         $query212 = "
//         SELECT productos_conservas.metodo_conserva
//         FROM productos_conservas
//         WHERE productos_conservas.id = $id_producto";
//         $resultado212 = $db2 -> prepare($query212);
//         $resultado212 -> execute();
//         $data212 = $resultado212 -> fetchAll();
//         $d212 = $data212[0];
//     }
//     elseif ($d21[1]=='fresco'){
//         $query213 = "
//         SELECT productos_frescos.duracion_sin_refrigerar
//         FROM productos_frescos
//         WHERE productos_frescos.id = $id_producto";
//         $resultado213 = $db2 -> prepare($query213);
//         $resultado213 -> execute();
//         $data213 = $resultado213 -> fetchAll();
//         $d213 = $data213[0];
//     }
// }

// elseif ($d1[4]=='no comestible'){
//     $query22 = "
//     SELECT productos_no_comestibles.ancho, productos_no_comestibles.largo, productos_no_comestibles.alto, productos_no_comestibles.peso
//     FROM productos_no_comestibles
//     WHERE productos_no_comestibles.id = $id_producto";
//     $resultado22 = $db2 -> prepare($query22);
//     $resultado22 -> execute();
//     $data22 = $resultado22 -> fetchAll();
//     $d22 = $data22[0];
// }


?>
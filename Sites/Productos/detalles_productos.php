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

$resultado1 = $db2 -> prepare($query1);
$resultado1 -> execute();
$data1 = $resultado1 -> fetchAll();
$producto1 = $data1[0];

$prod_nombre = $producto1[1];
$prod_precio = $producto1[2];
$prod_descripcion = $producto1[3];
$prod_categoria = $producto1[4];

settype($prod_nombre, "STRING");
settype($prod_precio, "STRING");
settype($prod_descripcion, "STRING");
settype($prod_categoria, "STRING");

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

    settype($prod_fecha_expiracion, "STRING");
    settype($prod_sub_categoria, "STRING");

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
        settype($prod_duracion_dias, "STRING");

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
        settype($prod_peso, "STRING");

    } elseif ($prod_sub_categoria == 'conserva') {
        $query3 = "
        SELECT productos_conservas.metodo_conserva
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
        settype($prod_metodo, "STRING");
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

    settype($prod_ancho, "STRING");
    settype($prod_largo, "STRING");
    settype($prod_alto, "STRING");
    settype($prod_peso, "STRING");
}
?>

<div class='column' style='width: 30%; margin-right: 30px'>
    <div class='card'>
        <div class='card-content'>
            <div class='content'>
                <h2><strong><?php echo ucwords($prod_nombre) ?></strong></h2>
                <p><strong>Precio: </strong><?php echo "$ $prod_precio" ?></p>
                <p><strong>Descripcion: </strong><?php echo ucfirst($prod_descripcion) ?></p>
                <p><strong>Categoria: </strong><?php echo ucwords($prod_categoria) ?></p>
                <?php
                if ($prod_categoria == 'comestible') { ?>
                    <p><strong>Sub-Categoria: </strong><?php echo ucwords($prod_sub_categoria) ?></p>
                    <p><strong>Fecha de expiracion: </strong><?php echo $prod_fecha_expiracion ?></p>
                    <?php
                    if ($prod_sub_categoria == 'fresco') { ?>
                        <p><strong>Duracion del producto: </strong><?php echo $prod_duracion_dias ?> Dias</p><?php
    
                    } elseif ($prod_sub_categoria == 'congelado') { ?>
                        <p><strong>Peso: </strong><?php echo ucwords($prod_peso) ?> Kg</p><?php

                    } elseif ($prod_sub_categoria == 'conserva') { ?>
                        <p><strong>Metodo de conserva: </strong><?php echo ucwords($prod_metodo) ?></p><?php
                    } 
                } elseif ($prod_categoria == 'no comestible') { ?> 
                    <p><strong>Ancho: </strong><?php echo ucwords($prod_ancho) ?> cm</p>
                    <p><strong>Largo: </strong><?php echo ucwords($prod_largo) ?> cm</p>
                    <p><strong>Alto: </strong><?php echo ucwords($prod_alto) ?> cm</p>
                    <p><strong>Peso: </strong><?php echo ucwords($prod_peso) ?> cm</p><?php 
                } ?> 
            </div>
        </div>
    </div>
</div>

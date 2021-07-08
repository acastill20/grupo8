<?php
session_start();
include('../templates/header.html');
include('../templates/navbar.php');
require('../config/conexion.php');

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
<html style="background-color: #6495ed">


<div align='center'>
    <div class='column' style='width: 30%'>
        <div class='card'>
            <div class='card-content'>
                <div class='content'>
                    <h2><strong><?php echo ucwords($d[0]) ?></strong></h2>
                    <p><strong>Direccion: </strong><?php echo ucwords($d[1]) ?></p>
                    <p><strong>Comuna: </strong><?php echo ucwords($d[2]) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div align='center'> 
<a class="button cta is-primary is-rounded primary-btn raised" href="ver_tiendas.php">
    Volver a la lista de tiendas
</a>
</div>
<br>

<div align='center'>
    <table class="table is-fullwidth">
    <thead>
    <tr>
        <th>
            <!-- PUNTO 1 PÁGINA DE COMPRAS -->
            <div align='center'>
                <p class="title is-4"> ¿Cuáles son los productos más baratos de esta tienda? </p>
                <h2>
                Pulsa el botón para ver los 3 productos<br />más baratos por <em>categoría</em>
                </h2>
                <br>

                <form action='' method='post'>
                    <?php echo "<input type='hidden' value=$tienda_id class='boton' name='tienda_elegida'>" ?>
                    <input type='submit' name='submit_C1' value='Consultar' class="button is-link">
                </form>
            </div>
            <div>
                <?php
                    if (! empty($_POST['submit_C1'])){
                        $query11 = "SELECT productos.id, productos.nombre, productos.precio 
                        FROM productos, vende
                        WHERE vende.id_tienda = $tienda_id
                        AND productos.id = vende.id_producto
                        AND productos.categoria = 'comestible'
                        ORDER BY productos.precio ASC
                        LIMIT 3
                        ;";
                        $result11 = $db2 -> prepare($query11);
                        $result11 -> execute();
                        $data11 = $result11 -> fetchAll();

                        $query12 = "SELECT productos.id, productos.nombre, productos.precio 
                        FROM productos, vende
                        WHERE vende.id_tienda = $tienda_id
                        AND productos.id = vende.id_producto
                        AND productos.categoria = 'no comestible'
                        ORDER BY productos.precio ASC
                        LIMIT 3
                        ;";

                        $result12 = $db2 -> prepare($query12);
                        $result12 -> execute();
                        $data12 = $result12 -> fetchAll();
                        echo "
                        <table align='center' cellspacing='10em'>
                            <thead>
                                <tr>
                                    <th>
                        
                        <br><br>
                            <table class='table is-striped is-hoverable' align='center' cellspacing='10em'>
                                <thead>
                                    <tr class='is-selected'>
                                        <th><h2> ID </h2></th>
                                        <th><h2> Comestibles </h2></th>
                                        <th><h2> Precio </h2></th>
                                        <th><h2> Ver detalles </h2></th>
                                    </tr>
                                </thead>
                                <tbody>
                        ";
                        foreach ($data11 as $d1) {
                            settype($d1[2], "STRING"); ?>

                            <tr>
                                <td><?php echo ucfirst($d1[0]) ?></td>
                                <td><?php echo ucfirst($d1[1]) ?></td>
                                <td>$<?php echo ucfirst($d1[2]) ?></td>
                                <td>
                                    <div>
                                        <form action='detalles_productos.php' method='post' align='center'>
                                            <input type='hidden' value=<?php echo $d1[0] ?> class='boton' name='producto_elegido'>
                                            <input type='submit' value='Ver' class='button is-info is-small'>
                                        </form>
                                    </div>
                                </td>
                            </tr>                        
                            <?php ;
                            }
                            echo '
                                </tbody>
                            </table>
                            ';
                            
                            '</th>
                            <th>';
                            // COLUMNA (TABLA) NO COMESTIBLES ?>
                            <br>
                            <br>
                            <table class="table is-striped is-hoverable" align=\'center\' cellspacing=\'10em\'>
                                <thead>
                                    <tr class='is-selected'>
                                    <th><h2> ID </h2></th>
                                    <th><h2> No Comestibles </h2></th>
                                    <th><h2> Precio </h2></th>
                                    <th><h2> Ver detalles </h2></th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php foreach ($data12 as $d2) {
                                settype($d2[2], "STRING"); ?>
                                <tr>
                                    <td><?php echo ucfirst($d2[0]) ?></td>
                                    <td><?php echo ucfirst($d2[1]) ?></td>
                                    <td>$<?php echo ucfirst($d2[2]) ?></td>
                                    <td>
                                        <div>
                                            <form action='detalles_productos.php' method='post' align='center'>
                                                <input type='hidden' value=<?php echo $d2[0] ?> class='boton' name='producto_elegido'>
                                                <input type='submit' value='Ver' class='button is-info is-small'>
                                            </form>
                                        </div>
                                    </td>
                                </tr> 
                            <?php }
                            echo '
                                </tbody>
                            </table>
                            ';
                            echo '
                            </th>
                          </tr>
                        </thead>
                        </table>
                        ';
                    }
                ?>  
            </div>
        </th>
        <th>
            <!-- PUNTO 2 PÁGINA DE COMPRAS -->
            <div align='center'>
                <p class="title is-4"> ¿Qué productos vende esta tienda? </p>
                <h2 style="margin-bottom: 2%">
                Ingresa un <em>nombre</em> para ver<br />los productos con dicho nombre 
                </h2>
                <form action='' method='post'>
                    <input type='text' name='texto_ingresado' placeholder='Ingresa un nombre' class="input is-small">
                    <br>
                    <br>
                    <?php echo "<input type='hidden' value=$tienda_id class='boton' name='tienda_elegida'>" ?>
                    <input type='submit' name='submit_C2' value='Consultar' class="button is-link">
                </form>
            </div>
            <div>
                <?php
                    if (! empty($_POST['submit_C2'])){
                        $nombre_producto_ingresado = strtolower($_POST['texto_ingresado']);
                        $query21 = "SELECT productos.nombre, productos.categoria, productos.descripcion, productos.id
                        FROM productos, vende
                        WHERE vende.id_tienda = $tienda_id
                        AND productos.id = vende.id_producto
                        AND productos.nombre LIKE '%$nombre_producto_ingresado%'
                        ;";
                        $result21 = $db2 -> prepare($query21);
                        $result21 -> execute();
                        $data21 = $result21 -> fetchAll();
                        echo "<br><br>
                        <table class='table is-striped is-hoverable' align='center' cellspacing='10em'>
                            <thead>
                                <tr class='is-selected'>
                                    <th><h2> ID </h2></th>
                                    <th><h2> Nombre </h2></th>
                                    <th><h2> Categoría </h2></th>
                                    <th><h2> Descripción </h2></th>
                                    <th><h2> Ver detalles </h2></th>
                                </tr>
                            </thead>
                            <tbody>
                            ";
                        foreach ($data21 as $d) { ?>
                            <tr>
                                <td><?php echo $d[3] ?></td>
                                <td><?php echo ucfirst($d[0]) ?></td>
                                <td><?php echo ucwords($d[1]) ?></td>
                                <td><?php echo ucfirst($d[2]) ?></td>
                                <td>
                                    <div>
                                        <form action='../Productos/detalles_productos.php' method='post' align='center'>
                                            <input type='hidden' value=<?php echo $d[3] ?> class='boton' name='producto_elegido'>
                                            <input type='submit' value='Ver' class='button is-info is-small is-rounded'>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php }
                        echo '
                            </tbody>
                        </table>
                        ';
                    }
                ?>  
            </div>
        </th>
        <th>
            <!-- PUNTO 3 PÁGINA DE COMPRAS -->
            <div align='center'>
                <p class="title is-4"> ¿Qué quieres comprar en esta tienda? </p>
                <h2>
                    Escoge el <em>ID</em> del producto que te gustaría comprar
                </h2>
                <?php
                echo "<form action='' method='post'>";

                    $query31 = "SELECT productos.id FROM productos ORDER BY productos.id;";
                    $result31 = $db2 -> prepare($query31);
                    $result31 -> execute();
                    $data31 = $result31 -> fetchAll();
                    echo "<br>ID Producto<br>";
                    echo "<div class='select'>";
                    echo "<select name = 'id_producto'>";
                    foreach ($data31 as $row){
                        echo $row[0];
                        echo "<option value='$row[0]'>$row[0]</option>"; 
                    }
                    echo "</select>";
                    echo "</div>";
                    echo "<br>";
                    echo "<br>Cantidad <br>";
                    echo "<input type='number' class='boton' name='cantidad' min='1' max='50' value='1'>";
                    echo "<input type='hidden' value=$tienda_id class='boton' name='tienda_elegida'>";
                    echo "<br>";
                    echo "<br>";
                    echo "<input type='submit' value='Comprar producto' name='submit_C3' class='button is-link'>";
                
                echo "</form>";
                ?>
            </div>
            <div>
                <?php
                    if (! empty($_POST['submit_C3'])){

                        $prid = $_POST['id_producto'];
                        $tid = $tienda_id;
                        $uid = $_SESSION['id'];
                        $cantidad = $_POST['cantidad'];

                        settype($prid, "INTEGER");
                        settype($tid, "INTEGER");
                        settype($uid, "INTEGER");
                        settype($cantidad, "INTEGER");

                        $query32 = "SELECT generar_compra($prid, $tid, $uid, $cantidad);";
                        $result32 = $db2 -> prepare($query32);
                        $result32 -> execute();
                        $data32 = $result32 -> fetchAll();
                        $opcion = $data32[0][0];

                        // INFO PARA BOLETA
                        $query33 = "SELECT MAX(id)
                        FROM compras;";
                        $result33 = $db2 -> prepare($query33);
                        $result33 -> execute();
                        $data33 = $result33 -> fetchAll();
                        $coid = $data33[0][0];

                        $query34 = "SELECT productos.precio, productos.nombre
                        FROM productos
                        WHERE productos.id = $prid
                        ;";
                        $result34 = $db2 -> prepare($query34);
                        $result34 -> execute();
                        $data34 = $result34 -> fetchAll();
                        $precio_unitario = $data34[0][0];
                        $nombre_producto = $data34[0][1];

                        settype($cantidad, "INTEGER");
                        settype($precio_unitario, "INTEGER");

                        $precio = $cantidad * $precio_unitario;


                        $query35 = "SELECT direcciones.id
                            FROM direcciones, comunas, despacha_a
                            WHERE direcciones.id_comuna = comunas.id
                            AND comunas.id = despacha_a.id_comuna
                            AND despacha_a.id_tienda = $tid
                    
                            INTERSECT
                    
                            SELECT direcciones.id
                            FROM direcciones, direcciones_usuarios
                            WHERE direcciones.id = direcciones_usuarios.id_direccion
                            AND direcciones_usuarios.id_usuario = $uid
                            LIMIT 1";
                        $result35 = $db2 -> prepare($query35);
                        $result35 -> execute();
                        $data35 = $result35 -> fetchAll();
                        $did = $data35[0][0];


                        $query36 = "SELECT direcciones.direccion
                        FROM direcciones
                        WHERE direcciones.id = $did
                        ;";
                        $result36 = $db2 -> prepare($query36);
                        $result36 -> execute();
                        $data36 = $result36 -> fetchAll();
                        $nombre_direccion = $data36[0][0];

                        if($opcion==1){
                            echo "
                            <br />
                            <br />
                            <article class='message is-dark'>
                            <div class='message-body'>
                            La tienda no vende este producto.<br />Intenta con otro ID.
                            </div>
                            </article>";
                        }
                       
                        elseif ($opcion==2){
                            echo "
                            <br />
                            <br />
                            <article class='message is-dark'>
                            <div class='message-body'>
                            La tienda no despacha a ninguna de las comunas de tus direcciones.
                            </div>
                            </article>";
                        }
                        
                        elseif ($opcion==3){ ?>
                            <br />
                            <br />
                            <article class='message is-primary'>
                            <div class='message-header'>
                                <p>Boleta electrónica</p>
                            </div>
                            <div class='message-body'>
                            ¡Se ha realizado con éxito tu compra de <?php echo $nombre_producto?>!<br />Compra #<?php echo $coid ?>
                            <br />Precio unidad: $<?php echo $precio_unitario?><br />Cantidad: <?php echo $cantidad?>
                            <br />Precio total: $<?php echo $precio?><br />Envío con dirección a <?php echo ucwords($nombre_direccion) ?>
                            </div>
                            </article>
                        <?php }
                    }
                ?>  
            </div>
        </th>
    </tr>
    </thead>
    </table>
</div>
    
</html>
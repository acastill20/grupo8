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
<br>
<br>
<br>

<div align='center'>
    <table class="table is-fullwidth">
    <thead>
    <tr>
        <th>
            <!-- PUNTO 1 PÁGINA DE COMPRAS -->
            <div align='center'>
                <p> ¿Cuáles son los productos más baratos de esta tienda? </p>
                <h2>
                Pulsa el botón para ver los 3 productos<br />más baratos por <em>categoría</em>
                </h2>

                <form action='' method='post'>
                    <?php echo "<input type='hidden' value=$tienda_id class='boton' name='tienda_elegida'>" ?>
                    <input type='submit' name='submit_C1' value='Consultar' class='boton'>
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
                        echo '<table align=\'center\' cellspacing=\'10em\'>
                        <thead>
                          <tr>
                            <th>';
                            // COLUMNA (TABLA) COMESTIBLES
                            echo '<br><br>
                            <table class="table is-striped is-hoverable" align=\'center\' cellspacing=\'10em\'>
                                <thead>
                                    <tr>
                                        <th><h2> Comestible </h2></th>
                                        <th><h2> Precio </h2></th>
                                    </tr>
                                </thead>
                                <tbody>
                                ';
                            foreach ($data11 as $d1) {
                                settype($d1[2], "STRING");
                                // <td><a href=\'../Productos/detalles_productos.php?producto_elegido=$d1[0]\' title='detalles_productos'> $d1[1] </a></td>
                                echo "
                                    <tr>
                                        <td><a href=\'Productos/detalles_productos.php\' title='detalles_productos'> $d1[1] </a></td>
                                        <td> $d1[2] </td>
                                    </tr>                        
                                ";
                            }
                            echo '
                                </tbody>
                            </table>
                            ';
                            
                            '</th>
                            <th>';
                            // COLUMNA (TABLA) NO COMESTIBLES
                            echo '<br><br>
                            <table class="table is-striped is-hoverable" align=\'center\' cellspacing=\'10em\'>
                                <thead>
                                    <tr>
                                        <th><h2> No comestible </h2></th>
                                        <th><h2> Precio </h2></th>
                                    </tr>
                                </thead>
                                <tbody>
                                ';
                            foreach ($data12 as $d2) {
                                settype($d2[2], "STRING");
                                echo "
                                    <tr>
                                        <td><a href=\'../Productos/detalles_productos.php?producto_elegido=$d2[0]\' title='detalles_productos'> $d2[1] </a></td>
                                        <td> $d2[2] </td>
                                    </tr>                        
                                ";
                            }
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
                <p> ¿Qué productos vende esta tienda? </p>
                <h2>
                Ingresa un <em>nombre</em> para ver<br />los productos con dicho nombre 
                </h2>
                <form action='' method='post'>
                    <input type='text' name='texto_ingresado' placeholder='Ingresa un nombre'>
                    <br>
                    <br>
                    <?php echo "<input type='hidden' value=$tienda_id class='boton' name='tienda_elegida'>" ?>
                    <input type='submit' name='submit_C2' value='Consultar' class='boton'>
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
                                <tr>
                                    <th><h2> Nombre </h2></th>
                                    <th><h2> Categoría </h2></th>
                                    <th><h2> Descripción </h2></th>
                                </tr>
                            </thead>
                            <tbody>
                            ";
                        foreach ($data21 as $d) {
                            echo "
                                <tr>
                                    <td><a href=\'../Productos/detalles_productos.php?producto_elegido=$d[3]\' title='detalles_productos'> $d[0] </a></td>
                                    <td> $d[1] </td>
                                    <td> $d[2] </td>
                                </tr>                        
                            ";
                        }
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
                <p> ¿Qué quieres comprar en esta tienda? </p>
                <h2>
                    Escoge el <em>ID</em> del producto que te gustaría comprar
                </h2>
                <?php
                echo "<form action='' method='post'>";

                    $query31 = "SELECT productos.id FROM productos ORDER BY productos.id;";
                    $result31 = $db2 -> prepare($query31);
                    $result31 -> execute();
                    $data31 = $result31 -> fetchAll();
                    echo "<br>ID producto<br>";
                    echo "<select name = 'id_producto'>";
                    foreach ($data31 as $row){
                        echo $row[0];
                        echo "<option value='$row[0]'>$row[0]</option>"; 
                    }
                    echo "</select>";
                    echo "<input type='hidden' value=$tienda_id class='boton' name='tienda_elegida'>";

                    echo "<input type='submit' value='Buscar producto' name='submit_C3'>";
                
                echo "</form>";
                ?>
            </div>
            <div>
                <?php
                    if (! empty($_POST['submit_C3'])){

                        $prid = $_POST['id_producto'];
                        $tid = $tienda_id;
                        $uid = $_SESSION['id'];

                        settype($prid, "INTEGER");
                        settype($tid, "INTEGER");
                        settype($uid, "INTEGER");

                        // echo $prid;
                        // echo $tid;
                        // echo $uid;

                        $query32 = "SELECT generar_compra($prid, $tid, $uid);";
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

                        $query34 = "SELECT productos.precio
                        FROM productos
                        WHERE productos.id = $prid
                        ;";
                        $result34 = $db2 -> prepare($query34);
                        $result34 -> execute();
                        $data34 = $result34 -> fetchAll();
                        $precio = $data34[0][0];


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

                        if($opcion==0){
                            echo "
                            <br />
                            <br />
                            <article class='message is-dark'>
                            <div class='message-body'>
                            La tienda no vende este producto.<br />Intenta con otro ID.
                            </div>
                            </article>";
                        }
                       
                        elseif ($opcion==1){
                            echo "
                            <br />
                            <br />
                            <article class='message is-dark'>
                            <div class='message-body'>
                            La tienda no despacha a ninguna de las comunas de tus direcciones.
                            </div>
                            </article>";
                        }
                        
                        elseif ($opcion==2){
                            echo"
                            <br />
                            <br />
                            <article class='message is-primary'>
                            <div class='message-header'>
                                <p>Boleta electrónica</p>
                            </div>
                            <div class='message-body'>
                            ¡Se ha realizado con éxito tu compra!<br />Compra #$coid<br />Precio: $$precio<br />Envío con dirección a $nombre_direccion
                            </div>
                            </article>";
                        }
                    }
                ?>  
            </div>
        </th>
    </tr>
    </thead>
    </table>
</div>
    
</html>
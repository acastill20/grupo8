<?php
session_start();
include('../templates/header.html');
include('navbar.php');
require('../config/conexion.php');
?>
<html style="background-color: #6495ed">

<div align='center'>
    <table>
    <thead>
    <tr>
        <th>
            <!-- PUNTO 1 PÁGINA DE COMPRAS -->
            <div align='center'>
                <p> ¿Cuáles son los productos más baratos de {nombre tienda}? </p>
                <h2>
                Pulsa el botón para ver los 3 productos más baratos por <em>categoría</em>
                </h2>

                <form action='' method='post'>
                    <input type='submit' name='submit_C1' value='Consultar' class='boton'>
                </form>
            </div>
            <div>
                <?php
                    if (! empty($_POST['submit_C1'])){
                        // CAMBIAR ID TIENDA
                        $query11 = "SELECT productos.id, productos.nombre, productos.precio 
                        FROM productos, vende
                        WHERE 5 = vende.id_tienda
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
                        WHERE 5 = vende.id_tienda
                        AND productos.id = vende.id_producto
                        AND productos.categoria = 'no comestible'
                        ORDER BY productos.precio ASC
                        LIMIT 3
                        ;";

                        $result12 = $db2 -> prepare($query12);
                        $result12 -> execute();
                        $data12 = $result12 -> fetchAll();
                        // echo '<table align=\'center\' cellspacing=\'10em\'>
                        // <thead>
                        //   <tr>
                        //     <th>consulta 1</th>
                        //     <th>consulta 2</th>
                        //   </tr>
                        // </thead>
                        // </table>'
                        echo '<br><br>
                        <table align=\'center\' cellspacing=\'10em\'>
                            <thead>
                                <tr>
                                    <th><h2> Comestible </h2></th>
                                </tr>
                            </thead>
                            <tbody>
                            ';
                        foreach ($data11 as $d1) {
                            echo "
                                <tr>
                                    <td> $d1[1] </td>
                                </tr>                        
                            ";
                        }
                        echo '
                            </tbody>
                        </table>
                        ';

                        echo '<br><br>
                        <table align=\'center\' cellspacing=\'10em\'>
                            <thead>
                                <tr>
                                    <th><h2> No comestible </h2></th>
                                </tr>
                            </thead>
                            <tbody>
                            ';
                        foreach ($data12 as $d2) {
                            echo "
                                <tr>
                                    <td> $d2[1] </td>
                                </tr>                        
                            ";
                        }
                        echo '
                            </tbody>
                        </table>
                        ';

                        // echo '<br><br>
                        // <table align=\'center\' cellspacing=\'10em\'>
                        //     <thead>
                        //         <tr>
                        //             <th><h2> Comestible </h2></th>
                        //             <th><h2> No comestible </h2></th>
                        //         </tr>
                        //     </thead>
                        //     <tbody>
                        //     ';

                        // foreach ($data11 as $d1) {
                        //     foreach ($data12 as $d2) {
                        //         echo "
                        //             <tr>
                        //                 <td> $d1[1] </td>
                        //                 <td> $d2[1] </td>
                        //             </tr>                        
                        //         ";
                        //     }
                        // }

                        // $i = 0;
                        // while ($i < 3) {
                        //     echo "
                        //     <tr>
                        //         <td> $data11[$i][1] </td>
                        //         <td> $data12[$i][1] </td>
                        //     </tr>";
                        //     $i += 1;
                        // }

                        echo '
                            </tbody>
                        </table>
                        ';
                    }
                ?>  
            </div>
        </th>
        <th>
            <!-- PUNTO 2 PÁGINA DE COMPRAS -->
            <div align='center'>
                <p> ¿Qué productos vende {nombre tienda}? </p>
                <h2>
                Ingresa un <em>nombre</em> para ver los productos con dicho nombre 
                </h2>
                <form action='' method='post'>
                    <input type='text' name='texto_ingresado' placeholder='Ingresa un nombre'>
                    <br>
                    <br>
                    <input type='submit' name='submit_C2' value='Consultar' class='boton'>
                </form>
            </div>
            <div>
                <?php
                    if (! empty($_POST['submit_C2'])){
                        $nombre_producto_ingresado = strtolower($_POST['texto_ingresado']);
                        // CAMBIAR ID TIENDA
                        $query21 = "SELECT productos.nombre, productos.categoria, productos.descripcion
                        FROM productos, vende
                        WHERE 5 = vende.id_tienda
                        AND productos.id = vende.id_producto
                        AND productos.nombre LIKE '%$nombre_producto_ingresado%'
                        ;";
                        $result21 = $db2 -> prepare($query21);
                        $result21 -> execute();
                        $data21 = $result21 -> fetchAll();
                        echo '<br><br>
                        <table align=\'center\' cellspacing=\'10em\'>
                            <thead>
                                <tr>
                                    <th><h2> Nombre </h2></th>
                                    <th><h2> Categoría </h2></th>
                                    <th><h2> Descripción </h2></th>
                                </tr>
                            </thead>
                            <tbody>
                            ';
                        foreach ($data21 as $d) {
                            echo "
                                <tr>
                                    <td> $d[0] </td>
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
                <p> ¿Qué quieres comprar en {nombre tienda}? </p>
                <h2>
                    Escoge el <em>ID</em> del producto que te gustaría comprar
                </h2>
                <?php
                echo "<form action='' method='post'>";

                    $query31 = "SELECT productos.id FROM productos ORDER BY productos.id";
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

                    echo "<input type='submit' value='Buscar producto' name='submit_C3'>";
                
                echo "</form>";
                ?>
            </div>
            <div>
                <?php
                    if (! empty($_POST['submit_C3'])){

                        $id_producto = $_POST['id_producto'];
                        // echo $id_producto;
                        // CAMBIAR ID TIENDA
                        $uid = $_SESSION['id'];
                        // echo $uid;
                        $query32 = "SELECT generar_compra($id_producto, 5, $uid);";
                        $result32 = $db2 -> prepare($query32);
                        $result32 -> execute();
                        $data32 = $result32 -> fetchAll();
                        echo $data32;
                    }
                ?>  
            </div>
        </th>
    </tr>
    </thead>
    </table>
</div>
    
</html>

<?php include('../templates/footer.html');?>
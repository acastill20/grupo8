<?php include('../templates/header_consultas.html');?>
<?php require('../config/conexion.php');?>

    <div align='center'>
        <h2> Tiendas </h2>
        <p>
            ¡Escoge una tienda y comienza a <em>comprar</em>!
        </p>
        <?php
        echo "<form action='' method='post'>";

            $consulta = "SELECT tiendas.nombre, tiendas.id FROM tiendas ORDER BY tiendas.id";
            echo "<br>Seleccina una tienda:<br>";
            echo "<select name = 'tienda'>";
            # db o db2??¿¿
            foreach ($db->query($consulta) as $row){
                echo "<option value=$row[id]>$row[name]</option>"; 
            }
            echo "</select>";

            echo "<input type="submit" value="Buscar por tienda" name="submit_C0">";
        
        echo "</form>";
        ?>
    </div>
    <div>
        <?php
            if (! empty($_POST['submit_C0'])){

                $tienda = strtolower($_POST['tienda']);
                if () {
                    $consulta = 
                    ;
                } else {
                    $consulta =
                    ;
                }

                $resultado = $db -> prepare($consulta);
                $resultado -> execute();
                $data = $resultado -> fetchAll();

                echo '<br><br>
                <table align=\'center\' cellspacing=\'5em\'>
                    <thead>
                        <tr>
                            <th><h2> Tienda </h2></th>
                            <th><h2> Máxima venta </h2></th>
                        </tr>
                    </thead>
                    <tbody>
                    ';
                foreach ($data as $d) {
                    echo "
                        <tr>
                            <td> $d[0] </td>
                            <td> $d[1] </td>
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

<?php include('../templates/footer.html');?>
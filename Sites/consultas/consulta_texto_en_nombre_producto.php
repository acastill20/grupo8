<?php include('../templates/header_consultas.html');?>
<?php require('../config/conexion.php');?>

    <div align='center'>
        <h2> Consulta si la tienda que escogiste tiene el producto que quieres </h2>

        <?php
            $query = "SELECT tiendas.nombre, tiendas.id FROM tiendas ORDER BY tiendas.id;";
            $result = $db -> prepare($query);
            $result -> execute();
            $nombres_tiendas = $result -> fetchAll();
        ?>
        <form action='' method='post'>
            <input type='submit' name='submit_C2' value='Consultar' class='boton'>
        </form>
    </div>
    <div>
        <?php
            if (! empty($_POST['submit_C2'])){
                $consulta = 
            }
        ?>  
    </div>

<?php include('../templates/footer.html');?>
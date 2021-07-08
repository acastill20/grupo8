<?php 
session_start();
include('templates/header.html');
include('navbar.php');
require('config/conexion.php');
?>

<html style="background-color: #6495ed">
<?php if (!isset($_SESSION['rut'])){?>
    <article class="message is-danger">
    <div class="message-body">
      Debes iniciar sesión para visualizar tu perfil.
    </div>
  </article>
  <?php }else{?>
    <div class="columns" style="margin-top: 50px; margin-left: 50px">
    <div class="column is-one-third">
            <div class="card">
            <div class="card-image">
                <figure class="image is-4by4">
                <img src="https://www.uic.mx/posgrados/files/2018/05/default-user.png" alt="Placeholder image">
                </figure>
            </div>
            <div class="card-content">
                <div class="media">
                <div class="media-left">
                    <figure class="image is-48x48">
                    <img src="https://www.uic.mx/posgrados/files/2018/05/default-user.png" alt="Placeholder image">
                    </figure>
                </div>
                <div class="media-content">
                    <p class="title is-4"><?php echo ucwords($_SESSION['nombre'])  ?></p>
                    <p class="subtitle is-6"><?php echo $_SESSION['rut'] ?></p>
                </div>
                </div>
            </div>
            </div>
    </div>
    <div class="column" style="width: 30%; margin-right: 30px">
            <div class="card">
            <div class="card-content">
                <div class="content">
                    <h2><strong>Mi Perfil</strong></h2>
                    <p><strong>Nombre:</strong> <?php echo ucwords($_SESSION['nombre'])  ?></p>
                    <p><strong>Rut:</strong> <?php echo $_SESSION['rut'] ?></p>
                    <p><strong>Edad:</strong> <?php echo $_SESSION['edad'] ?></p>
                    <p><strong>Dirección:</strong> <?php echo ucwords($_SESSION['direccion']) ?>, <?php echo ucwords($_SESSION['comuna']) ?></p>
                </div>
            </div>
            </div>
            <div class="card" style="margin-top: 10px">
            <div class="card-content">
                <div class="content">
                    <?php
                    $rut = $_SESSION['rut'];
                    $query = "SELECT jefe FROM usuarios WHERE rut = '$rut';";
                    $result = $db2 -> prepare($query);
                    $result -> execute();
                    $es_jefe = $result -> fetchAll();

                    foreach ($es_jefe as $j) {
                        $jefe = $j[0];
                    }
                    if ($jefe == 0){
                        $id = $_SESSION['id'];
                        //mostrar historial de compras ordenadas por id de compra
                        $query2 = "SELECT compras.id, productos.nombre, producto_comprado.cantidad, productos.precio, tiendas.nombre, direcciones.direccion, comunas.nombre_comuna
                        FROM compras, productos, producto_comprado, tiendas, direcciones, comunas
                        WHERE producto_comprado.id_compra = compras.id
                        AND compras.id_usuario = $id
                        AND tiendas.id_direccion = direcciones.id
                        AND direcciones.id_comuna = comunas.id
                        AND compras.id_tienda = tiendas.id
                        AND producto_comprado.id_producto = productos.id
                        ORDER BY compras.id DESC";
                        $result2 = $db2 -> prepare($query2);
                        $result2 -> execute();
                        $datos = $result2 -> fetchAll();

                        ?> <h2><strong>Compras Realizadas</strong></h2>
                        <table class="table">
                            <thead>
                                <tr class="is-selected">
                                    <th>Id Compra</th>
                                    <th>Producto</abbr></th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Tienda</th>
                                    <th>Dirección de tienda</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th><abbr title="id_c">Id Compra</abbr></th>
                                    <th><abbr title="product">Producto</abbr></th>
                                    <th><abbr title="qty">Cantidad</abbr></th>
                                    <th><abbr title="price">Precio</abbr></th>
                                    <th><abbr title="store">Tienda</abbr></th>
                                    <th><abbr title="address">Dirección de tienda</abbr></th>
                                </tr>
                            </tfoot>
                            <tbody>
                                    <?php foreach ($datos as $a) { ?>
                                        <tr>
                                            <td> <?php echo $a[0] ?> </td>
                                            <td> <?php echo ucwords($a[1]) ?> </td>
                                            <td> <?php echo $a[2] ?> </td>
                                            <td> $<?php echo intval($a[2])*intval($a[3]) ?> </td>
                                            <td> <?php echo ucwords($a[4]) ?> </td>
                                            <td> <?php echo ucwords($a[5]) ?>, <?php echo ucwords($a[6]) ?> </td>
                                        </tr>
                                    <?php } ?>
                            </tbody>
                        </table>
                        <?php } else {
                        $query2 = "SELECT PersonalAdmin.uid FROM Personal, PersonalAdmin
                        WHERE Personal.rut = '$rut'
                        AND Personal.pid = PersonalAdmin.pid;";
                        $result2 = $db -> prepare($query2);
                        $result2 -> execute();
                        $unidad = $result2 -> fetchAll();

                        foreach ($unidad as $u) {
                            $uid = $u[0];
                        }

                        $query3 = "SELECT Personal.nombre, Personal.rut, Personal.sexo, Personal.edad, PersonalAdmin.clasificacion
                        FROM Personal, PersonalAdmin
                        WHERE PersonalAdmin.uid = $uid
                        AND PersonalAdmin.jefe = 0
                        AND PersonalAdmin.pid = Personal.pid;";
                        $result3 = $db -> prepare($query3);
                        $result3 -> execute();
                        $admin = $result3 -> fetchAll();

                        ?> <h2><strong>Administrativos de la unidad <?php echo $uid ?></strong></h2>
                        <table class="table">
                        <thead>
                            <tr class="is-selected">
                                <th>Nombre</th>
                                <th>Rut</abbr></th>
                                <th>Sexo</th>
                                <th>Edad</th>
                                <th>Clasificación</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th><abbr title="name">Nombre</abbr></th>
                                <th><abbr title="rut">Rut</abbr></th>
                                <th><abbr title="sex">Sexo</abbr></th>
                                <th><abbr title="age">Edad</abbr></th>
                                <th>Clasificación</th>
                            </tr>
                        </tfoot>
                        <tbody>
                                <?php foreach ($admin as $a) { ?>
                                    <tr>
                                        <td> <?php echo ucwords($a[0]); ?> </td>
                                        <td> <?php echo $a[1]; ?> </td>
                                        <td> <?php echo ucwords($a[2]) ?> </td>
                                        <td> <?php echo $a[3]; ?> </td>
                                        <td> <?php echo ucwords($a[4]) ?> </td>
                                    </tr>
                                <?php }
                        }
                        ?>
                        </tbody>
                        </table>
                </div>
            </div>
            </div>
    </div>
    </div>
    <?php } ?>
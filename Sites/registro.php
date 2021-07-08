<?php session_start();
include('templates/header.html');   ?>
<?php include('navbar.php');
require('config/conexion.php');
$query31 = "SELECT nombre_comuna FROM comunas";
$result31 = $db2 -> prepare($query31);
$result31 -> execute();
$data31 = $result31 -> fetchAll();
if (isset($_SESSION['rut'])){?>
  <article class="message is-danger">
  <div class="message-body">
    Debes salir de tu cuenta actual primero para registrarte.
  </div>
</article>
<?php }
?>
<html style="background-color: #6495ed">
<body>
  <form action="sesion/verificar-registro.php" style="background: #fff;border: 2px solid #ccc;border-radius: 15px; width: 500px; padding-top: 20px;padding-bottom: 20px; margin: auto; width: 30%; margin-top: 50px;margin-bottom: 50px;" method="post">
  <div class="content"><h2 style="width:70%;margin: auto; margin-left: 35%">Registrarse</h2></div>
    <?php if (isset($_GET['error'])) { ?>
      <article class="message is-danger">
        <div class="message-body">
          <?php echo $_GET['error']; ?>
        </div>
      </article>
    <?php } ?>
    <?php if (isset($_GET['success'])) { ?>
      <article class="message is-success">
        <div class="message-body">
          <?php echo $_GET['success']; ?>
        </div>
      </article>
    <?php } ?>
    <div style="width:70%;margin: auto">
    <div class="field" style="width: 300px">
      <label class="label">Nombre</label>
      <div class="control">
        <input class="input" type="text" name="nombre" placeholder="NO CALLER ID">
      </div>
    </div>
    <div class="field" style="width: 300px">
      <label class="label">Rut</label>
      <div class="control">
        <input class="input" type="text" name="rut" placeholder="1.111.111-1">
      </div>
    </div>
    <div class="field" style="width: 300px">
      <label class="label">Edad</label>
      <div class="control">
        <input class="input" type="text" name="edad" placeholder="84">
      </div>
    </div>
    <div class="field" style="width: 300px">
      <label class="label">Sexo</label>
      <div class="select">
      <select name="sexo">
        <option>Selecciona tu sexo</option>
        <option  value="hombre">Hombre</option>
        <option value="mujer">Mujer</option>
      </select>
      </div>
    </div>
    <div class="field" style="width: 300px">
      <label class="label">Dirección</label>
      <div class="control">
        <input class="input" type="text" name="direccion" placeholder="Calle Falsa 123">
      </div>
    </div>
    <div class="field" style="width: 300px">
      <label class="label">Comuna</label>
      <div class="select">
        <select name="comuna">
          <option>Selecciona tu comuna</option>
          <?php foreach ($data31 as $row){ ?>
            <option value='<?php echo $row[0] ?>'><?php echo ucwords($row[0]) ?></option> 
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="field" style="width: 300px">
      <label class="label">Contraseña</label>
      <div class="control">
        <input class="input" type="password" name="contrasena" placeholder="1232">
      </div>
    </div>
    <?php if (!isset($_SESSION['rut'])){?>
      <div class="control">
      <input type="submit" class="button is-success" value="Registrarme">
    </div>
    <?php } ?>
  </div>
  </form>
</body>
</html>
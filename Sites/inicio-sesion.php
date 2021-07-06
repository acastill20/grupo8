<? session_start();
include('templates/header.html');   ?>
<?php include('templates/navbar.php'); ?>
<html style="background-color: #6495ed">
<?php if (isset($_SESSION['rut'])){?>
  <article class="message is-danger">
  <div class="message-body">
    Debes salir de tu cuenta actual primero para iniciar sesión.
  </div>
</article>
<?php }
?>

<form action="sesion/verificar-inicio.php" style="background: #fff;border: 2px solid #ccc;border-radius: 15px; width: 500px; padding-top: 20px;padding-bottom: 20px; margin: auto; width: 30%; margin-top: 50px;margin-bottom: 50px;" method="post">
<div class="content"><h2 style="width:70%;margin: auto; margin-left: 30%">Iniciar sesión</h2></div>
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
  <label class="label">Rut</label>
  <div class="control">
    <input class="input" type="text" name="rut" placeholder="1.111.111-1">
  </div>
</div>
<div class="field" style="width: 300px">
  <label class="label">Contraseña</label>
  <div class="control">
    <input class="input" type="text" name="contraseña" placeholder="1234">
  </div>
</div>
<?php if (!isset($_SESSION['rut'])){?>
      <div class="control">
      <input type="submit" class="button is-success" value="Iniciar Sesión">
      </div>
    <?php } ?>
</div>
</form>
</html>
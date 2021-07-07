<?php 
session_start();
include('templates/header.html');
include('navbar.php');

if (isset($_SESSION['rut']) || (isset($_GET['error']))) {

 ?>
<!DOCTYPE html>
<html style="background-color: #6495ed">
<head>
	<title>Cambiar Clave</title>
</head>
<body>
    <form action="sesion/verificar-clave.php" style="background: #fff;border: 2px solid #ccc;border-radius: 15px; width: 500px; padding-top: 20px;padding-bottom: 20px; margin: auto; width: 30%; margin-top: 50px;margin-bottom: 50px;" method="post">
	<div class="content"><h2 style="width:70%;margin: auto; margin-left: 20%">Cambiar contraseña</h2></div>
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
			<label class="label">Contraseña actual</label>
			<div class="control">
				<input class="input" type="text" name="op" placeholder="Contraseña actual">
			</div>
		</div>
		<div class="field" style="width: 300px">
			<label class="label">Nueva contraseña</label>
			<div class="control">
				<input class="input" type="text" name="np" placeholder="Nueva contraseña">
			</div>
		</div>
		<div class="field" style="width: 300px">
			<label class="label">Confirmar nueva contraseña</label>
			<div class="control">
				<input class="input" type="text" name="c_np" placeholder="Confirmar nueva contraseña">
			</div>
		</div>
		<?php if (isset($_SESSION['rut'])){ ?> 
		<div class="control">
			<input type="submit" class="button is-success" value="Enviar">
		</div>
		<?php } ?>
     </form>
</body>
</html>

<?php 
}else{
    echo '<script>window.location="cambiar-clave.php?error=Debes ingresar a tu cuenta antes de cambiar tu clave"</script>';
	exit();
}
 ?>
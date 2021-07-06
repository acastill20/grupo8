<?php 
session_start();
include('templates/header.html');
include('templates/navbar.php');

if (isset($_SESSION['rut'])) {
    session_destroy();
    echo '<script>window.location="index.php"</script>';
    exit();
}else{
    ?><div class="notification is-danger is-light">
        <a class="delete" href="index.php"></a>
        No hay ninguna sesión en curso actualmente.
    </div>
<?php }
 ?>
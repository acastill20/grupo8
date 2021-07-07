<?php session_start();?>
<?php
if ($_SESSION['comienzo'] == null){
    echo '<script>window.location="sesion/procedimiento1.php"</script>';
    exit();
} ?>

<?php include('navbar.php');   ?>
<?php include('templates/header.html');   ?>
<html style="background-color: #6495ed">
<?php
if($_SESSION['rut'] == null || $_SESSION['rut'] == '') {?>
    <div class="notification is-danger" style="width: 50%; margin: auto; margin-top: 10px; margin-bottom: 10px">
        No tienes autorización para entrar. Ingresa sesión para ver el contenido.
    </div>
<?php } ?>
<body>
<audio loop autoplay src="templates/vaca.mp3" id="myaudio">
</audio>
<script>
  var audio = document.getElementById("myaudio");
  audio.volume = 0.1;
</script>

<section class="hero is-fullheight is-default is-bold">

    <div class="hero-body">
        <div class="container">
            <div class="columns is-vcentered">
                <div class="column is-5 is-offset-1 landing-caption">
                    <h1 class="title is-1 is-bold is-spaced">
                        Bienvenide !
                    </h1>
                    <h2 class="subtitle is-5 is-muted"> Comienza a realizar tus compras en <strong>DCCowShop</strong> </h2>
                    <div class="button-wrap">
                        <a class="button cta is-rounded primary-btn raised" href="registro.php">
                            Registrate
                        </a>
                        <a class="button cta is-rounded" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">
                            Un regalo de parte del equipo
                        </a>
                    </div>
                </div>
                <div class="column is-5">
                    <figure class="image is-4by3">
                        <img src="templates/vaca.gif" alt="Description">
                    </figure>
                </div>

            </div>
        </div>
    </div>

</section>
</body>
</html>
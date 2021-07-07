<body>
<!-- pondría ../ en templates y todos los .php al mismo nivel de index (iniciar_sesion,...) -->
<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="index.php">
      <img src="templates/vaca.png" width="50" height="70">
    </a>

    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item" href="Tiendas/ver_tiendas.php">
        Comprar
      </a>

      <a class="navbar-item" href="Productos/ver_productos.php">
        Productos
      </a>

  </div>

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
              <a class="button is-light" href="perfil-usuario.php">
                  Mi Perfil
              </a>
              <a class="button is-light" href="cambiar-clave.php">
                  Cambiar contraseña
              </a>
              <a class="button is-primary" href="registro.php">
                <strong>Registrarse</strong>
              </a>
              <a class="button is-primary" href="inicio-sesion.php">
                <strong>Iniciar Sesión</strong>
              </a>
              <a class="button is-info" href="cerrar-sesion.php">
                  Cerrar Sesión
              </a>
        </div>
      </div>
    </div>

  </div>
</nav>
</body>
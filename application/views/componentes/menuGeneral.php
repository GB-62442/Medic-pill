<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-default bg-default fixed-top">
    <div class="container">
      <a class="navbar-brand text-light" href="#">AWI4.0</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">

          <?php/* endif */?>

          <li class="nav-item dropdown ">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Mi cuenta</a>
            <div class="dropdown-menu" aria-labelledby="dropdownPerfil">
              <a class="nav-link" href="<?php echo base_url(); ?>index.php/usuarioExterno/perfil">Perfil</a>
              <a class="nav-link" href="<?php echo base_url(); ?>index.php/usuarioExterno/estadisticas">Mis estadísticas</a>
              <a class="nav-link" onclick="signOutfirebase()" href="javascript: void(0);">Finalizar sesión</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Main content -->

  <div class="main-content" id="panel">

    <!-- Header -->
    <!-- Header -->
<script type="text/javascript">




function signOutfirebase(){

firebase.auth().signOut().then(() => {
   notyf.success('Cerrando sesión...');

  window.location.href = "<?php echo base_url(); ?>index.php/";
}).catch((error) => {
  window.location.href = "<?php echo base_url(); ?>index.php/";
});
}

</script>















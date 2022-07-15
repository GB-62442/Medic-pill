<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Page Content -->
<div class="container">

  <!-- Page Heading -->
  <h1 class="my-4"><?php echo $titulo; ?></h1> 

  <div class='row'>
    <div class='col-lg-4 mb-4'></div>
    <div class='col-lg-4 mb-4'>
      <small class='text-danger' id="error"></small>
    </div>
    <div class='col-lg4 mb-4'></div>
  </div>     

</div>
<!-- /.container -->

  
  <script type="text/javascript">

    firebase.auth().onAuthStateChanged(function(usuario) {
      if (usuario) {
        var nombre = usuario.displayName;
        var email = usuario.email;
        var emailVerificado = usuario.emailVerified;
        var urlFoto = usuario.photoURL;
        var uid = usuario.uid;
        var token = usuario.getIdToken();

      firebase.firestore().collection("medicos").doc(usuario.uid).get().then((documento) => {
        if(documento.exists){
          location.href="<?php echo base_url(); ?>index.php/usuarioExterno/generaSesionExterna?uid=" + uid + "&email=" + email + "&emailVerificado=" + emailVerificado + "&token=" + token + "&ty=" + 0;
        }else{
          location.href="<?php echo base_url(); ?>index.php/usuarioExterno/generaSesionExterna?uid=" + uid + "&email=" + email + "&emailVerificado=" + emailVerificado + "&token=" + token + "&ty=" + 1;
        }
      }).catch((error) => {console.log(error);});
      } else {
        document.getElementById("error").innerHTML = "El usuario no está logeado";
      }
    });

    
  </script>
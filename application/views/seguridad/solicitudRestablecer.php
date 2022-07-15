<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- El nucleo de Firebase JS SDK siempre es requerido y se debe llamar antes de cualquier script de Firebase -->
<script src="https://www.gstatic.com/firebasejs/8.2.10/firebase-app.js"></script>
<!-- Librería requeridas -->
<script src="https://www.gstatic.com/firebasejs/8.2.10/firebase-auth.js"></script>
<!-- Librarias y estilos para los botones -->
<script src="https://www.gstatic.com/firebasejs/ui/4.6.1/firebase-ui-auth.js"></script>
<link type="text/css" rel="stylesheet" href="https://www.gstatic.com/firebasejs/ui/4.6.1/firebase-ui-auth.css" />

<!-- Page Content -->
<div class="container">

  <!-- Page Heading -->

  <div class="header-body text-center mb-7">
    <div class="row justify-content-center">
      <div class="col-xl-5 col-lg-6 col-md-8 px-5">
        <h1 class="text-default my-4 pt-5 pb-5"><?php echo $titulo; ?></h1>
      </div>
    </div>
  </div>
</div>    
<!-- Page content -->
<div class="container mt--8 pb-5">
  <div class="row justify-content-center">
    <div class="col-lg-5 col-md-7">
      <div class="card bg-secondary border-0 mb-0">

        <div class="card-body px-lg-5 py-lg-5">
          <div>
            <p>Ingresa el correo eléctronico de inicio de sesión</p>
          </div>
          <form class="needs-validation" novalidate >

            <div class="form-group mb-3">
              <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                </div>
                <input type="email" class="form-control" placeholder="Correo eléctronico de usuario" name="usernameLogin" id="usernameLogin" maxlength="30" class="form-control">
              </div>
              <small class="text-danger" id="errorCorreo" style="display: none;">Escriba un correo valido</small>
            </div>
          </form>
            <div class="text-center">
        <button class="form-control btn btn-primary " value="<?php echo $titulo; ?>" onclick="solicitudfirebase()" id="btnfirebase" >Enviar correo </button>

            </div>
          
        </div>
      </div>

    </div>
  </div>

  <?php
  if($error!==FALSE){
    echo "
    <div class='row'>
    <div class='col-lg-4 mb-4'></div>
    <div class='col-lg-4 mb-4'>
    <small class='text-danger'>$error</small>
    </div>
    <div class='col-lg4 mb-4'></div>
    </div>
    <!-- /.row -->";
  }

  ?>

</div>
<!-- /.container -->

  <!-- Librería requeridas -->
  <script src="https://www.gstatic.com/firebasejs/8.2.10/firebase-auth.js"></script>
  <!-- Librarias y estilos para los botones -->
  <script src="https://www.gstatic.com/firebasejs/ui/4.6.1/firebase-ui-auth.js"></script>
  <link type="text/css" rel="stylesheet" href="https://www.gstatic.com/firebasejs/ui/4.6.1/firebase-ui-auth.css" />

  <script type="text/javascript">

    // Your web app's Firebase configuration
    var firebaseConfig = {
      apiKey: "AIzaSyAtVKah-WS0H3TTYOMEohT3jjEpbZ2PkM4",
      authDomain: "medicpill.firebaseapp.com",
      projectId: "medicpill",
      storageBucket: "medicpill.appspot.com",
      messagingSenderId: "444268109580",
      appId: "1:444268109580:web:600d2e18a84f8c39e93329"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    var au = firebase.auth();

 function solicitudfirebase(){
    correo = $("#usernameLogin").val();
    let regexEmail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    error = false;
    
    if(correo == "" || regexEmail.test(correo) != true){
      $("#errorCorreo").css("display","block");
      error = true;
      }
      else{
      $("#errorCorreo").css("display","none");
      if(!error)
      error = false;
    }


    if(error)
      return;

    if(error === false){

    au.sendPasswordResetEmail(correo).then(function() {
      enviaAlerta("","Se ha enviado un correo a la dirección de correo " + correo);
      }).catch(function(error) {
      // An error happened.
      });
    }

  }

  </script>
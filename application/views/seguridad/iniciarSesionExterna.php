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
        <div class="card-header bg-transparent pb-2">
          <div class="text-muted text-center mt-2"><small>Ingresa con tu cuenta </small></div>
          <div class="row" id="botonesAcceso"></div>

        </div>
        <div class="card-body px-lg-5 py-lg-5">
          <div class="text-center text-muted mb-4">
            <small>O con tus credenciales</small>
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
            <div class="form-group">
              <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                </div>
                <input class="form-control" placeholder="Contraseña" type="password" name="passwordLogin" id="passwordLogin" >
              </div>
              <small class="text-danger" id="errorPassword" style="display: none;">Escriba una contraseña</small>
            </div>
</form>
            <div class="text-center">
        <input type="submit" class="form-control btn btn-primary " value="<?php echo $titulo; ?>" id="btnfirebase" onclick="loginEmailPassfirebase()" >

            </div>
          
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-12">
          <a href='<?php echo base_url(); ?>index.php/usuarioExterno/restablecer' class="text-info"><small>¿Olvidaste tu contraseña?</small></a>
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

    // Initialize the FirebaseUI Widget using Firebase.
    var ui = new firebaseui.auth.AuthUI(firebase.auth());

    var uiConfig = {
                      callbacks: {
                        signInSuccessWithAuthResult: function(authResult, redirectUrl) {
                          // User successfully signed in.
                          // Return type determines whether we continue the redirect automatically
                          // or whether we leave that to developer to handle.
                          if(authResult != null){
                              
                              var usuario = authResult.user;
                              var uid = usuario.uid;

                              /*
                              var nombre = usuario.displayName;
                              var email = usuario.email;
                              var emailVerificado = usuario.emailVerified;
                              var urlFoto = usuario.photoURL;
                              
                              */

                              return true;
                          }
                          return false;
                        },
                        uiShown: function() {
                          // The widget is rendered.
                          // Hide the loader.
                          //document.getElementById('loader').style.display = 'none';
                        }
                      },
                      // Will use popup for IDP Providers sign-in flow instead of the default, redirect.
                      //signInFlow: 'popup',
                      signInSuccessUrl:'<?php echo base_url(); ?>index.php/usuarioExterno/validaUsuarioExterno',
                      signInOptions: [
                                        {
                                          provider: firebase.auth.GoogleAuthProvider.PROVIDER_ID,
                                          scopes: [
                                            //'https://www.googleapis.com/auth/contacts.readonly'
                                          ],
                                          customParameters: {
                                            // Forces account selection even when one account
                                            // is available.
                                            prompt: 'select_account'
                                          }
                                        },
                                        {
                                          provider: firebase.auth.GithubAuthProvider.PROVIDER_ID, 
                                          scopes: [

                                          ],
                                          customParameters: {
                                            // Forces password re-entry.
                                            auth_type: 'reauthenticate'
                                          }
                                        },
                                        ],
                      // Terms of service url.
                      tosUrl: './terminosServicio.html',
                      // Privacy policy url.
                      privacyPolicyUrl: './politicaPrivacidad.html'
                    };

    // The start method will wait until the DOM is loaded.
    ui.start('#botonesAcceso', uiConfig);

 function loginEmailPassfirebase(){
    correo = $("#usernameLogin").val();
    pass = $("#passwordLogin").val();
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

    if(pass.trim() == "" || pass.length < 6){
      $("#errorPassword").css("display","block");
      error = true;
    }
    else{
      $("#errorPassword").css("display","none");
      if(!error)
        error = false;
    }

    if(error)
      return;

    if(error === false){
        au.signInWithEmailAndPassword(correo, pass)
        .then((userCredential) => {
          // Signed in
          console.log("activo");
        location.href="<?php echo base_url(); ?>index.php/usuarioExterno/validaUsuarioExterno";
        })
        .catch((error) => {
        enviaAlerta(" ",error);
          return;
          console.log(error);
        });
    }

  }

  </script>
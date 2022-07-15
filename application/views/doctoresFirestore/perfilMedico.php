<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//die("habilitado $habilitado");
?>
<!-- Page Content -->
<div class="container">

  <!-- Page Heading -->

  <?php
   if(isset($error) && $error != ""){
      echo "
      <div class='alert alert-danger alert-dismissible fade show' role='alert'>
        $error
      </div>
      ";
   }
  ?>
    <div class="row">

    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row pt-8">
        <div class="col-xl-4 order-xl-2">
          <div class="card card-profile">
            <img src="<?php echo base_url(); ?>vendor/assets/img/theme/img-0-1000x600.jpg" alt="Image placeholder" class="card-img-top">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="<?php echo base_url(); ?>vendor/assets/img/theme/default-1.png" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>

            <div class="card-body pt-4">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center">

                  </div>
                </div>
              </div>
              <div class="text-center pt-3">
                <h5 class="h3"><span id="lblNombres" ></span>
                  <span class="font-weight-light"></span>
                </h5>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i><span id="lblPuesto" ></span>
                </div>

              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Editar perfil </h3>
                </div>
                 <form class="needs-validation" novalidate>

                <div class="col-4 text-right">
                  <input type="button" class="btn btn-sm btn-primary" value="Guardar cambios" onClick='editarMedico()'>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form>
                <h6 class="heading-small text-muted mb-4">Información de usuario</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Usuario</label>
                          <input type="text" name="idFirestore" id="idFirestore" required class="form-control" value="<?php echo set_value("idFirestore",isset($idFirestore)?$idFirestore:""); ?>" readonly>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Correo eléctronico</label>
                          <input class="form-control" type="email" name="correo" id="correo" readonly value="<?php echo set_value("correo",isset($correo)?$correo:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Correo eléctronico profesional">
                          <small class="text-danger" id="errorCorreo" style="display: none;">Correo eléctronico invalido</small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Nombre (s)</label>
                          <input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo set_value("nombre",isset($nombre)?$nombre:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Nombre del personal médico">
                          <small class="text-danger" id="errorNombre" style="display: none;">Escriba un nombre valido</small>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Apellido (s)</label>
                          <input class="form-control" type="text" name="apellidos" id="apellidos" value="<?php echo set_value("apellidos",isset($apellidos)?$apellidos:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Apellido del personal medico">
                          <small class="text-danger" id="errorApellidos" style="display: none;">Escriba un nombre valido</small>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Información de contacto</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">Dirección</label>
                        <input class="form-control" type="text" name="direccion" id="direccion" value="<?php echo set_value("direccion",isset($direccion)?$direccion:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Dirección de contacto">
                        <small class="text-danger" id="errorDireccion" style="display: none;">Escriba un nombre valido</small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                  	<!--
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">Ciudad</label>
                        <input type="text" id="input-city" class="form-control" placeholder="City" value="New York">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">País</label>
                        <input type="text" id="input-country" class="form-control" placeholder="Country" value="United States">
                      </div>
                    </div> -->
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Teléfono</label>
                          <input class="form-control" type="text" name="telefono" id="telefono" value="<?php echo set_value("telefono",isset($telefono)?$telefono:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Número telefonico de contacto">
                          <small class="text-danger" id="errorTelefono" style="display: none;">Escriba un nombre valido</small>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>  


    </div>

  </form>

</div>
<!-- /.container -->

<script type="text/javascript">

<?php if($soloLectura || $editar): ?>
  leerMedico();

  function leerMedico(){
    validaSesionfirebase("<?php $usuarioLogeado ?>");

    var referencia = db.collection("medicos").doc("<?php echo $idFirestore ?>");
    referencia.get().then((documento) => {
      // Se revisa que el documento exista
      if(documento.exists){

        $("#nombre").val(documento.data().nombres);
        $("#apellidos").val(documento.data().apellidos);
        $("#telefono").val(documento.data().telefono);
        $("#direccion").val(documento.data().direccion);
        
        let datosusuario = "<h5>" + documento.data().nombres.toUpperCase() + " " + documento.data().apellidos.toUpperCase() + "</h5>";
        document.getElementById("lblNombres").innerHTML = datosusuario;
        
        let datospuesto = " Especialidad: " + documento.data().especialidad.toLowerCase() + " ";
        document.getElementById("lblPuesto").innerHTML = datospuesto;

        var user = firebase.auth().currentUser;
        var currentname, currentemail, currentphotoUrl, currentuid, currentemailVerified;

        if (user != null) {
          currentname = user.displayName;
          currentemail = user.email;
          currentphotoUrl = user.photoURL;
          currentemailVerified = user.emailVerified;
          currentuid = user.uid;
          $("#correo").val(currentemail);
          
        }

      }
      else{
        alert("El documento <?php echo $idFirestore ?> no existe");
      }
    })
    .catch((error) => {
        alert("Error obteniendo el documento: " + error);
    });
  }
<?php endif; ?>

<?php if(!$soloLectura && $editar): ?>
  function editarMedico(){
    validaSesionfirebase("<?php $usuarioLogeado ?>");

        nombres = $("#nombre").val();
        apellidos = $("#apellidos").val();
        telefono = $("#telefono").val();
        direccion = $("#direccion").val();
        password = $("#password1").val();
        password2 = $("#password2").val();
        correo = $("#correo").val().trim();

        error = false;
        if(nombres == ""){
          $("#errorNombre").css("display","block");
          error = true;
        }
        else{
          $("#errorNombre").css("display","none");
          if(!error)
            error = false;
        }

        if(apellidos == ""){
          $("#errorApellidos").css("display","block");
          error = true;
        }
        else{
          $("#errorApellidos").css("display","none");
          if(!error)
            error = false;
        }

        if(telefono == "" || telefono.length != 10){
          $("#errorTelefono").css("display","block");
          error = true;
        }
        else{
          $("#errorTelefono").css("display","none");
          if(!error)
            error = false;
        }    

        if(direccion == ""){
          $("#errorDireccion").css("display","block");
          error = true;
        }
        else{
          $("#errorDireccion").css("display","none");
          if(!error)
            error = false;
        }

        if(correo == ""){
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

    var usuarioUpdate = db.collection("medicos").doc("<?php echo $idFirestore ?>");
      return usuarioUpdate.update({
            nombres: nombres,
            apellidos: apellidos,
            telefono: telefono,
            direccion: direccion,
      })
      .then(() => {
        enviaAlerta("Editar","Datos de usuario actualizados exitosamente ");
      })
      .catch((error) => {
          // The document probably doesn't exist.
        enviaAlerta("Error","Error editando el documento: " + error);
      });
  }
<?php endif; ?>

</script>





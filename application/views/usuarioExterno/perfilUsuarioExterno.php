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
                    <input type="hidden" id="urlAvatar" />
                    <span id="imgAvatar"></span>
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
                  <input type="button" class="btn btn-sm btn-primary" value="Guardar cambios" onClick='editar()' />
                </div>
              </div>
            </div>
            <div class="card-body">
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
                          <input class="form-control" type="email" name="correo" id="correo" value="<?php echo set_value("correo",isset($correo)?$correo:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Correo eléctronico profesional" readonly >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Nombre (s)</label>
                          <input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo set_value("nombre",isset($nombre)?$nombre:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Nombre">
                          <small class="text-danger" id="errorNombre" style="display: none;">Escriba el nombre del paciente</small>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Primer apellido</label>
                          <input class="form-control" type="text" name="apellido1" id="apellido1" value="<?php echo set_value("apellido1",isset($apellido1)?$apellido1:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Apellido (s)">
                          <small class="text-danger" id="errorApellidos" style="display: none;">Escriba un apellido valido para del paciente</small>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Segundo apellido (opcional) </label>
                          <input class="form-control" type="text" name="apellido2" id="apellido2" value="<?php echo set_value("apellido2",isset($apellido2)?$apellido2:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Apellido (s)">
                          <small class="text-danger" id="errorApellidos" style="display: none;">Escriba un apellido valido para del paciente</small>
                      </div>
                    </div>                   
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Información de contacto</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">Edad</label>
                        <input class="form-control" type="number" name="edad" id="edad" value="<?php echo set_value("edad",isset($edad)?$edad:""); ?>" <?php if($soloLectura) echo "readonly"; ?> step="1" min="0" max="99" placeholder="Edad del paciente">
                        <small class="text-danger" id="errorEdad" style="display: none;">Escriba una edad valida para el paciente</small>

                      </div>
                    </div>
                    <div class="col-lg-8">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Fecha de nacimiento</label>
                        <input class="form-control" type="text" name="nacimiento" id="nacimiento" value="<?php echo set_value("nacimiento",isset($nacimiento)?$nacimiento:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Fecha de nacimiento DD-MM-AAAA">
                        <small class="text-danger" id="errorNacimiento" style="display: none;">Escriba un fecha valida en formato DD-MM-AAAA</small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">Dirección</label>
                        <input class="form-control" type="text" name="direccion" id="direccion" value="<?php echo set_value("direccion",isset($direccion)?$direccion:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Dirección de contacto">
                         <small class="text-danger" id="errorDireccion" style="display: none;">Escriba una dirección valida</small>                       
                      </div>
                    </div>
                  </div>
                  <div class="row">

                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Teléfono</label>
                          <input class="form-control" type="text" name="telefono" id="telefono" value="<?php echo set_value("telefono",isset($telefono)?$telefono:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Número telefonico de contacto">
                         <small class="text-danger" id="errorTelefono" style="display: none;">Escriba un teléfono valido</small>                                                 
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Latitud</label>
                          <input type="number" name="latitud" id="latitud" class="form-control" value="<?php echo set_value("latitud",isset($latitud)?$latitud:""); ?>" <?php if($soloLectura) echo "readonly"; ?> step="0.000000000000001" min="-90" max="90">
                          <small class="text-danger" id="errorLatitud" style="display: none;">Escriba la latitud</small>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">Longitud</label>
                          <input type="number" name="longitud" id="longitud" class="form-control" value="<?php echo set_value("longitud",isset($longitud)?$longitud:""); ?>" <?php if($soloLectura) echo "readonly"; ?> step="0.000000000000001" min="-180.00000000000000" max="180.00000000000000" >
                          <small class="text-danger" id="errorLongitud" style="display: none;">Escriba la longitud</small>
                      </div>
                    </div>
                  </div>
                </div>

            </div>
          </div>
        </div>
      </div>  


    </div>

  </form>

</div>
<!-- /.container -->


<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_KEY_PARA_ESTE_SITIO;?>"></script>
<script src="<?php echo base_url(); ?>vendor/geofire/geofireCommon.min.js"></script>
<script type="text/javascript">

  // Se crea una instancia de la base de datos de Firestore
  var db = firebase.firestore();
  var auth  = firebase.auth();

<?php if($soloLectura || $editar): ?>
  leerMedico();

  let isRegisterId = null;
  let avatar = "";

  function leerMedico(){

    var referencia = db.collection("usuarios").where("authId", "==", "<?php echo $idFirestore ?>").limit("1").get().then((datosRecibidos) => {
      datosRecibidos.forEach((documento) => {
          if(documento.exists){
        isRegisterId = documento.id;
        $("#nombre").val(documento.data().nombres);
        $("#apellido1").val(documento.data().apellido1);
        $("#correo").val(documento.data().authId);
        $("#telefono").val(documento.data().telefono);
        $("#direccion").val(documento.data().direccion);
        $("#edad").val(documento.data().edad);
        $("#nacimiento").val(documento.data().date);        
        $("#latitud").val(documento.data().ubicacion.latitude);
        $("#longitud").val(documento.data().ubicacion.longitude);

        avatar = documento.data().avatar;

        let datosusuario = "<h5>" + documento.data().nombres.toUpperCase() + " " + documento.data().apellido1.toUpperCase() + "</h5>";
        document.getElementById("lblNombres").innerHTML = datosusuario;
        
        let datospuesto = " " + documento.data().date + " ";
        document.getElementById("lblPuesto").innerHTML = datospuesto;

      }
      else{
        enviaAlerta("Registro","Parece que aun no terminas tu registro, por favor completa el formulario");
      }

      });
        if (isRegisterId == null){
          enviaAlerta("Registro","Parece que aun no terminas tu registro, por favor completa el formulario");
        }

        var user = firebase.auth().currentUser;
        var currentname, currentemail, currentphotoUrl, currentuid, currentemailVerified;

        if (user != null) {
          currentname = user.displayName;
          currentemail = user.email;
          currentphotoUrl = user.photoURL;
          currentemailVerified = user.emailVerified;
          currentuid = user.uid;
          $("#correo").val(currentemail);

          if($("#nombre").val() == ""){
            $("#nombre").val(currentname);
            let datosusuario = "<h5>" + currentname.toUpperCase() + "</h5>";
            document.getElementById("lblNombres").innerHTML = datosusuario;
          }

          if(isRegisterId != null){
             document.getElementById("imgAvatar").innerHTML = "<img src='" + avatar + "' alt='Image placeholder' class='rounded-circle' >";

          }else{
            if(typeof currentphotoUrl !== 'undefined'){
             document.getElementById("imgAvatar").innerHTML = "<img src='" + currentphotoUrl + "' alt='placeholder' class='rounded-circle' >";
              $("#urlAvatar").val(currentphotoUrl);
            }else{
            document.getElementById("imgAvatar").innerHTML = "<img src='<?php echo base_url(); ?>vendor/assets/img/theme/default-0.jpg' alt='Image' class='rounded-circle' >";
            }
             
          }        

          
        }

    })
    .catch((error) => {
        alert("Error obteniendo el documento: " + error);
    });
  }



  function editar(){
        userauth = $("#idFirestore").val();
        nombres = $("#nombre").val();
        apellido1 = $("#apellido1").val();
        apellido2 = $("#apellido2").val();
        edad = $("#edad").val();
        nacimiento = $("#nacimiento").val();
         correo = $("#correo").val();       
        telefono = $("#telefono").val();
        direccion = $("#direccion").val();
        latitud = $("#latitud").val();
        longitud = $("#longitud").val();
        avatar = $("#urlAvatar").val();

          let regNumbers = /^\d+$/;
          let regLetters = /^[a-zA-Z\s]*$/;
          let regexEmail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            let regexDate = /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/;


        error = false;
        if(nombres == "" || regLetters.test(nombres) != true){
          $("#errorNombre").css("display","block");
          error = true;
        }
        else{
          $("#errorNombre").css("display","none");
          if(!error)
            error = false;
        }

        if(apellido1 == "" || regLetters.test(apellido1) != true){
          $("#errorApellidos").css("display","block");
          error = true;
        }
        else{
          $("#errorApellidos").css("display","none");
          if(!error)
            error = false;
        }

        if(edad == "" || edad<0 || regNumbers.test(edad) != true){
          $("#errorEdad").css("display","block");
          error = true;
        }
        else{
          $("#errorEdad").css("display","none");
          if(!error)
            error = false;
        }

        if(nacimiento == "" || regexDate.test(nacimiento) != true){
          $("#errorNacimiento").css("display","block");
          error = true;
        }
        else{
          $("#errorNacimiento").css("display","none");
          if(!error)
            error = false;
        }

        if(correo == "" || regexEmail.test(correo) == false){
          $("#errorCorreo").css("display","block");
          error = true;
        }
        else{
          $("#errorCorreo").css("display","none");
          if(!error)
            error = false;
        }

          if(telefono == "" || telefono.length != 10 || regNumbers.test(telefono) != true){
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

        if(latitud == ""){
          $("#errorLatitud").css("display","block");
          error = true;
        }
        else{
          $("#errorLatitud").css("display","none");
          if(!error)
            error = false;
        } 

        if(longitud == ""){
          $("#errorLongitud").css("display","block");
          error = true;
        }
        else{
          $("#errorLongitud").css("display","none");
          if(!error)
            error = false;
        }             

        if(error == true)
          return;

          latitud = parseFloat(latitud);
          longitud = parseFloat(longitud);
          geohash = geofireCommon.geohashForLocation([latitud, longitud]); 

          if (isRegisterId != null){
   var usuarioUpdate = db.collection("usuarios").doc(isRegisterId);

        return usuarioUpdate.update({
          nombres: nombres,
          apellido1: apellido1,
          apellido2: apellido2,
          edad: edad,
          date: nacimiento,
          telefono: telefono,
          direccion: direccion,
          ubicacion: new firebase.firestore.GeoPoint(latitud,longitud),
          geohash: geohash

      })
      .then(() => {
        enviaAlerta(" ","Datos de usuario actualizados exitosamente");

        location.href = "<?php echo base_url()."index.php/usuarioExterno/perfil"; ?>";

      })
      .catch((error) => {
          // The document probably doesn't exist.
          alert("Error editando el documento: " + error);
      });
          }else{
          db.collection("usuarios").add({
            authId: userauth, 
            nombres: nombres,
            apellido1: apellido1,
            apellido2: apellido2,
            edad: edad,
            date: nacimiento,
            telefono: telefono,
            direccion: direccion,
            ubicacion: new firebase.firestore.GeoPoint(latitud,longitud),
            geohash: geohash
          })
          .then((documento) => {
        enviaAlerta(" ","Datos de usuario actualizados exitosamente");

              location.href = "<?php echo base_url()."index.php/usuarioExterno/perfil"; ?>";
            })
          .catch((error) => {
            alert("Error agregando el documento: " + error);
          });
     
      }
  }

<?php endif; ?>

</script>





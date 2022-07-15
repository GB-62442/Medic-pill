<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//die("habilitado $habilitado");
?>
<!-- Page Content -->
<div class="container">

  <!-- Page Heading -->
  <h1 class="my-4"><?php echo $titulo; ?></h1>

  <?php
   if(isset($error) && $error != ""){
      echo "
      <div class='alert alert-danger alert-dismissible fade show' role='alert'>
        $error
      </div>
      ";
   }
  ?>


  <form class="needs-validation" novalidate>
    <div class="row">

      <?php if( ($soloLectura || $editar) && isset($idFirestore) ): ?>

        <div class="col-md-12 form-group">
          <label class="form-control-label" for="idFirestore">ID del usuario</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
              </div>
          <input type="text" name="idFirestore" id="idFirestore" required class="form-control" value="<?php echo set_value("idFirestore",isset($idFirestore)?$idFirestore:""); ?>" readonly>
            </div>
          <small class="text-danger" id="errorId" style="display: none;">Escriba el id</small>
        </div>

      <?php endif; ?>      

        <div class="col-md-6 form-group">
          <label class="form-control-label" for="nombre">Nombre (s)</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-folder-17"></i></span>
              </div>
          <input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo set_value("nombre",isset($nombre)?$nombre:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Nombre del personal médico">
            </div>
          <small class="text-danger" id="errorNombre" style="display: none;">Escriba un nombre valido</small>
        </div>

        <div class="col-md-6 form-group">
          <label class="form-control-label" for="apellidos">Apellido (s)</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-folder-17"></i></span>
              </div>
          <input class="form-control" type="text" name="apellidos" id="apellidos" value="<?php echo set_value("apellidos",isset($apellidos)?$apellidos:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Apellido del personal medico">
            </div>
          <small class="text-danger" id="errorApellido" style="display: none;">Escriba un apellido valido</small>
        </div>

        <div class="col-md-6 form-group">
          <label class="form-control-label" for="especialidad">Especialidad</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-folder-17"></i></span>
              </div>
          <input class="form-control" type="text" name="especialidad" id="especialidad" value="<?php echo set_value("especialidad",isset($especialidad)?$especialidad:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Nombre de la especialidad">
            </div>
          <small class="text-danger" id="errorEspecialidad" style="display: none;">Escriba un nombre valido para la especialidad</small>
        </div>

        <div class="col-md-6 form-group">
          <label class="form-control-label" for="cedula">No. Cédula profesional</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-folder-17"></i></span>
              </div>
          <input class="form-control" type="text" name="cedula" id="cedula" value="<?php echo set_value("cedula",isset($cedula)?$cedula:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Número de cédula profesional">
            </div>
          <small class="text-danger" id="errorCedula" style="display: none;">Escriba un número de cédula valido</small>
        </div>
        <?php if(!isset($idFirestore) ): ?>

        <div class="col-md-6 form-group">
          <label class="form-control-label" for="correo">Correo eléctronico</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
              </div>
          <input class="form-control" type="email" name="correo" id="correo" value="<?php echo set_value("correo",isset($correo)?$correo:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Correo eléctronico profesional">
            </div>
          <small class="text-danger" id="errorCorreo" style="display: none;">Escriba un correo eléctronico valido</small>
        </div>
      <?php endif; ?>      
      
      <?php if(!isset($idFirestore) ){ ?>
        <div class="col-md-6 form-group">
      <?php }else{ ?>
        <div class="col-md-12 form-group">
      <?php }  ?>      

          <label class="form-control-label" for="telefono">Teléfono</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
              </div>
          <input class="form-control" type="text" name="telefono" id="telefono" value="<?php echo set_value("telefono",isset($telefono)?$telefono:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Número telefonico de contacto">
            </div>
          <small class="text-danger" id="errorTelefono" style="display: none;">Escriba un número teléfonico valido</small>
        </div>

        <div class="col-md-12 form-group">
          <label class="form-control-label" for="direccion">Dirección</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-square-pin"></i></span>
              </div>
          <input class="form-control" type="text" name="direccion" id="direccion" value="<?php echo set_value("direccion",isset($direccion)?$direccion:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Dirección de contacto">
            </div>
          <small class="text-danger" id="errorDireccion" style="display: none;">Escriba una dirección valida</small>
        </div>
        <?php if(!isset($idFirestore) ): ?>

        <div class="col-md-6 form-group">
          <label class="form-control-label" for="password">Contraseña</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-key-25"></i></span>
              </div>
          <input class="form-control" type="password" name="password" id="password" value="<?php echo set_value("password",isset($password)?$password:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Contraseña">
            </div>
          <small class="text-danger" id="errorPassword" style="display: none;">Escriba una contraseña valida</small>
        </div>

        <div class="col-md-6 form-group">
          <label class="form-control-label" for="password2">Repita la contraseña</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-key-25"></i></span>
              </div>
          <input class="form-control" type="password" name="password2" id="password2" value="<?php echo set_value("password2",isset($password2)?$password2:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Contraseña">
            </div>
          <small class="text-danger" id="errorPassword2" style="display: none;">Las contraseñas deben coincidir</small>
        </div>
      <?php endif; ?>      


    </div>

  <?php if(!$soloLectura): ?>
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-4 form-group">
        <input type="button" class="form-control btn btn-primary" value="<?php echo $titulo; ?>" <?php echo ($editar?"onClick='editarMedico()'":"onClick='agregarMedico()'"); ?> >
      </div>
      <div class="col-md-2"></div>
      <div class="col-md-4 form-group">
        <input type="regresar" class="form-control btn btn-success" value="Regresar" onclick="window.history.back();">
      </div>
      <div class="col-md-1"></div>
    </div>
  <?php else: ?>
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4 form-group">
        <input type="regresar" class="form-control btn btn-success" value="Regresar" onclick="window.history.back();">
      </div>
      <div class="col-md-4"></div>
    </div>
  <?php endif; ?>

  </form>

</div>
<!-- /.container -->


<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_KEY_PARA_ESTE_SITIO;?>"></script>

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
        $("#correo").val(documento.data().authId);
        $("#telefono").val(documento.data().telefono);
        $("#direccion").val(documento.data().direccion);
        $("#especialidad").val(documento.data().especialidad);
        $("#cedula").val(documento.data().cedula);

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
        especialidad = $("#especialidad").val();
        cedula = $("#cedula").val();

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

        if(cedula == "" || cedula.length < 7 || cedula.length > 10){
          $("#errorCedula").css("display","block");
          error = true;
        }
        else{
          $("#errorCedula").css("display","none");
          if(!error)
            error = false;
        }    

        if(especialidad == "" || especialidad.length < 3){
          $("#errorEspecialidad").css("display","block");
          error = true;
        }
        else{
          $("#errorEspecialidad").css("display","none");
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

    if(error)
      return;

    var usuarioUpdate = db.collection("medicos").doc("<?php echo $idFirestore ?>");
      return usuarioUpdate.update({
            nombres: nombres,
            apellidos: apellidos,
            telefono: telefono,
            direccion: direccion,
            especialidad: especialidad,
            cedula: cedula
      })
      .then(() => {
        alert("Datos de usuario actualizados exitosamente");

        location.href = "<?php echo base_url()."index.php/medico/index"; ?>";

      })
      .catch((error) => {
          // The document probably doesn't exist.
          alert("Error editando el documento: " + error);
      });
  }
<?php elseif(!$soloLectura): ?>
  function agregarMedico(){
    validaSesionfirebase("<?php $usuarioLogeado ?>");

        nombres = $("#nombre").val();
        apellidos = $("#apellidos").val();
        correo = $("#correo").val();
        telefono = $("#telefono").val();
        direccion = $("#direccion").val();
        especialidad = $("#especialidad").val();
        cedula = $("#cedula").val();
        password = $("#password").val();
        password2 = $("#password2").val();


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

        if(correo == ""){
          $("#errorCorreo").css("display","block");
          error = true;
        }
        else{
          $("#errorCorreo").css("display","none");
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
        if(cedula == "" || cedula.length < 7 || cedula.length > 10){
          $("#errorCedula").css("display","block");
          error = true;
        }
        else{
          $("#errorCedula").css("display","none");
          if(!error)
            error = false;
        }    

        if(especialidad == "" || especialidad.length < 3){
          $("#errorEspecialidad").css("display","block");
          error = true;
        }
        else{
          $("#errorEspecialidad").css("display","none");
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

        if(password == "" || password.length < 6){
          $("#errorPassword").css("display","block");
          error = true;
        }
        else{
          $("#errorPassword").css("display","none");
          if(!error)
            error = false;
        }      

        if(password2 == "" || password.length < 6 || password2 != password){
          $("#errorPassword2").css("display","block");
          error = true;
        }
        else{
          $("#errorPassword2").css("display","none");
          if(!error)
            error = false;
        }      

        if(error)
          return;

        firebase.auth().createUserWithEmailAndPassword(correo, password)
        .then((usuarioAuth) => {
          console.log(usuarioAuth);

          db.collection("medicos").doc(usuarioAuth.user.uid).set({
            authId: usuarioAuth.user.uid, 
            nombres: nombres,
            apellidos: apellidos,
            telefono: telefono,
            direccion: direccion,
            especialidad: especialidad,
            cedula: cedula

          })
          .then((documento) => {
        //alert("Se escribió el documento con el ID: " + documento.id);
        //console.log("El objeto es: %o", documento);
        location.href = "<?php echo base_url()."index.php/medico/index"; ?>";
    })
          .catch((error) => {
            alert("Error agregando el documento: " + error);
          });


        })
        .catch((error) => {
          alert("Error agregando el documento: " + error);

    // ..
});

  }

<?php endif; ?>


</script>





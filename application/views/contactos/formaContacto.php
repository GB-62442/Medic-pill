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

        <div class="col-md-12 form-group">
          <label class="form-control-label" for="idContacto">ID del contacto</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-book-bookmark"></i></span>
              </div>
          <input type="text" name="idContacto" id="idContacto" required class="form-control" value="<?php echo set_value("idContacto",isset($idContacto)?$idContacto:""); ?>" readonly>
            </div>
          <small class="text-danger" id="errorId" style="display: none;">Escriba el id</small>
        </div>
      <?php endif; ?>      

        <div class="col-md-6 form-group">
          <label class="form-control-label" for="nombre">Nombre (s) del contacto</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-folder-17"></i></span>
              </div>
          <input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo set_value("nombre",isset($nombre)?$nombre:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="nombre contacto">
            </div>
          <small class="text-danger" id="errorNombre" style="display: none;">Escriba el nombre del contacto</small>
        </div>

        <div class="col-md-6 form-group">
          <label class="form-control-label" for="apellido">Apellido (s) del contacto</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-folder-17"></i></span>
              </div>
          <input class="form-control" type="text" name="apellido" id="apellido" value="<?php echo set_value("apellido",isset($apellido)?$apellido:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Apellido contacto">
            </div>
          <small class="text-danger" id="errorApellido" style="display: none;">Escriba el apellido del contacto</small>
        </div>

		<div class="col-md-12" style="display:inline-flex; padding: 0">

        <div class="col-md-2 form-group">
          <label class="form-control-label" for="edad">Edad</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-badge"></i></span>
              </div>
          <input class="form-control" type="number" name="edad" id="edad" value="<?php echo set_value("edad",isset($edad)?$edad:""); ?>" <?php if($soloLectura) echo "readonly"; ?> step="1" min="18" max="99" placeholder="Edad del contacto">
            </div>
          <small class="text-danger" id="errorEdad" style="display: none;">El contacto requiere ser mayor de edad</small>
        </div>

        <div class="col-md-5 form-group">
          <label class="form-control-label" for="parentesco">Parentesco</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-badge"></i></span>
              </div>
          <select class="form-control" type="text" name="parentesco" id="parentesco" value="<?php echo set_value("parentesco",isset($parentesco)?$parentesco:""); ?>" <?php if($soloLectura) echo "readonly"; ?> >
            <option value="Madre">Madre</option>
            <option value="Padre">Padre</option>
            <option value="Esposo/a">Esposo/a</option>
            <option value="Tutor">Tutor</option>
            <option value="Hermano/a">Hermano/a</option>
            <option value="Hijo/a">Hijo/a</option>
            <option value="Familiar">Familiar</option>
            <option value="Amigo">Amigo</option>
            <option value="Otro">Otro</option>
          </select>
            </div>
          <small class="text-danger" id="errorParentesco" style="display: none;">Escriba información valida</small>
        </div>

        <div class="col-md-5 form-group">
          <label class="form-control-label" for="telefono">Teléfono</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
              </div>
          <input class="form-control" type="text" name="telefono" id="telefono" value="<?php echo set_value("telefono",isset($telefono)?$telefono:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Número teléfonico de contacto">
            </div>
          <small class="text-danger" id="errorTelefono" style="display: none;">Escriba un número teléfonico valido</small>
        </div>
		</div>	

    <div class="col-md-12 form-group">
      <label class="form-control-label" for="direccion">Dirección del contacto</label>
        <div class="input-group input-group-merge input-group-alternative">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="ni ni-square-pin"></i></span>
          </div>
        <input class="form-control" type="text" name="direccion" id="direccion" value="<?php echo set_value("direccion",isset($direccion)?$direccion:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Dirección del contacto">
        </div>
     <small class="text-danger" id="errorDireccion" style="display: none;">Escriba una dirección valida</small>
    </div>

		<div class="col-md-12" style="display:inline-flex; padding: 0">

	    <div class="col-md-6 form-group">
        <label  class="form-control-label" for="latitud">Latitud</label>
        <input type="text" name="latitud" id="latitud" class="form-control" value="<?php echo set_value("latitud",isset($latitud)?$latitud:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Latitud dirección">
        <small class="text-danger" id="errorLatitud" style="display: none;">Escriba las coordenadas para la latitud</small>
      </div>

      <div class="col-md-6 form-group">
        <label  class="form-control-label" for="longitud">Longitud</label>
        <input type="text" name="longitud" id="longitud" class="form-control" value="<?php echo set_value("longitud",isset($longitud)?$longitud:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Longitud dirección">
        <small class="text-danger" id="errorLongitud" style="display: none;">Escriba las coordenadas para la longitud</small>
      </div>
		</div>
  </div>

  <?php if(!$soloLectura): ?>
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-4 form-group">
        <input type="button" class="form-control btn btn-primary " value="<?php echo $titulo; ?>" <?php echo ($editar?"onClick='editarContacto()'":"onClick='agregarContacto()'"); ?> >
      </div>
      <div class="col-md-2"></div>
      <div class="col-md-4 form-group">
        <input type="regresar" class="form-control btn btn-success " value="Regresar" onclick="window.history.back();">
      </div>
      <div class="col-md-1"></div>
    </div>
  <?php else: ?>
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4 form-group">
        <input type="regresar" class="form-control btn btn-success " value="Regresar" onclick="window.history.back();">
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
  leeContacto();

  function leeContacto(){
    validaSesionfirebase("<?php $usuarioLogeado ?>");

    var referencia = db.collection("usuarios").doc("<?php echo $idFirestore ?>").collection('contactos').doc("<?php echo $idContacto ?>");
    referencia.get().then((documento) => {
      // Se revisa que el documento exista
      if(documento.exists){
        $("#nombre").val(documento.data().nombres);
	    $("#apellido").val(documento.data().apellidos);
	    $("#edad").val(documento.data().edad);
	    $("#parentesco").val(documento.data().parentesco);
	    $("#telefono").val(documento.data().telefono);
	    $("#direccion").val(documento.data().direccion);
	    $("#latitud").val(documento.data().ubicacion.latitude);
	    $("#longitud").val(documento.data().ubicacion.longitude);
      }
      else{
        alert("El documento <?php echo $idContacto ?> no existe");
      }
    })
    .catch((error) => {
        alert("Error obteniendo el documento: " + error);
    });
  }
<?php endif; ?>

<?php if(!$soloLectura && $editar): ?>
  function editarContacto(){
    validaSesionfirebase("<?php $usuarioLogeado ?>");

    nombre = $("#nombre").val();
    apellido = $("#apellido").val();
    edad = $("#edad").val();
    parentesco = $("#parentesco").val();
    telefono = $("#telefono").val();
    direccion = $("#direccion").val();
    latitud = $("#latitud").val();
    longitud = $("#longitud").val();

    let regNumbers = /^\d+$/;
    let regLetters = /^[a-zA-Z]+$/;

    error = false;
    if(nombre == "" || (regLetters.test(nombre) != true )){
      $("#errorNombre").css("display","block");
      error = true;
    }
    else{
      $("#errorNombre").css("display","none");
      if(!error)
        error = false;
    }

    if(apellido == "" || (regLetters.test(apellido) != true)){
      $("#errorApellido").css("display","block");
      error = true;
    }
    else{
      $("#errorApellido").css("display","none");
      if(!error)
        error = false;
    }

    if(edad == "" || edad<18 || (regNumbers.test(edad) != true)){
      $("#errorEdad").css("display","block");
      error = true;
    }
    else{
      $("#errorEdad").css("display","none");
      if(!error)
        error = false;
    }

    if(parentesco == "" || (regLetters.test(parentesco) != true)){
      $("#errorParentesco").css("display","block");
      error = true;
    }
    else{
      $("#errorParentesco").css("display","none");
      if(!error)
        error = false;
    }

    if(telefono == "" || telefono.length != 10 || (regNumbers.test(telefono) != true) ){
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

    if(longitud == ""){
      $("#errorLongitud").css("display","block");
      error = true;
    }
    else{
      $("#errorLongitud").css("display","none");
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

    if(error)
      return;

    db.collection("usuarios").doc("<?php echo $idFirestore ?>").collection("contactos").doc("<?php echo $idContacto ?>").set({
        nombres: nombre,
        apellidos: apellido,
        direccion: direccion,
        edad: edad,
        parentesco: parentesco,
        telefono: telefono,
        ubicacion: new firebase.firestore.GeoPoint(latitud,longitud)
    })
    .then((documento) => {
        //alert("Se escribió el documento con el ID: " + documento.id);
        //console.log("El objeto es: %o", documento);
        location.href = "<?php echo base_url()."index.php/paciente/editarPaciente?id=".$idFirestore ?>";
    })
    .catch((error) => {
        alert("Error editando el documento: " + error);
    });
  }
<?php elseif(!$soloLectura): ?>
  function agregarContacto(){
    validaSesionfirebase("<?php $usuarioLogeado ?>");

    nombre = $("#nombre").val();
    apellido = $("#apellido").val();
    edad = $("#edad").val();
    parentesco = $("#parentesco").val();
    telefono = $("#telefono").val();
    direccion = $("#direccion").val();
    latitud = $("#latitud").val();
    longitud = $("#longitud").val();

    let regNumbers = /^\d+$/;
    let regLetters = /^[a-zA-Z]+$/;

    error = false;
    if(nombre == "" || regLetters.test(nombre) != true){
      $("#errorNombre").css("display","block");
      error = true;
    }
    else{
      $("#errorNombre").css("display","none");
      if(!error)
        error = false;
    }

    if(apellido == "" || regLetters.test(apellido) != true){
      $("#errorApellido").css("display","block");
      error = true;
    }
    else{
      $("#errorApellido").css("display","none");
      if(!error)
        error = false;
    }

    if(edad == "" || edad<18 || regNumbers.test(edad) != true ){
      $("#errorEdad").css("display","block");
      error = true;
    }
    else{
      $("#errorEdad").css("display","none");
      if(!error)
        error = false;
    }

    if(parentesco == "" || regLetters.test(parentesco) != true){
      $("#errorParentesco").css("display","block");
      error = true;
    }
    else{
      $("#errorParentesco").css("display","none");
      if(!error)
        error = false;
    }

    if(telefono == "" || telefono.length != 10 || regNumbers.test(telefono) != true ){
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

    if(longitud == ""){
      $("#errorLongitud").css("display","block");
      error = true;
    }
    else{
      $("#errorLongitud").css("display","none");
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

    if(error)
      return;

    db.collection("usuarios").doc("<?php echo $idFirestore ?>").collection('contactos').add({
        nombres: nombre,
        apellidos: apellido,
        direccion: direccion,
        edad: edad,
        parentesco: parentesco,
        telefono: telefono,
        ubicacion: new firebase.firestore.GeoPoint(latitud,longitud)

    })
    .then((documento) => {
        location.href = "<?php echo base_url()."index.php/paciente/editarPaciente?id=".$idFirestore; ?>";
    })
    .catch((error) => {
        alert("Error agregando el documento: " + error);
    });
  }

<?php endif; ?>
</script>





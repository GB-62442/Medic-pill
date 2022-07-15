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
          <label class="form-control-label" for="idTratamiento">ID del registro</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-book-bookmark"></i></span>
              </div>
          <input type="text" name="idTratamiento" id="idTratamiento" required class="form-control" value="<?php echo set_value("idTratamiento",isset($idTratamiento)?$idTratamiento:""); ?>" readonly>
            </div>
          <small class="text-danger" id="errorId" style="display: none;">Escriba el id</small>
        </div>

      <?php endif; ?>      

        <div class="col-md-12 form-group">
          <label class="form-control-label" for="nombre">Nombre</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-folder-17"></i></span>
              </div>
              <input class='form-control' type='text' name='nombre' id='nombre' value='<?php echo set_value('nombre',isset($nombre)?$nombre:''); ?>' <?php if($soloLectura) echo 'readonly'; ?> placeholder='Nombre del tratamiento medicamento'>
            </div>
          <small class="text-danger" id="errorNombre" style="display: none;">Escriba un nombre valido para el tratamiento</small>
        </div>

        <div class="col-md-12" style="display:inline-flex; padding: 0">

        <div class="col-md-6 form-group">
          <label class="form-control-label" for="dosis">Dosis</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-folder-17"></i></span>
              </div>
          <input class="form-control" type="text" name="dosis" id="dosis" value="<?php echo set_value("dosis",isset($dosis)?$dosis:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Dosis o unidades del tratamiento">
            </div>
          <small class="text-danger" id="errorDosis" style="display: none;">Escriba información valida</small>
        </div>

        <div class="col-md-6 form-group">
          <label class="form-control-label" for="duracion">Duración del tratamiento (días)</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-folder-17"></i></span>
              </div>
          <input class="form-control" type="number" name="duracion" id="duracion" value="<?php echo set_value("duracion",isset($duracion)?$duracion:""); ?>" step="1" <?php if($soloLectura) echo "readonly"; ?> placeholder="Duración en días del tratamiento">
            </div>
          <small class="text-danger" id="errorDuracion" style="display: none;">Escriba información valida</small>
        </div>


        </div>

        <div class="col-md-6 form-group">
          <label class="form-control-label" for="administracion">Forma de administración</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-time-alarm"></i></span>
              </div>
          <select class="form-control" type="text" name="administracion" id="administracion" value="<?php echo set_value("administracion",isset($administracion)?$administracion:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Escriba información valida">
            <option value="pastilla">pastilla</option>
            <option value="solución">solución</option>
            <option value="inyección">inyección</option>
            <option value="polvo">polvo</option>
            <option value="gotas">gotas</option>
            <option value="inhalador">inhalador</option>
            <option value="pomada">pomada</option>
            <option value="espuma">espuma</option>
            <option value="spray">spray</option>
          </select> 
            </div>
          <small class="text-danger" id="errorAdministracion" style="display: none;"></small>
        </div>

        <div class="col-md-6 form-group">
          <label class="form-control-label" for="fecha">Fecha</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-time-alarm"></i></span>
              </div>
          <input class="form-control" type="text" name="fecha" id="fecha" value="<?php echo set_value("fecha",isset($fecha)?$fecha:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Escriba la fecha de la toma de datos DD/MM/AAAA">
            </div>
          <small class="text-danger" id="errorFecha" style="display: none;">Escriba una fecha valida DD/MM/AAAA</small>
        </div>



    </div>

  <?php if(!$soloLectura): ?>
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-4 form-group">
        <input type="button" class="form-control btn btn-primary rounded-pill" value="<?php echo $titulo; ?>" <?php echo ($editar?"onClick='editarTratamiento()'":"onClick='agregarTratamiento()'"); ?> >
      </div>
      <div class="col-md-2"></div>
      <div class="col-md-4 form-group">
        <input type="regresar" class="form-control btn btn-success rounded-pill" value="Regresar" onclick="window.history.back();">
      </div>
      <div class="col-md-1"></div>
    </div>
  <?php else: ?>
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4 form-group">
        <input type="regresar" class="form-control btn btn-success rounded-pill" value="Regresar" onclick="window.history.back();">
      </div>
      <div class="col-md-4"></div>
    </div>
  <?php endif; ?>

  </form>

</div>
<!-- /.container -->

<script type="text/javascript">


<?php if($soloLectura || $editar): ?>
  leerTratamiento();

  function leerTratamiento(){
    validaSesionfirebase("<?php $usuarioLogeado ?>");
    var referencia = db.collection("usuarios").doc("<?php echo $idFirestore ?>").collection("tratamientos").doc("<?php echo $idTratamiento ?>");

    referencia.get().then((documento) => {
      // Se revisa que el documento exista
      if(documento.exists){
        $("#nombre").val(documento.data().nombre);
        $("#dosis").val(documento.data().dosis);
        $("#duracion").val(documento.data().duracion);
        $("#fecha").val(documento.data().fecha);
        $("#administracion").val(documento.data().administracion);
      }
      else{
        alert("El documento <?php echo $idTratamiento ?> no existe");
      }
    })
    .catch((error) => {
        alert("Error obteniendo el documento: " + error);
    });
  }
<?php endif; ?>

<?php if(!$soloLectura && $editar): ?>

  function editarTratamiento(){
    validaSesionfirebase("<?php $usuarioLogeado ?>");

    dosis = $("#dosis").val();
    nombre = $("#nombre").val();
    duracion = $("#duracion").val();
    fecha = $("#fecha").val();
    administracion = $("#administracion").val();

    let regNumbers = /^\d+$/;
    let regLetters = /^[a-zA-Z]+$/;
    let regexTime = /^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/;
    let regexDate = /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/;

    error = false;

    if(dosis == "" || dosis<1){
      $("#errorDosis").css("display","block");
      error = true;
    }
    else{
      $("#errorDosis").css("display","none");
      if(!error)
        error = false;
    }

    if(nombre == "" || nombre<1){
      $("#errorNombre").css("display","block");
      error = true;
    }
    else{
      $("#errorNombre").css("display","none");
      if(!error)
        error = false;
    }

    if(duracion == "" || regNumbers.test(duracion) != true){
      $("#errorDuracion").css("display","block");
      error = true;
    }
    else{
      $("#errorDuracion").css("display","none");
      if(!error)
        error = false;
    }

    if(administracion == "" || regLetters.test(administracion) != true){
      $("#errorAdministracion").css("display","block");
      error = true;
    }
    else{
      $("#errorAdministracion").css("display","none");
      if(!error)
        error = false;
    }

    if(fecha == "" || regexDate.test(fecha) != true){
      $("#errorFecha").css("display","block");
      error = true;
    }
    else{
      $("#errorFecha").css("display","none");
      if(!error)
        error = false;
    }

    if(error)
      return;

    var dosisUpdate = db.collection("usuarios").doc("<?php echo $idFirestore ?>").collection("tratamientos").doc("<?php echo $idTratamiento ?>");

      // Set the "capital" field of the city 'DC'
      return dosisUpdate.update({
        nombre: nombre,
        dosis: dosis,
        duracion: duracion,
        fecha: fecha,
        administracion: administracion,
      })
      .then(() => {
        alert("Datos de usuario actualizados exitosamente");
        location.href = "<?php echo base_url()."index.php/paciente/editarPaciente?id=".$idFirestore; ?>";

      })
      .catch((error) => {
          // The document probably doesn't exist.
          alert("Error editando el documento: " + error);
      });
  }

<?php elseif(!$soloLectura): ?>
  function agregarTratamiento(){
    validaSesionfirebase("<?php $usuarioLogeado ?>");
    dosis = $("#dosis").val();
    nombre = $("#nombre").val();
    duracion = $("#duracion").val();
    fecha = $("#fecha").val();
    administracion = $("#administracion").val();

    let regNumbers = /^\d+$/;
    let regexTime = /^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/;
    let regexDate = /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/;
    let regLetters = /^[a-zA-Z]+$/;

    error = false;

    if(dosis == "" || dosis<1){
      $("#errorPeso").css("display","block");
      error = true;
    }
    else{
      $("#errorPeso").css("display","none");
      if(!error)
        error = false;
    }

    if(nombre == "" || nombre<1){
      $("#errorNombre").css("display","block");
      error = true;
    }
    else{
      $("#errorNombre").css("display","none");
      if(!error)
        error = false;
    }

    if(duracion == "" || regNumbers.test(duracion) != true){
      $("#errorDuracion").css("display","block");
      error = true;
    }
    else{
      $("#errorDuracion").css("display","none");
      if(!error)
        error = false;
    }

    if(administracion == "" || regLetters.test(administracion) != true){
      $("#errorAdministracion").css("display","block");
      error = true;
    }
    else{
      $("#errorAdministracion").css("display","none");
      if(!error)
        error = false;
    }

    if(fecha == "" || regexDate.test(fecha) != true){
      $("#errorFecha").css("display","block");
      error = true;
    }
    else{
      $("#errorFecha").css("display","none");
      if(!error)
        error = false;
    }

    if(error)
      return;

    db.collection("usuarios").doc("<?php echo $idFirestore ?>").collection("tratamientos").add({
        nombre: nombre,
        dosis: dosis,
        duracion: duracion,
        fecha: fecha,
        administracion: administracion,
    })
    .then((documento) => {
        //alert("Se escribió el documento con el ID: " + documento.id);
        //console.log("El objeto es: %o", documento);
        location.href = "<?php echo base_url()."index.php/paciente/editarPaciente?id=".$idFirestore; ?>";
    })
    .catch((error) => {
        alert("Error agregando el documento: " + error);
    });
  }

<?php endif; ?>

</script>





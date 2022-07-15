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
          <label class="form-control-label" for="idFirestore">ID del modulo</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-folder-17"></i></span>
              </div>
          <input type="text" name="idFirestore" id="idFirestore" required class="form-control" value="<?php echo set_value("idFirestore",isset($idFirestore)?$idFirestore:""); ?>" readonly>
            </div>
          <small class="text-danger" id="errorId" style="display: none;">Escriba el id</small>
        </div>
      <?php endif; ?>      

        <div class="col-md-12 form-group">
          <label class="form-control-label" for="nombre">Nombre del modulo</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-folder-17"></i></span>
              </div>
          <input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo set_value("nombre",isset($nombre)?$nombre:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Nombre del modulo">
            </div>
          <small class="text-danger" id="errorNombre" style="display: none;">Escriba un nombre valido</small>
        </div>

        <div class="col-md-12 form-group">
          <label class="form-control-label" for="estatus">Estatus</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-folder-17"></i></span>
              </div>
          <select class="form-control" name="estatus" id="estatus" <?php if($soloLectura) echo "readonly"; ?>>
            <option value="habilitado" <?php if(isset($estatus) && $estatus == "habilitado") echo "selected"; ?>>Habilitado</option>
            <option value="inhabilitado" <?php if(isset($estatus) && $estatus == "inhabilitado") echo "selected"; ?>>Inhabilitado</option>
          </select>
            </div>
          <small class="text-danger" id="errorHabilitado" style="display: none;">Escriba información valida</small>
        </div>
    </div>

  <?php if(!$soloLectura): ?>
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-4 form-group">
        <input type="button" class="form-control btn btn-primary " value="<?php echo $titulo; ?>" <?php echo ($editar?"onClick='editarModulo()'":"onClick='agregarModulo()'"); ?> >
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
  leeLugar();

  function leeLugar(){
    validaSesionfirebase("<?php $usuarioLogeado ?>");

    var referencia = db.collection("modulos").doc("<?php echo $idFirestore ?>");
    referencia.get().then((documento) => {
      // Se revisa que el documento exista
      if(documento.exists){
        $("#nombre").val(documento.data().nombre);
        $("#estatus").val(documento.data().habilitado);

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
  function editarModulo(){
    validaSesionfirebase("<?php $usuarioLogeado ?>");

    nombre = $("#nombre").val();
    estatus = $("#estatus").val();

    error = false;
    if(nombre == ""){
      $("#errorNombre").css("display","block");
      error = true;
    }
    else{
      $("#errorNombre").css("display","none");
      if(!error)
        error = false;
    }

    if(estatus == ""){
      $("#errorHabilitado").css("display","block");
      error = true;
    }
    else{
      $("#errorHabilitado").css("display","none");
      if(!error)
        error = false;
    }

    if(error)
      return;

    db.collection("modulos").doc("<?php echo $idFirestore ?>").set({
        nombre: nombre,
        habilitado: estatus
    })
    .then((documento) => {
        //alert("Se escribió el documento con el ID: " + documento.id);
        //console.log("El objeto es: %o", documento);
        location.href = "<?php echo base_url()."index.php/modulo/index"; ?>";
    })
    .catch((error) => {
        alert("Error editando el documento: " + error);
    });
  }
<?php elseif(!$soloLectura): ?>
  function agregarModulo(){
    validaSesionfirebase("<?php $usuarioLogeado ?>");

    nombre = $("#nombre").val();
    estatus = $("#estatus").val();

    error = false;
    if(nombre == ""){
      $("#errorNombre").css("display","block");
      error = true;
    }
    else{
      $("#errorNombre").css("display","none");
      if(!error)
        error = false;
    }

    if(estatus == ""){
      $("#errorHabilitado").css("display","block");
      error = true;
    }
    else{
      $("#errorHabilitado").css("display","none");
      if(!error)
        error = false;
    }

    if(error)
      return;

    db.collection("modulos").add({
        nombre: nombre,
        habilitado: estatus
    })
    .then((documento) => {
        //alert("Se escribió el documento con el ID: " + documento.id);
        //console.log("El objeto es: %o", documento);
        location.href = "<?php echo base_url()."index.php/modulo/index"; ?>";
    })
    .catch((error) => {
        alert("Error agregando el documento: " + error);
    });
  }

<?php endif; ?>

</script>





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
          <label class="form-control-label" for="idFirestore">ID del medicamento</label>
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
          <label class="form-control-label" for="nombre">Nombre del medicamento</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-folder-17"></i></span>
              </div>
          <input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo set_value("nombre",isset($nombre)?$nombre:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Nombre del medicamento">
            </div>
          <small class="text-danger" id="errorNombre" style="display: none;">Escriba un nombre valido</small>
        </div>

        <div class="col-md-12 form-group">
          <label class="form-control-label" for="presentacion">Presentación/Tipo</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-folder-17"></i></span>
              </div>
          <input class="form-control" type="text" name="presentacion" id="presentacion" value="<?php echo set_value("presentacion",isset($presentacion)?$presentacion:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Tipo / presentación del medicamento">
            </div>
          <small class="text-danger" id="errorTipo" style="display: none;">Escriba información valida</small>
        </div>
    </div>

  <?php if(!$soloLectura): ?>
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-4 form-group">
        <input type="button" class="form-control btn btn-primary " value="<?php echo $titulo; ?>" <?php echo ($editar?"onClick='editarMedicamento()'":"onClick='agregarMedicamento()'"); ?> >
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


<script type="text/javascript">

<?php if($soloLectura || $editar): ?>
  leeLugar();

  function leeLugar(){
    validaSesionfirebase("<?php $usuarioLogeado ?>");

    var referencia = db.collection("medicamentos").doc("<?php echo $idFirestore ?>");
    referencia.get().then((documento) => {
      // Se revisa que el documento exista
      if(documento.exists){
        $("#nombre").val(documento.data().nombre);
        $("#presentacion").val(documento.data().presentacion);

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
  function editarMedicamento(){
    validaSesionfirebase("<?php $usuarioLogeado ?>");

    nombre = $("#nombre").val();
    presentacion = $("#presentacion").val();

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

    if(presentacion == ""){
      $("#errorTipo").css("display","block");
      error = true;
    }
    else{
      $("#errorTipo").css("display","none");
      if(!error)
        error = false;
    }

    if(error)
      return;

    db.collection("medicamentos").doc("<?php echo $idFirestore ?>").set({
        nombre: nombre,
        presentacion: presentacion
    })
    .then((documento) => {
        //alert("Se escribió el documento con el ID: " + documento.id);
        //console.log("El objeto es: %o", documento);
        location.href = "<?php echo base_url()."index.php/medicamento/index"; ?>";
    })
    .catch((error) => {
        alert("Error editando el documento: " + error);
    });
  }
<?php elseif(!$soloLectura): ?>
  function agregarMedicamento(){
    validaSesionfirebase("<?php $usuarioLogeado ?>");

    nombre = $("#nombre").val();
    presentacion = $("#presentacion").val();

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

    if(presentacion == ""){
      $("#errorTipo").css("display","block");
      error = true;
    }
    else{
      $("#errorTipo").css("display","none");
      if(!error)
        error = false;
    }

    if(error)
      return;

    db.collection("medicamentos").add({
        nombre: nombre,
        presentacion: presentacion
    })
    .then((documento) => {
        //alert("Se escribió el documento con el ID: " + documento.id);
        //console.log("El objeto es: %o", documento);
        location.href = "<?php echo base_url()."index.php/medicamento/index"; ?>";
    })
    .catch((error) => {
        alert("Error agregando el documento: " + error);
    });
  }

<?php endif; ?>

</script>





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
          <label class="form-control-label" for="idAntecedente">ID del registro</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-book-bookmark"></i></span>
              </div>
          <input type="text" name="idAntecedente" id="idAntecedente" required class="form-control" value="<?php echo set_value("idAntecedente",isset($idAntecedente)?$idAntecedente:""); ?>" readonly>
            </div>
          <small class="text-danger" id="errorId" style="display: none;">Escriba el id</small>
        </div>

      <?php endif; ?>      

        <div class="col-md-12 form-group">
          <label class="form-control-label" for="procedimiento">Procedimiento médico</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-folder-17"></i> </span>
              </div>
          <input type="text" name="procedimiento" id="procedimiento" required class="form-control" value="<?php echo set_value("procedimiento",isset($procedimiento)?$procedimiento:""); ?>" placeholder="Nombre del procedimiento medico" <?php if($soloLectura) echo "readonly"; ?>>
            </div>
          <small class="text-danger" id="errorAntecedente" style="display: none;">Escriba un nombre valido</small>
        </div>
        
        <div class="col-md-12 form-group">
          <label class="form-control-label" for="enfermedad">Nombre de la enfermedad</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-folder-17"></i> </span>
              </div>
          <input type="text" name="enfermedad" id="enfermedad" required class="form-control" value="<?php echo set_value("enfermedad",isset($enfermedad)?$enfermedad:""); ?>" placeholder="Nombre de la enfermedad" <?php if($soloLectura) echo "readonly"; ?>>
            </div>
          <small class="text-danger" id="errorAntecedente" style="display: none;">Escriba un nombre valido</small>
        </div>

        <div class="col-md-12 form-group">
          <label class="form-control-label" for="fecha">Fecha de diagnostico / fecha del procedimiento</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-time-alarm"></i></span>
              </div>
          <input class="form-control" type="text" name="fecha" id="fecha" value="<?php echo set_value("fecha",isset($fecha)?$fecha:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Escriba la fecha en que se diagnostico DD/MM/AAAA">
            </div>
          <small class="text-danger" id="errorFecha" style="display: none;">Escriba una fecha valida DD/MM/AAAA</small>
        </div>

        <div class="col-md-12 form-group">
          <label class="form-control-label" for="tratamiento">Tratamiento</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-folder-17"></i> </span>
              </div>
          <input type="text" name="tratamiento" id="tratamiento" required class="form-control" value="<?php echo set_value("tratamiento",isset($tratamiento)?$tratamiento:""); ?>" placeholder="Nombre o descripción del tratamiento" <?php if($soloLectura) echo "readonly"; ?>>
            </div>
          <small class="text-danger" id="errorTratamiento" style="display: none;">Escriba un tratamiento valido</small>
        </div>     

    </div>

  <?php if(!$soloLectura): ?>
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-4 form-group">
        <input type="button" class="form-control btn btn-primary " value="<?php echo $titulo; ?>" <?php echo ($editar?"onClick='editarAntecedente()'":"onClick='agregarAntecedente()'"); ?> >
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
  leerAntecedente();

  function leerAntecedente(){
    validaSesionfirebase("<?php $usuarioLogeado ?>");
    var referencia = db.collection("usuarios").doc("<?php echo $idFirestore ?>").collection("antecedentes").doc("<?php echo $idAntecedente ?>");

    referencia.get().then((documento) => {
      // Se revisa que el documento exista
      if(documento.exists){
        $("#procedimiento").val(documento.data().procedimiento);
        $("#enfermedad").val(documento.data().enfermedad);
        $("#fecha").val(documento.data().fecha);
        $("#tratamiento").val(documento.data().tratamiento);
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
  function editarAntecedente(){
    validaSesionfirebase("<?php $usuarioLogeado ?>");

      procedimiento = $("#procedimiento").val();
      fecha = $("#fecha").val();
      enfermedad = $("#enfermedad").val();
      tratamiento = $("#tratamiento").val();
    
    error = false;
    
    if(enfermedad == "" && procedimiento == ""){
      $("#errorAntecedente").css("display","block");
      error = true;
    }
    else{
      $("#errorAntecedente").css("display","none");
      if(!error)
        error = false;
    }

    if(fecha == ""){
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


    var antecedenteUpdate = db.collection("usuarios").doc("<?php echo $idFirestore ?>").collection("antecedentes").doc("<?php echo $idAntecedente ?>");

      // Set the "capital" field of the city 'DC'
      return antecedenteUpdate.update({
        procedimiento: procedimiento,
        enfermedad: enfermedad,
        fecha: fecha,
        tratamiento: tratamiento
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
  function agregarAntecedente(){
    validaSesionfirebase("<?php $usuarioLogeado ?>");

    procedimiento = $("#procedimiento").val();
    fecha = $("#fecha").val();
    enfermedad = $("#enfermedad").val();
    tratamiento = $("#tratamiento").val();
    
    error = false;
    
    if(enfermedad == "" && procedimiento == ""){
      $("#errorAntecedente").css("display","block");
      error = true;
    }
    else{
      $("#errorAntecedente").css("display","none");
      if(!error)
        error = false;
    }

    if(fecha == ""){
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

    db.collection("usuarios").doc("<?php echo $idFirestore ?>").collection("antecedentes").add({
        procedimiento: procedimiento,
        enfermedad: enfermedad,
        fecha: fecha,
        tratamiento: tratamiento
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





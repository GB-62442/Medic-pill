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
          <label class="form-control-label" for="idControlPeso">ID del registro</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-book-bookmark"></i></span>
              </div>
          <input type="text" name="idControlPeso" id="idControlPeso" required class="form-control" value="<?php echo set_value("idControlPeso",isset($idControlPeso)?$idControlPeso:""); ?>" readonly>
            </div>
          <small class="text-danger" id="errorId" style="display: none;">Escriba el id</small>
        </div>

      <?php endif; ?>      

        <div class="col-md-12 form-group">
          <label class="form-control-label" for="estatura">Estatura (cm)</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-folder-17"></i></span>
              </div>
          <input class="form-control" type="number" name="estatura" id="estatura" value="<?php echo set_value("estatura",isset($estatura)?$estatura:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Estatura en cm">
            </div>
          <small class="text-danger" id="errorEstatura" style="display: none;">Escriba una estatura valida</small>
        </div>

        <div class="col-md-12 form-group">
          <label class="form-control-label" for="peso">Peso (kg)</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-folder-17"></i></span>
              </div>
          <input class="form-control" type="number" name="peso" id="peso" value="<?php echo set_value("peso",isset($peso)?$peso:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Peso en kg">
            </div>
          <small class="text-danger" id="errorPeso" style="display: none;">Escriba un peso valido</small>
        </div>

        <div class="col-md-12 form-group">
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
        <input type="button" class="form-control btn btn-primary " value="<?php echo $titulo; ?>" <?php echo ($editar?"onClick='editarPeso()'":"onClick='agregarPeso()'"); ?> >
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
  leerPeso();

  function leerPeso(){
    validaSesionfirebase("<?php $usuarioLogeado ?>");

    var referencia = db.collection("usuarios").doc("<?php echo $idFirestore ?>").collection("pesos").doc("<?php echo $idControlPeso ?>");

    referencia.get().then((documento) => {
      // Se revisa que el documento exista
      if(documento.exists){
        $("#estatura").val(documento.data().estatura);
        $("#peso").val(documento.data().peso);
        $("#fecha").val(documento.data().fecha);

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
  function editarPeso(){
    validaSesionfirebase("<?php $usuarioLogeado ?>");
    
    let regex2dot3 = /^(?!\.?$)\d{0,5}(\.\d{0,2})?$/;
    let regexDate = /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/;

    peso = $("#peso").val();
    estatura = $("#estatura").val();
    fecha = $("#fecha").val();
    fecha = fecha.replaceAll('/', '-');

    error = false;
    if(peso == "" || peso<1 || regex2dot3.test(peso) != true){
      $("#errorPeso").css("display","block");
      error = true;
    }
    else{
      $("#errorPeso").css("display","none");
      if(!error)
        error = false;
    }

    if(estatura == "" || estatura<1 || regex2dot3.test(estatura) != true){
      $("#errorEstatura").css("display","block");
      error = true;
    }
    else{
      $("#errorEstatura").css("display","none");
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


    var pesoUpdate = db.collection("usuarios").doc("<?php echo $idFirestore ?>").collection("pesos").doc("<?php echo $idControlPeso ?>");
      return pesoUpdate.update({
        estatura: estatura,
        peso: peso,
        fecha: fecha,
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
  function agregarPeso(){
    validaSesionfirebase("<?php $usuarioLogeado ?>");

    peso = $("#peso").val();
    estatura = $("#estatura").val();
    fecha = $("#fecha").val();
    fecha = fecha.replaceAll('/', '-');

    let regex2dot3 = /^(?!\.?$)\d{0,5}(\.\d{0,2})?$/;
    let regexDate = /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/;

    error = false;
    if(peso == "" || peso<1 || regex2dot3.test(peso) != true){
      $("#errorPeso").css("display","block");
      error = true;
    }
    else{
      $("#errorPeso").css("display","none");
      if(!error)
        error = false;
    }

    if(estatura == "" || estatura<1 || regex2dot3.test(estatura) != true){
      $("#errorEstatura").css("display","block");
      error = true;
    }
    else{
      $("#errorEstatura").css("display","none");
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

    db.collection("usuarios").doc("<?php echo $idFirestore ?>").collection("pesos").add({
        estatura: estatura,
        peso: peso,
        fecha: fecha,
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





<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Page Content -->
<div class="container">

  <!-- Page Heading -->
  <h1 class="my-4"><?php echo $titulo; ?></h1>

  <form action="<?php echo base_url(); ?>index.php/permisos/muestraPermisos" method="get" id="formaBusqueda">
    <div class="row">
        <div class="col-md-12 form-group">
          <label class="form-control-label" for="nombreUsuario">ID del usuario</label>
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
              </div>
          <input type="text" name="nombreUsuario" id="nombreUsuario" required class="form-control" value="<?php echo set_value("nombreUsuario",isset($nombreUsuario)?$nombreUsuario:""); ?>" readonly>
            </div>
          <small class="text-danger" id="errorId" style="display: none;">Escriba el id</small>
        </div>
    </div>
    <div class="row">
      <div class="col-md-2 form-group"></div>
      <div class="col-md-4 form-group">
        <input type="submit" class="form-control btn btn-primary" value="Buscar">
      </div>
      <div class="col-md-4 form-group">
        <input type="button" class="btn btn-danger btn-block" value="Reiniciar forma" id="reiniciar" name="reiniciar" onclick="borrarForma()">
      </div>
      <div class="col-md-2 form-group"></div>
    </div>
  </form>

  <div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
        <div id="tablaFirestore"></div>
      </div>
    <!-- table-responsive -->
    </div>
  </div>
  <!-- /.row -->

  <!-- Pagination -->
  <?php if(isset($paginacion)) echo $paginacion; ?>

  </div>
    <!-- /.container -->

  <script type="text/javascript">

  function leeDatosFirestore(){
    var nombre = $("#nombreUsuario").val();

    var referencia = db.collection("medicos").doc("<?php echo $idFirestore ?>").collection("permisos");
      // Le decimos a Firestore de que colección queremos obtener los datos
      referencia.get().then(function(datosRecibidos){

        muestraDatos(datosRecibidos);
      })
      .catch(function(error){
        alert("Error al leer los datos de Firestore");
      });
    }

    function muestraDatos(datosRecibidos){
      var tabla =  "<table class='table'>" +
      "<thead class='thead-dark'>" +
      "<tr>" +
      "<th>Nombre de usuario</th>" +
      "<th>Módulo</th>" +
      "<th>Altas</th>" +
      "<th>Bajas</th>" +
      "<th>Consultas</th>" +
      "<th>Cambios</th>" +
      "</tr>" +
      "</thead>" +
      "<tbody>";
      // Cada uno de los datos recibidos se van pegando a la tabla
      datosRecibidos.forEach((documento) => {

        tabla += "<tr class='info'>" + 
        "<td><?php echo $idFirestore ?></td>" +
        "<td>" + documento.id  + "</td>" +
        "<td><div class='form-group'>" +
        "<input type='checkbox' onclick='actualizar(this.id)' id='altas-{<?php echo $idFirestore ?>}-{" + documento.id + "}-{" + documento.id + "}' ";
         if(documento.data().altas){tabla += 'checked';} 
          tabla += " " + "></div></td>" +
        "<td><div class='form-group'>" + 
        "<input type='checkbox' onclick='actualizar(this.id)' id='bajas-{<?php echo $idFirestore ?>}-{"+ documento.id +"}-{" + documento.id + "}'";
        if(documento.data().bajas){tabla += 'checked';} 
         tabla += " " + documento.data().bajas + "></div></td>" +
        "<td><div class='form-group'>" + 
        "<input type='checkbox' onclick='actualizar(this.id)' id='consultas-{<?php echo $idFirestore ?>}-{" + documento.id + "}-{" + documento.id + "}' ";
        if(documento.data().consultas){tabla += 'checked';} 
         tabla += " " + documento.data().consultas + "></div></td>" +
        "<td><div class='form-group'>" + 
        "<input type='checkbox' onclick='actualizar(this.id)' id='cambios-{<?php echo $idFirestore ?>}-{"+ documento.id +"}-{" + documento.id + "}'";
          if(documento.data().cambios){tabla += 'checked';} 
          tabla += " " + documento.data().cambios + "></div></td></tr>";

      });
      tabla += "</tbody>" +
      "</table>"; 

      // Buscamos dento de nuestro documento tablaFirestore y le pegamos el string
      // que acabamos de generar
      document.getElementById("tablaFirestore").innerHTML = tabla;
    }

    var timer; 

    function comienzaEjecucion() { 
      timer = setInterval(function() {  
        leeDatosFirestore();
      }, 60000); 
    }

  // Se ejecuta una vez
  leeDatosFirestore();

  // Luego cada minuto actualiza la información
  comienzaEjecucion();  


  function editarFirebase(idFirestore){
    location.href="<?php echo base_url()."index.php/medicamento/editarMedicamento?id="; ?>" + idFirestore;
  }

  function borrarFirestore(idFirestore){
    db.collection("medicamentos").doc(idFirestore).delete().then(() => {
      leeDatosFirestore();
      enviaAlerta("Borrar","Se eliminó el documento " + idFirestore);
    })
    .catch((error) => {
      alert("Error agregando el documento: " + error);
    });
  }  

  function actualizar(username){
    var estatus = document.getElementById(username).checked;

    var datos = username.split("-");
    var accion = datos[0];
    var user = datos[1];
    var modulo = datos[2].replace(/^\{+|\}+$/g, '');;

    //enviaAlerta ("titulo","estatus: " + estatus + " ,accion: " + accion + " ,usr: " + user + " ,mod: " + modulo);

    var usuarioUpdate = db.collection("medicos").doc("<?php echo $idFirestore ?>").collection("permisos").doc(modulo);

      return usuarioUpdate.update({[accion]: estatus})
      .then(() => {
        enviaAlerta ("Actualizar", "Permisos de usuario actualizados exitosamente ");
          leeDatosFirestore();
      })
      .catch((error) => {
          // The document probably doesn't exist.
          alert("Error editando el documento: " + error);
      });
  }

</script>


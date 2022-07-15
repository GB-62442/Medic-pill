<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$latitud = LAT_CENTRAL;
$longitud = LNG_CENTRAL;

$coordenadas = "{ lat: $latitud, lng: $longitud }";

?>

<script type="text/javascript">
  function borrarLugar(idFirestore=""){
    if (confirm('¿Esta seguro que quiere borrar al médico con el id'+ idFirestore + '?')) {
      borrarFirestore(idFirestore);
    } 
  }
</script>

<!-- Page Content -->
<div class="container">

  <!-- Page Heading -->
  <h1 class="my-4"><?php echo $titulo; ?></h1>

  <form id="formaBusqueda">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="nombres">Nombre (s)</label>
          <input type="text" name="nombres" id="nombres" class="form-control form-control-sm" value="<?php echo set_value("nombres"); ?>" placeholder="Busqueda por nombre">
          <small class="text-danger"><?php echo form_error("nombres");?></small>
        </div>

        <div class="form-group">
          <label for="apellidos">Apellido (s)</label>
          <input type="text" name="apellidos" id="apellidos" class="form-control form-control-sm" value="<?php echo set_value("apellidos"); ?>" placeholder="Busqueda por apellidos">
          <small class="text-danger"><?php echo form_error("apellidos");?></small>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="telefono">Télefono</label>
          <input type="text" name="telefono" id="telefono" class="form-control form-control-sm" value="<?php echo set_value("telefono"); ?>" placeholder="Busqueda por número telefonico">
          <small class="text-danger"><?php echo form_error("telefono");?></small>
        </div>

        <div class="form-group">
          <label for="especialidad">Especialidad</label>
          <input type="text" name="especialidad" id="especialidad" class="form-control form-control-sm" value="<?php echo set_value("especialidad"); ?>" placeholder="Busqueda por especialidad">
          <small class="text-danger"><?php echo form_error("especialidad");?></small>
        </div>
      </div>

    </div>
    <div class="row">
      <div class="col-md-2 form-group"></div>
      <div class="col-md-4 form-group">
        <input type="button" onclick="leeDatosFirestore();" class="form-control btn btn-primary" value="Buscar">
      </div>
      <div class="col-md-4 form-group">
        <input type="button" class="btn btn-danger btn-block" value="Reiniciar forma" id="reiniciar" name="reiniciar" onclick="borrarForma()">
      </div>
      <div class="col-md-2 form-group"></div>
    </div>
  </form>

    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4 form-group">
        <button class="form-control btn btn-success" onclick="location.href='<?php echo base_url(); ?>index.php/medico/agregarMedico'">Agregar médico</button>
      </div>
      <div class="col-md-4"></div>
    </div>

  <div id="tablaFirestore" class="table-responsive"></div>



</div>
<!-- /.container -->

  <script type="text/javascript">

  function leeDatosFirestore(){
    validaSesionfirebase("<?php $usuarioLogeado ?>");

    var nombre = $("#nombres").val();
    var apellido = $("#apellidos").val();
    var especialidad = $("#especialidad").val();
    var telefono = $("#telefono").val();

    var referencia = db.collection("medicos");

    if(nombre != ""){
      referencia = referencia.where("nombres", "==", nombre);
    }
    else if(apellido != ""){
      referencia = referencia.where("apellidos", "==", apellido);
    }
    else if(telefono != ""){
      referencia = referencia.where("telefono", "==", telefono);
    }
    else if(especialidad != ""){
      referencia = referencia.where("especialidad", "==", especialidad);
    }

      // Le decimos a Firestore de que colección queremos obtener los datos
      referencia.get().then(function(datosRecibidos){

        muestraDatos(datosRecibidos);
      })
      .catch(function(error){
        alert("Error al leer los datos de Firestore");
      });
  }

  function muestraDatos(datosRecibidos){
 
     var tabla = "<table class='table'>" +
      "<thead class='thead-dark'>" +
      "<tr>" +
      "<th>Id</th>" +
      "<th>Nombre (s)</th>" +
      "<th>Apellidos (s)</th>" +
      "<th>Teléfono</th>" +
      "<th>Especialidad</th>" +
      "<th>No. Cédula</th>" +
      "<th>Acciones</th>" +
      "<tr>" +  
      "</thead>" +
      "<tbody>";
      // Cada uno de los datos recibidos se van pegando a la tabla
      datosRecibidos.forEach((documento) => {

        tabla += "<tr>" +
        "<td>" + documento.id + "</td>" +
        "<td>" + documento.data().nombres + "</td>" +
        "<td>" + documento.data().apellidos + "</td>" +
        "<td>" + documento.data().telefono + "</td>" +
        "<td>" + documento.data().especialidad + "</td>" +
        "<td>" + documento.data().cedula + "</td>" +

        "<td class='text-right'>"+
        "<div class='dropdown'>" +
        "<a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" +
        "<i class='fas fa-ellipsis-v'></i>" +
        "</a>" +
        "<div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>" +

        "<span class='dropdown-item' onclick=editarFirebase('" + documento.id + "'); >Editar</span>" + 

        "<span class='dropdown-item' onclick=borrarFirebase('" + documento.id + "'); >Borrar</span>" + 

        "</div>" +
        "</div>" +
        "</td>" +
        "</tr>";
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
      }, 5000); 
  }
  
  // Se ejecuta una vez
  leeDatosFirestore();

  // Luego cada 5 segundos actualiza la información
  comienzaEjecucion();  


  function editarFirebase(idFirestore){
    validaSesionfirebase("<?php $usuarioLogeado ?>");
    location.href="<?php echo base_url()."index.php/medico/editarMedico?id="; ?>" + idFirestore;
  }

  function borrarFirebase(idFirestore){
    validaSesionfirebase("<?php $usuarioLogeado ?>");

    db.collection("medicos").doc(idFirestore).delete().then(() => {
      leeDatosFirestore();
      enviaAlerta("Borrar","Se eliminó el documento " + idFirestore);
    })
    .catch((error) => {
      alert("Error agregando el documento: " + error);
    });
  }

  function permisosFirebase(idFirestore){
    validaSesionfirebase("<?php $usuarioLogeado ?>");
    location.href="<?php echo base_url()."index.php/permisos/muestraPermisos?id="; ?>" + idFirestore;
  }   
 

</script>







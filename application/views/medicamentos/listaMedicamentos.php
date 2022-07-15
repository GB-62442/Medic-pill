<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script type="text/javascript">
  function borrarLugar(idFirestore=""){
    if (confirm('¿Esta seguro que quiere borrar al medicamento con el id'+ idFirestore + '?')) {
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
      <div class="col-md-6 form-group">
        <label for="nombre">Nombre medicamento</label>
        <input type="text" name="nombre" id="nombre" class="form-control form-control-sm " value="<?php echo set_value("nombre"); ?>">
        <small class="text-danger"><?php echo form_error("nombre");?></small>
      </div>

      <div class="col-md-6 form-group">
        <label for="tipo">Tipo / presentación</label>
        <input type="text" name="tipo" id="tipo" class="form-control form-control-sm " value="<?php echo set_value("tipo"); ?>">
        <small class="text-danger"><?php echo form_error("tipo");?></small>
      </div>
    </div>
    <div class="row">
      <div class="col-md-2 form-group"></div>
      <div class="col-md-4 form-group">
        <input type="button" onclick="leeDatosFirestore();" class="form-control btn btn-primary " value="Buscar">
      </div>
      <div class="col-md-4 form-group">
        <input type="button" class="btn btn-danger btn-block " value="Reiniciar forma" id="reiniciar" name="reiniciar" onclick="borrarForma()">
      </div>
      <div class="col-md-2 form-group"></div>
    </div>
  </form>


  
  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4 form-group">
      <button class="form-control btn btn-success " onclick="location.href='<?php echo base_url(); ?>index.php/medicamento/agregarMedicamento'">Agregar medicamento</button>
    </div>
    <div class="col-md-4"></div>
  </div>
  

    <div id="tablaFirestore" class="table-responsive"></div>
    <div class="row">
    </div>


</div>
<!-- /.container -->

<script type="text/javascript">

  function leeDatosFirestore(){
    validaSesionfirebase("<?php $usuarioLogeado ?>");

    var nombre = $("#nombre").val();
    var tipo = $("#tipo").val();

    var referencia = db.collection("medicamentos");

    if(nombre != ""){
      referencia = referencia.where("nombre", "==", nombre);
    }
    else if(tipo != ""){
      referencia = referencia.where("presentacion", "==", tipo);
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
    // Le decimos a Firestore de que colección queremos obtener los datos
      // Para que el mapa se ajuste a las coordenadas recibidas
      var tabla = "<table class='table'>" +
                    "<thead class='thead-dark'>" +
                      "<tr>" +
                        "<th>Id</th>" +
                        "<th>Nombre del medicamento</th>" +
                        "<th>Presentación/Tipo</th>" +
                        "<th colspan='2' class='text-center'>Acciones</th>" +
                      "<tr>" +  
                    "</thead>" +
                    "<tbody>";
      // Cada uno de los datos recibidos se van pegando a la tabla
      datosRecibidos.forEach((documento) => {
            tabla += "<tr>" +
                      "<td>" + documento.id + "</td>" +
                      "<td>" + documento.data().nombre + "</td>" +
                      "<td>" + documento.data().presentacion + "</td>" +
                      "<td class='text-right'>"+
                      "<div class='dropdown'>" +
                        "<a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" +
                          "<i class='fas fa-ellipsis-v'></i>" +
                        "</a>" +
                        "<div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>" +

                        "<span class='dropdown-item' onclick=editarFirebase('" + documento.id + "'); >Editar</span>" +
                        "<span class='dropdown-item' onclick=borrarLugar('" + documento.id + "'); >Borrar</span>" + 
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
    location.href="<?php echo base_url()."index.php/medicamento/editarMedicamento?id="; ?>" + idFirestore;
  }

  function borrarFirestore(idFirestore){
    validaSesionfirebase("<?php $usuarioLogeado ?>");

    db.collection("medicamentos").doc(idFirestore).delete().then(() => {
        leeDatosFirestore();
        enviaAlerta("Borrar","Se eliminó el documento " + idFirestore);
    })
    .catch((error) => {
        alert("Error agregando el documento: " + error);
    });
  }  
 
</script>







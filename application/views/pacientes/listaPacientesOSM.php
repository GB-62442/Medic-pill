<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$latitud = LAT_CENTRAL;
$longitud = LNG_CENTRAL;

$coordenadas = "{ lat: $latitud, lng: $longitud }";

?>
<script type="text/javascript">
  function borrarLugar(idFirestore=""){
    if (confirm('¿Esta seguro que quiere borrar al paciente con el id'+ idFirestore + '?')) {
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
          <label for="apellido">Apellido</label>
          <input type="text" name="apellido" id="apellido" class="form-control  form-control-sm" value="<?php echo set_value("apellido"); ?>" placeholder="Busqueda por apellido (s)">
          <small class="text-danger"><?php echo form_error("apellido");?></small>
        </div>

        <div class="form-group">
          <label for="latitud">Latitud</label>
          <input type="text" name="latitud" id="latitud" class="form-control  form-control-sm" value="<?php echo set_value("latitud"); ?>" placeholder="Busqueda con latitud">
          <small class="text-danger"><?php echo form_error("latitud");?></small>
        </div>

        <div class="form-group">
          <label for="longitud">Longitud</label>
          <input type="text" name="longitud" id="longitud" class="form-control  form-control-sm" value="<?php echo set_value("longitud"); ?>" placeholder="Busqueda con longitud">
          <small class="text-danger"><?php echo form_error("longitud");?></small>
        </div>

        <div class="form-group">
          <label for="radio">Radio</label>
          <input type="text" name="radio" id="radio" class="form-control  form-control-sm" value="<?php echo set_value("radio"); ?>" placeholder="Busqueda con radio">
          <small class="text-danger"><?php echo form_error("radio");?></small>
        </div>
      </div>

      <!-- map -->
      <div class="col-md-6">
       <div class="col-md-12 form-group">
      <div class="card">
        <div class="card-body">
          <div  class="map-canvas" id="map" style="width: 100%; height: 300px; padding: 10px;"></div>
        </div>
      </div>
    </div>     
    </div>   
    <!-- /map -->

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
        <button class="form-control btn btn-success " onclick="location.href='<?php echo base_url(); ?>index.php/paciente/agregarPaciente'">Agregar paciente</button>
      </div>
      <div class="col-md-4"></div>
    </div>

  <div id="tablaFirestore" class="table-responsive"></div>
</div>
<!-- /.container -->

<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_KEY_PARA_ESTE_SITIO;?>"></script>
<script>
      let latCentral = <?php echo $latitud; ?>;
      let longCentral = <?php echo $longitud; ?>;
      let coordenadas = <?php echo $coordenadas; ?>;
      let map;
      var marcadores = [];

      initMap();

    function initMap() {
      map = new google.maps.Map(document.getElementById("map"), {
        center: coordenadas,
        zoom: 11,
        mapTypeId: "OSM",
      });
    }


    function crearMarcador(coordenada,titulo) {
      let marcador = new google.maps.Marker({
        position: coordenada,
        map: map,
        //animation: google.maps.Animation.DROP,
        icon: "<?php echo base_url()?>/vendor/assets/img/brand/marcador-de-posicion-3.png",

      });

      google.maps.event.addListener(marcador, 'click', function() {
        infowindow = new google.maps.InfoWindow({
          size: new google.maps.Size(150,50)
        });
        infowindow.setContent(titulo);
        infowindow.open(map,marcador);
      });

      //google.maps.event.trigger(marcador, 'click');

      return marcador;
    }

    //Define OSM map type pointing at the OpenStreetMap tile server
    map.mapTypes.set("OSM", new google.maps.ImageMapType({
        getTileUrl: function(coord, zoom) {
            // "Wrap" x (longitude) at 180th meridian properly
            // NB: Don't touch coord.x: because coord param is by reference, and changing its x property breaks something in Google's lib
            var tilesPerGlobe = 1 << zoom;
            var x = coord.x % tilesPerGlobe;
            if (x < 0) {
                x = tilesPerGlobe+x;
            }
            // Wrap y (latitude) in a like manner if you want to enable vertical infinite scrolling

            return "https://tile.openstreetmap.org/" + zoom + "/" + x + "/" + coord.y + ".png";
        },
        tileSize: new google.maps.Size(256, 256),
        name: "OpenStreetMap",
        maxZoom: 19
    }));
  </script>


<!-- GeoFire -->
<script src="<?php echo base_url(); ?>vendor/geofire/geofireCommon.min.js"></script>

<script type="text/javascript">

  function leeDatosFirestore(){
    validaSesionfirebase("<?php $usuarioLogeado ?>");

    var apellido = $("#apellido").val();
    var latitud = $("#latitud").val();
    var longitud = $("#longitud").val();
    var radio = $("#radio").val();

    var referencia = db.collection("usuarios");

    if(apellido != "")
      referencia = referencia.where("apellido1", "==", apellido);

    if(latitud != "" && longitud != ""){
      latitud = parseFloat(latitud);
      longitud = parseFloat(longitud);

      if(radio == "")
        radio = 1;

      radio = parseFloat(radio);

      // La explicación se encuentra en:
      // https://firebase.google.com/docs/firestore/solutions/geoqueries

      const center = [latitud, longitud];
      const bounds = geofireCommon.geohashQueryBounds(center, radio);
      const promises = [];
      for (const b of bounds) {
        const q = referencia
          .orderBy('geohash')
          .startAt(b[0])
          .endAt(b[1]);

        promises.push(q.get());
      }

      // Lo sigioente es para eliminar los falsos positivos
      // Collect all the query results together into a single list
      Promise.all(promises).then((snapshots) => {
        const matchingDocs = [];

        for (const snap of snapshots) {
          for (const doc of snap.docs) {
            const lat = doc.data().ubicacion.latitude;
            const lng = doc.data().ubicacion.longitude;

            // We have to filter out a few false positives due to GeoHash
            // accuracy, but most will match
            const distanceInKm = geofireCommon.distanceBetween([lat, lng], center);
            const distanceInM = distanceInKm * 1000;
            if (distanceInM <= radio) {
              matchingDocs.push(doc);
            }
          }
        }

        return matchingDocs;
      }).then((matchingDocs) => {
        muestraDatos(matchingDocs);
      });
    }
    else if(latitud == "" || longitud == ""){
      // Le decimos a Firestore de que colección queremos obtener los datos
      referencia.get().then(function(datosRecibidos){
        muestraDatos(datosRecibidos);
      })
      .catch(function(error){
        alert("Error al leer los datos de Firestore");
      });
    }
  
  }

  function muestraDatos(datosRecibidos){
    // Para que el mapa se ajuste a las coordenadas recibidas
      var limites = new google.maps.LatLngBounds();

      for(var i=0; i<marcadores.length; i++){
        marcadores[i].setMap(null);
        marcadores[i] = null;
      }
      marcadores = [];

      var tabla = "<table class='table'>" +
      "<thead class='thead-dark'>" +
      "<tr>" +
      "<th>Id</th>" +
      "<th>Nombre (s)</th>" +
      "<th>Apellidos (s)</th>" +
      "<th>Teléfono</th>" +
      "<th>Mapa</th>" +
      "<th colspan='2' class='text-center'>Acciones</th>" +
      "<tr>" +  
      "</thead>" +
      "<tbody>";
      // Cada uno de los datos recibidos se van pegando a la tabla
      datosRecibidos.forEach((documento) => {
        tabla += "<tr>" +
        "<td>" + documento.id + "</td>" +
        "<td>" + documento.data().nombres + "</td>" +
        "<td>" + documento.data().apellido1 + " " + documento.data().apellido2 + "</td>" +
        "<td>" + documento.data().telefono + "</td>" ;
        if(typeof documento.data().ubicacion !== 'undefined'){
        tabla += "<td><button class='btn btn-default form-control' onclick=\"location.href='<?php echo base_url()?>index.php/paciente/mostrarMapa?id=" + documento.id + "'\"><i class='ni ni-pin-3'></i><span></span>Mapa</button></td>" ;}else{
        tabla += "<td></td>";
        }
        tabla += "<td class='text-right'>"+
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
          if(typeof documento.data().ubicacion !== 'undefined'){
        var punto = new google.maps.LatLng(documento.data().ubicacion.latitude,documento.data().ubicacion.longitude);
        var titulo = "<b>" + documento.data().nombres + " " + documento.data().apellido1 + "</b><br><b>Coordenadas</b><br>"+documento.data().ubicacion.latitude+' N ,'+documento.data().ubicacion.longitude + ' W';
        var marcador = crearMarcador(punto,titulo);
        marcadores.push(marcador);

// Se añade un punto a los limites para que el mapa se ajuste a las coordenadas recibidas
            limites.extend(punto);
          }
      });
      tabla += "</tbody>" +
              "</table>";

      // Buscamos dento de nuestro documento tablaFirestore y le pegamos el string
      // que acabamos de generar
      document.getElementById("tablaFirestore").innerHTML = tabla;

      // El mapa se ajusta a las coordenadas recibidas
      map.fitBounds(limites);

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
    location.href="<?php echo base_url()."index.php/paciente/editarPaciente?id="; ?>" + idFirestore;
  }

  function borrarFirestore(idFirestore){
    validaSesionfirebase("<?php $usuarioLogeado ?>");

    db.collection("usuarios").doc(idFirestore).delete().then(() => {
      leeDatosFirestore();
      enviaAlerta("Borrar","Se eliminó el documento " + idFirestore);
    })
    .catch((error) => {
      alert("Error agregando el documento: " + error);
    });
  } 

</script>






